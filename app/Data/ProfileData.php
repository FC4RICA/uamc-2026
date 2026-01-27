<?php

namespace App\Data;

use App\Enums\ParticipationType;

final class ProfileData
{
    public static function normalize(array $input): array
    {
        return [
            'organization_id' =>
                ($input['organization_id'] ?? null) === 'other'
                    ? null
                    : (int) $input['organization_id'],

            'organization_other' =>
                ($input['organization_id'] ?? null) === 'other'
                    ? $input['organization_other'] ?? null
                    : null,

            'occupation_id' =>
                ($input['occupation_id'] ?? null) === 'other'
                    ? null
                    : (int) $input['occupation_id'],

            'occupation_other' =>
                ($input['occupation_id'] ?? null) === 'other'
                    ? $input['occupation_other'] ?? null
                    : null,
            'presentation_type' => $input['participation_type'] == ParticipationType::PRESENTER->value ? 
                $input['presentation_type'] : null,
        ];
    }
}