<?php

namespace App\Enums;

enum SubmissionStatus: int
{
    case PENDING = 1;
    case ACCEPTED = 2;
    case REJECTED = 3;
    case DELETED = 4;
    case REVISE_REQUIRED = 5;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'รอการตรวจสอบ',
            self::ACCEPTED => 'ยืนยัน',
            self::REJECTED => 'ปฏิเสธ',
            self::DELETED => 'ถูกลบ',
            self::REVISE_REQUIRED => 'ปรับปรุง',
        };
    }

    public function tone(): string
    {
        return match ($this) {
            self::PENDING  => 'warning',
            self::ACCEPTED => 'success',
            self::REJECTED => 'danger',
            self::DELETED  => 'muted',
            self::REVISE_REQUIRED  => 'info',
        };
    }

    // 
    public function canTransitionTo(self $target): bool
    {
        return in_array($target, match ($this) {
            self::PENDING => [
                self::ACCEPTED,
                self::REJECTED,
                self::REVISE_REQUIRED,
            ],

            self::REVISE_REQUIRED => [
                self::PENDING,
                self::ACCEPTED,
                self::REJECTED,
            ],

            self::ACCEPTED => [
                self::PENDING,   // admin rollback
            ],

            self::REJECTED => [
                self::PENDING,   // admin rollback
            ],

            self::DELETED => [],
        }, true);
    }

    public static function filterable(): array
    {
        return [
            self::PENDING,
            self::ACCEPTED,
            self::REJECTED,
            self::REVISE_REQUIRED,
        ];
    }
}
