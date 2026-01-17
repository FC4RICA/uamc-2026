<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\AcademicTitle;
use App\Enums\Education;
use App\Enums\ParticipationType;
use App\Enums\PresentationType;
use App\Enums\Title;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'phone',
        'special_requirements',
        'title',
        'academic_title',
        'education',
        'participation_type',
        'presentation_type',
        'organization_id',
        'organization_other',
        'occupation_id',
        'occupation_other',
        'created_by',
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
            'presentation_type' => PresentationType::class,
            'title' => Title::class,
            'academic_title' => AcademicTitle::class,
            'education' => Education::class,
            'organization_id' => 'int',
            'occupation_id' => 'int',
        ];
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }
}
