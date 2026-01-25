<?php

namespace App\Enums;

enum SubmissionFileType: string
{
    case ABSTRACT = 'abstract';
    case EXTENDED_ABSTRACT = 'extended_abstract';
    case POSTER = 'poster';
    case RECOMMENDATION_LETTER = ' recommendation_letter';

    public function label(): string
    {
        return match ($this) {
            self::ABSTRACT => 'บทคัดย่อ',
            self::EXTENDED_ABSTRACT => 'บทคัดย่อแบบขยาย',
            self::POSTER => 'โปสเตอร์',
            self::RECOMMENDATION_LETTER => 'หนังสือรับรองจากอาจารย์ที่ปรึกษา',
        };
    }
}