<?php

namespace App\Enums;

enum RegistrationStatus: int
{
    case PENDING_PAYMENT = 1;
    case PENDING_REVIEW = 2;
    case REGISTERED = 3;

    public function label(): string
    {
        return match ($this) {
            self::PENDING_PAYMENT => 'รอการชำระเงิน',
            self::PENDING_REVIEW => 'รอการรีวิว',
            self::REGISTERED => 'เป็นสมาชิกแล้ว',
        };
    }
}
