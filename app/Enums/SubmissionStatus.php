<?php

namespace App\Enums;

enum SubmissionStatus: int
{
    case PENDING = 1;
    case ACCEPTED = 2;
    case REJECTED = 3;
    case DELETED = 4;
    case REVISE_REQUIRED = 5;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'รอการตรวจสอบ',
            self::ACCEPTED => 'ยืนยัน',
            self::REJECTED => 'ปฏิเสธ',
            self::DELETED => 'ถูกลบ',
            self::REVISE_REQUIRED => 'ปรับปรุง',
        };
    }

    public function tone(): string
    {
        return match ($this) {
            self::PENDING  => 'warning',
            self::ACCEPTED => 'success',
            self::REJECTED => 'danger',
            self::DELETED  => 'muted',
            self::REVISE_REQUIRED  => 'info',
        };
    }
}
