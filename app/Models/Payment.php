<?php

namespace App\Models;

use App\Policies\PaymentPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[UsePolicy(PaymentPolicy::class)]
class Payment extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'payment_at',
        'account_name',
        'from_bank',
        'drive_file_id',
        'original_file_name',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'payment_at' => 'datetime',
        ];
    }
}
