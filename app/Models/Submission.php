<?php

namespace App\Models;

use App\Enums\PresentationType;
use App\Enums\SubmissionStatus;
use App\Policies\SubmissionPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[UsePolicy(SubmissionPolicy::class)]
class Submission extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'submitted_by',
        'presentation_type',
        'titie_th',
        'titie_en',
        'keywords',
        'drive_folder_id',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'presentation_type' => PresentationType::class,
            'status' => SubmissionStatus::class
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class, 'submission_profiles');
    }

    public function abstractGroups(): BelongsToMany
    {
        return $this->belongsToMany(AbstractGroup::class)
            ->withPivot('priority')->orderByPivot('priority');
    }

    public function files()
    {
        return $this->hasMany(SubmissionFile::class);
    }
}
