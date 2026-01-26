<?php

use App\Enums\SettingKey;

return [
    'defaults' => [
        SettingKey::RegistrationOpen->value => true,
        SettingKey::AbstractSubmissionOpen->value => true,
    ],
];