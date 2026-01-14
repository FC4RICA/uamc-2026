<?php

namespace App\Enums;

enum ParticipationType: int
{
    case ATTENDEE = 1;
    case PRESENTER = 2;

    public function label(): string
    {
        return match ($this) {
            self::ATTENDEE => 'ผู้เข้าร่วม',
            self::PRESENTER => 'ผู้นำเสนอ',
        };
    }
}
