<?php

namespace App\Enums;

enum SubmissionFileType: string
{
    case ABSTRACT_TH = 'abstract_th';
    case ABSTRACT_EN = 'abstract_en';
    case POSTER = 'poster';

    public function label(): string
    {
        return match ($this) {
            self::ABSTRACT_TH => 'บทคัดย่อภาษาไทย',
            self::ABSTRACT_EN => 'บทคัดย่อภาษาอังกฤษ',
            self::POSTER => 'โปสเตอร์',
        };
    }
}