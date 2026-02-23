<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::participants()
            ->hasPayment()
            ->with([
                'payments',
                'profile',
            ])
            ->filter($request->only([
                'payment', 
            ]))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.payment.index', compact('users'));
    }

    public function show(User $user): View
    {

        return view('admin.payment.show', compact('user'));
    }

    public function verify(Payment $payment): RedirectResponse
    {
         DB::transaction(function () use ($payment) {
            if ($payment->status === PaymentStatus::VERIFIED) {
                return;
            }

            // Ensure no other verified payment exists
            $alreadyVerified = Payment::where('user_id', $payment->user_id)
                ->where('status', PaymentStatus::VERIFIED)
                ->where('id', '!=', $payment->id)
                ->exists();
            if ($alreadyVerified) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'payment' => 'ผู้ใช้นี้มีการยืนยันการชำระเงินแล้ว'
                ]);
            }

            Payment::where('user_id', $payment->user_id)
                ->where('status', PaymentStatus::PENDING)
                ->where('id', '!=', $payment->id)
                ->update([
                    'status' => PaymentStatus::REJECTED,
                ]);

            $payment->update([
                'status' => PaymentStatus::VERIFIED,
            ]);
        });

        return back();
    }

    public function reject(Payment $payment): RedirectResponse
    {
            DB::transaction(function () use ($payment) {
            if ($payment->status === PaymentStatus::REJECTED) {
                return;
            }

            if ($payment->status === PaymentStatus::VERIFIED) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'payment' => 'ไม่สามารถปฏิเสธรายการที่ยืนยันแล้ว'
                ]);
            }

            $payment->update([
                'status' => PaymentStatus::REJECTED,
            ]);
        });
        
        return back();
    }
}
