<?php

namespace App\Services;

use App\Enums\SettingKey;
use App\Services\AppSetting;

class AccessControl
{
    public static function registrationOpen(): bool
    {
        return AppSetting::enabled(SettingKey::RegistrationOpen);
    }

    public static function abstractSubmissionOpen(): bool
    {
        return AppSetting::enabled(SettingKey::AbstractSubmissionOpen);
    }
}
