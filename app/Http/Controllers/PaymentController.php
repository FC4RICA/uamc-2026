<?php

namespace App\Http\Controllers;

use App\Actions\Payment\UploadPayment;
use App\Contracts\CloudStorage;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PaymentController extends Controller
{
    public function create(): View
    {
        return view('member.payment');
    }

    public function store(
        PaymentRequest $request, 
        UploadPayment $action
    ): RedirectResponse {
        $validated = $request->validated();
        $file = $request->file('file');
        $payment = $action->handle(Auth::user()->id, $file);
        $payment->update([            
            'payment_at' => $validated['payment_at'],
            'account_name' => $validated['account_name'],
            'from_bank' => $validated['from_bank'],
        ]);
        $payment->save();
        return back()->with('success', 'Uploaded');
    }

    public function download(
        Payment $payment,
        CloudStorage $storage
    ): StreamedResponse
    {
        Gate::authorize('view', $payment);

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
