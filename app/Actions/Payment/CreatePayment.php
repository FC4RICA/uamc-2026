<?php

namespace App\Actions\Payment;

use App\Contracts\CloudStorage;
use App\Models\Payment;
use App\Models\Profile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreatePayment
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
        $driveFileId = null;

        try {
            return DB::transaction(function () use (
                $userId,
                $file,
                $paymentAt,
                $accountName,
                $fromBank,
            ) {
                $profile = Profile::where('user_id', $userId)->firstOrFail();

                $paymentId = (string) Str::uuid();
                $path = "payments/user_{$profile->firstname}-{$profile->lastname}_{$paymentId}." . $file->extension();
                $driveFileId = $this->storage->upload($path, $file);

                $payment = Payment::create([
                    'id' => $paymentId,
                    'user_id' => $userId,
                    'drive_file_id' => $driveFileId,
                    'original_file_name' => $file->getClientOriginalName(),
                    'payment_at' => $paymentAt,
                    'account_name' => $accountName,
                    'from_bank' => $fromBank,
                ]);

                return $payment;
            });  
        } catch (\Throwable $th) {
            if ($driveFileId) {
                try {
                    $this->storage->delete($driveFileId);
                } catch (\Throwable $cleanupError) {
                    Log::error('Failed to cleanup Drive folder', [
                        'folder_id' => $driveFileId,
                        'exception' => $cleanupError,
                    ]);
                }
            }

            throw $th;
        }
    }
}
