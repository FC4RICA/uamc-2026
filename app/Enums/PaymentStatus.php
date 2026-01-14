<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case NOT_REQUIRED = 1;
    case PENDING = 2;
    case SUBMITTED = 3;
    case VERIFIED = 4;

    public function label(): string
    {
        return match ($this) {
            self::NOT_REQUIRED => 'ไม่ต้องชำระเงิน',
            self::PENDING => 'รอการชำระเงิน',
            self::SUBMITTED => 'ชำระเงินแล้ว',
            self::VERIFIED => 'ยืนยันแล้ว',
        };
    }
}
