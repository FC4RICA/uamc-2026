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

    public function handle(string $userId, UploadedFile $file): Payment
    {
        $id = Str::uuid();
        $path = "payments/" . 'user_' . $userId . '_' . $id . '.' . $file->extension();
        $drive_file_id = $this->storage->upload($path, $file);
        return Payment::create([
            'id' => $id,
            'user_id' => $userId,
            'drive_file_id' => $drive_file_id,
            'original_file_name' => $file->getClientOriginalName(),
        ]);
    }
}
