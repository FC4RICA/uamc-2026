<?php

namespace App\Enums;

enum Education:int
{
    case BACHELOR = 1;
    case MASTER = 2;
    case DOCTORATE = 3;
    case OTHER = 4;

    public function label(): string
    {
        return match ($this) {
            self::BACHELOR => 'ปริญญาตรี',
            self::MASTER => 'ปริญญาโท',
            self::DOCTORATE => 'ปริญญาเอก',
            self::OTHER => 'อื่น ๆ',
        };
    }
}
