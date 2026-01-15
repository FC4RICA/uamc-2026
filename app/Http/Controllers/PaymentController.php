<?php

namespace App\Http\Controllers;

use App\Actions\Payment\UploadPayment;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function store(
        PaymentRequest $request, 
        UploadPayment $action
    ): RedirectResponse {
        $file = $request->file('file');
        $action->handle(Auth::user()->id, $file);

        return back()->with('success', 'Uploaded');
    }
}
