<?php

namespace App\Enums;

enum SubmissionFileType: string
{
    case ABSTRACT_TH = 'abstract_th_pdf';
    case ABSTRACT_EN = 'abstract_en_pdf';
    case POSTER = 'poster_pdf';

    public function label(): string
    {
        return match ($this) {
            self::ABSTRACT_TH => 'บทคัดย่อภาษาไทย',
            self::ABSTRACT_EN => 'บทคัดย่อภาษาอังกฤษ',
            self::POSTER => 'โปสเตอร์',
        };
    }
}