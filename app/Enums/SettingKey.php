<?php

namespace App\Enums;

enum SettingKey: string
{
    case RegistrationOpen = 'registration_open';
    case AbstractSubmissionOpen   = 'abstract_submission_open';
    case FinalSubmissionOpen   = 'final_submission_open';
}
