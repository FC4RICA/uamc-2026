<?php

namespace App\Data\Submission;

use App\Data\ProfileData;

abstract class BaseAbstractSubmissionData
{
    protected static function normalizeParticipants(array $participants): array
    {
        return collect($participants)
            ->map(fn (array $p) => array_merge(
                $p,
                ProfileData::normalize($p)
            ))
            ->toArray();
    }
}