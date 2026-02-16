<?php

namespace App\Models;

use App\Policies\SubmissionRevisionPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[UsePolicy(SubmissionRevisionPolicy::class)]
class SubmissionRevision extends Model
{
    protected $fillable = [
        'submission_id',
        'round',
        'message',
        'target_email',
        'requested_by',
        'resolved_at',
        'submission_file_id',
    ];
    
    protected function casts(): array
    {
        return [
            'resolved_at' => 'datetime',
            'round' => 'int',
        ];
    }

    public function scopeResolved(Builder $query): Builder
    {
        return $query->whereNull('resolved_at')
            ->whereNull('submission_file_id');
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function isResolved(): bool
    {
        return ! is_null($this->resolved_at) && $this->submissionFile()->exists();
    }

    public function submissionFile(): BelongsTo
    {
        return $this->belongsTo(SubmissionFile::class);
    }
}
