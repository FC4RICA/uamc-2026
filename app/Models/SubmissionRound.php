<?php

namespace App\Models;

use App\Enums\SubmissionFileType;
use App\Enums\SubmissionRoundType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubmissionRound extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'submission_id',
        'round_type',
        'submitted_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'round_type' => SubmissionRoundType::class
        ];
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(SubmissionFile::class);
    }

    public function posterFiles(): HasMany
    {
        return $this->hasMany(SubmissionFile::class)
            ->where('file_type', SubmissionFileType::POSTER);
    }

    public function extendedAbstractFiles(): HasMany
    {
        return $this->hasMany(SubmissionFile::class)
            ->where('file_type', SubmissionFileType::EXTENDED_ABSTRACT);
    }

    public function recommendationLetterFiles(): HasMany
    {
        return $this->hasMany(SubmissionFile::class)
            ->where('file_type', SubmissionFileType::RECOMMENDATION_LETTER);
    }
}
