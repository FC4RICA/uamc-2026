<?php

namespace App\Actions\Payment;

use App\Contracts\CloudStorage;
use App\Models\Payment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadPayment
{
    public function __construct(
        protected CloudStorage $storage
    ) {}

    public function handle(int $userId, UploadedFile $file): Payment
    {
        $path = "payments/" . 'user_' . $userId . '_' . Str::uuid() . '.' . $file->extension();
        $file_id = $this->storage->upload($path, $file);
        return Payment::create([
            'user_id' => $userId,
            'drive_file_id' => $file_id,
            'original_file_name' => $file->getClientOriginalName(),
        ]);
    }
}
