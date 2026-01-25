<?php

namespace App\Enums;

enum PresentationType: int
{
    case ORAL = 1;
    case POSTER = 2;

    public function label(): string
    {
        return match ($this) {
            self::ORAL => 'นำเสนอแบบบรรยาย (Oral Presentation)',
            self::POSTER => 'นำเสนอแบบโปสเตอร์ (Poster Presentation)',
        };
    }

    public function initial(): string
    {
        return match ($this) {
            self::ORAL => 'O',
            self::POSTER => 'P',
        };
    }
}
