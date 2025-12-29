<?php

namespace App\Enums;

enum ParticipationType:int
{
    case Attendee = 1;
    case Oral = 2;
    case Poster = 3;

    public function label(): string
    {
        return match ($this) {
            self::Attendee => 'ผู้เข้าร่วม',
            self::Oral => 'นำเสนอแบบบรรยาย (Oral Presentation)',
            self::Poster => 'นำเสนอแบบโปสเตอร์ (Poster Presentation)',
        };
    }
}
