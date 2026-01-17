<?php

namespace App\Actions\Payment;

use App\Contracts\CloudStorage;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UploadPayment
{
    public function __construct(
        protected CloudStorage $storage
    ) {}

    public function handle(
        string $userId,
        UploadedFile $file,
        string $paymentAt,
        string $accountName,
        string $fromBank,
    ): Payment {
        return DB::transaction(function () use (
            $userId,
            $file,
            $paymentAt,
            $accountName,
            $fromBank,
        ) {
            $user = User::lockForUpdate()->findOrFail($userId);

            $existing = Payment::where('user_id', $userId)
                ->where('status', PaymentStatus::SUBMITTED)
                ->lockForUpdate()
                ->first();

            if ($existing) {
                $existing->update(['status' => PaymentStatus::REPLACED]);
            }

            $payment_id = Str::uuid();
            $path = "payments/user_{$userId}_{$payment_id}." . $file->extension();
            $driveFileId = $this->storage->upload($path, $file);

            $payment = Payment::create([
                'id' => $payment_id,
                'user_id' => $userId,
                'status' => PaymentStatus::SUBMITTED,
                'drive_file_id' => $driveFileId,
                'original_file_name' => $file->getClientOriginalName(),
                'payment_at' => $paymentAt,
                'account_name' => $accountName,
                'from_bank' => $fromBank,
            ]);

            return $payment;
        });  
    }
}
