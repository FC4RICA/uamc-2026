<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class RedirectAfterRegister
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;

        // Store intended redirect in session
        if ($user->payment_required) {
            session(['url.intended' => route('member.payment.index')]);
        } else {
            session(['url.intended' => route('member.index')]);
        }
    }
}
