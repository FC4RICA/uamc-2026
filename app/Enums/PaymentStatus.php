<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case SUBMITTED = 1;
    case VERIFIED = 2;
    case REJECTED = 3;

    public function label(): string
    {
        return match ($this) {
            self::SUBMITTED => 'ส่งหลักฐานแล้ว',
            self::VERIFIED => 'ยืนยันแล้ว',
            self::REJECTED => 'ถูกปฏิเสธ',
        };
    }

    public function rejected(): bool
    {
        return $this === self::REJECTED;
    }
}
