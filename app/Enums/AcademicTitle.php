<?php

namespace App\Enums;

enum AcademicTitle:int
{
    case NONE = 1;
    case PROF = 2;
    case ASSOC_PROF = 3;
    case ASST_PROF = 4;

    public function label(): string
    {
        return match ($this) {
            self::NONE => 'ไม่มี',
            self::PROF => 'ศาสตราจารย์',
            self::ASSOC_PROF => 'รองศาสตราจารย์',
            self::ASST_PROF => 'ผู้ช่วยศาสตราจารย์',
        };
    }
}
