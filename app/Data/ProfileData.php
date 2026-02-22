<?php

namespace App\Data;

use App\Enums\ParticipationType;

final class ProfileData
{
    public static function normalize(array $input): array
    {
        $data = $input;

        $data['organization_id'] =
            ($input['organization_id'] ?? null) === 'other'
                ? null
                : (int) $input['organization_id'];

        $data['organization_other'] =
            ($input['organization_id'] ?? null) === 'other'
                ? $input['organization_other'] ?? null
                : null;

        $data['occupation_id'] =
            ($input['occupation_id'] ?? null) === 'other'
                ? null
                : (int) $input['occupation_id'];

        $data['occupation_other'] =
            ($input['occupation_id'] ?? null) === 'other'
                ? $input['occupation_other'] ?? null
                : null;

        $data['presentation_type'] = ($input['participation_type'] ?? null) == ParticipationType::PRESENTER->value ? 
            $input['presentation_type'] : null;
        
        return $data;
    }
}