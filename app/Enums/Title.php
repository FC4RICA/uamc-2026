<?php

namespace App\Enums;

enum Title:int
{
    case MR = 1;
    case MRS = 2;
    case MISS = 3;
    case OTHER = 4;

    public function label(): string
    {
        return match ($this) {
            self::MR => 'นาย',
            self::MRS => 'นาง',
            self::MISS => 'นางสาว',
            self::OTHER => 'อื่น ๆ',
        };
    }

    public function acronyms(): ?string
    {
        return match ($this) {
            self::MR => 'นาย',
            self::MRS => 'นาง',
            self::MISS => 'น.ส.',
            self::OTHER => null,
        };
    }
}
