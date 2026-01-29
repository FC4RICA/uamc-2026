<?php

namespace App\Enums;

enum SubmissionStatus: int
{
    case PENDING = 1;
    case ACCEPTED = 2;
    case REJECTED = 3;
    case DELETED = 4;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'รอการตรวจสอบ',
            self::ACCEPTED => 'ยืนยัน',
            self::REJECTED => 'ปฏิเสธ',
            self::DELETED => 'ถูกลบ',
        };
    }
}
