<?php

namespace App\Models;

use App\Enums\SubmissionFileType;
use App\Policies\SubmissionFilePolicy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;

#[UsePolicy(SubmissionFilePolicy::class)]
class SubmissionFile extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'submission_round_id',
        'file_type',
        'drive_file_id',
        'original_file_name',
        'version',
        'is_current'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'file_type' => SubmissionFileType::class,
            'is_current' => 'boolean',
            'version' => 'int',
        ];
    }

    public function submissionRound(): BelongsTo
    {
        return $this->belongsTo(SubmissionRound::class);
    }

    public function ownerId(): string
    {
        return $this->submissionRound
            ->submission
            ->submitted_by;
    }
}
