<?php

namespace App\Enums;

enum ParticipationType:int
{
    case ATTENDEE = 1;
    case ORAL = 2;
    case POSTER = 3;

    public function label(): string
    {
        return match ($this) {
            self::ATTENDEE => 'ผู้เข้าร่วม',
            self::ORAL => 'นำเสนอแบบบรรยาย (Oral Presentation)',
            self::POSTER => 'นำเสนอแบบโปสเตอร์ (Poster Presentation)',
        };
    }
}
