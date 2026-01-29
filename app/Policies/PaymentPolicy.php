<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;

class PaymentPolicy
{
    public function create(User $user): bool
    {
        return $user->payment_required;
    }

    public function store(User $user): bool
    {
        return $user->payment_required;
    }

    public function download(User $user, Payment $payment): bool
    {
        return $payment->user_id === $user->id;
    }
}
