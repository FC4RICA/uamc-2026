<?php

namespace App\Http\Controllers;

use App\Actions\Payment\CreatePayment;
use App\Contracts\CloudStorage;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PaymentController extends Controller
{
    public function create(): View
    {
        Gate::authorize('create', Payment::class);

        $user = Auth::user();
        $activePayment = $user->activePayment();

        return view('member.payment', compact('user', 'activePayment'));
    }

    public function store(
        PaymentRequest $request, 
        CreatePayment $action
    ): RedirectResponse {
        Gate::authorize('store', Payment::class);

        try {
            $action->handle(
                userId: Auth::id(),
                file: $request->validated('file'),
                paymentAt: $request->validated('payment_at'),
                accountName: $request->validated('account_name'),
                fromBank: $request->validated('from_bank'),
            );
            return back()->with('success', 'Uploaded');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') { // duplicate key
                return back()->withErrors([
                    'payment' => 'Payment already submitted.',
                ]);
            }
            throw $e;
        }
    }

    public function download(
        Payment $payment,
        CloudStorage $storage
    ): StreamedResponse
    {
        Gate::authorize('download', $payment);

        $stream = $storage->download($payment->drive_file_id);

        return response()->streamDownload(
            function () use ($stream) {
                while (!$stream->eof()) {
                    echo $stream->read(8192);
                }
            },
            $payment->original_file_name
        );
    }
}
