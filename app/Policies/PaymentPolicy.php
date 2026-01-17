<?php

namespace App\Policies;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Models\User;

class PaymentPolicy
{
    public function create(User $user): bool
    {
        return $user->needsPayment();
    }

    public function store(User $user): bool
    {
        return $user->needsPayment();
    }

    public function download(User $user, Payment $payment): bool
    {
        return $payment->user_id === $user->id;
    }
}
