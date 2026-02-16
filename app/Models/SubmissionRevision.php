<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
