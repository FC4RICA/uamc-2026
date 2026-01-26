<?php

namespace App\Enums;

enum SettingKey: string
{
    case RegistrationOpen = 'registration_open';
    case AbstractSubmissionOpen   = 'abstract_submission_open';
}
