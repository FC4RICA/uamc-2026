<?php

namespace App\Models;

use App\Enums\ParticipationType;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'research_id',
        'name_th',
        'name_en',
        'participation_type',
        'categories',
        'created_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'participation_type' => ParticipationType::class,
        ];
    }
}
