<?php

namespace App\Models;

use App\Enums\PresentationType;
use App\Enums\SubmissionStatus;
use App\Policies\SubmissionPolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[UsePolicy(SubmissionPolicy::class)]
class Submission extends Model
{
    use HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'submitted_by',
        'presentation_type',
        'title_th',
        'title_en',
        'keywords',
        'drive_folder_id',
        'status',
    ];

     protected $dates = ['deleted_at'];

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

    public function scopeActive(Builder $query): mixed
    {
        return $query->whereNull('deleted_at');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', SubmissionStatus::PENDING);
    }

    public function scopeAccepted(Builder $query): Builder
    {
        return $query->where('status', SubmissionStatus::ACCEPTED);
    }

    public function scopeReviseRequired(Builder $query): Builder
    {
        return $query->where('status', SubmissionStatus::REVISE_REQUIRED);
    }

    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', SubmissionStatus::REJECTED);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by', 'id');
    }

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(
            Profile::class,
            'submission_profiles'
        );
    }

    public function participants(): BelongsToMany
    {
        return $this->profiles()->where('user_id', null);
    }

    public function abstractGroups(): BelongsToMany
    {
        return $this->belongsToMany(
            AbstractGroup::class, 
            'submission_abstract_groups',
            'submission_id',
            'abstract_group_id'
        )
        ->withPivot('priority')
        ->orderByPivot('priority');
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(
            SubmissionRound::class,
        );
    }

    public function abstractRound(): SubmissionRound
    {
        return $this->rounds()->where('round_type', 'abstract')->first();
    }

    public function finalRound(): ?SubmissionRound
    {
        return $this->rounds()->where('round_type', 'final')->first();
    }

    public function abstractFiles(): HasMany
    {
        return $this->abstractRound()->files()->orderBy('version');
    }

    public function revises(): HasMany
    {
        return $this->hasMany(SubmissionRevise::class);
    }

    public function activeRevise(): HasOne
    {
        return $this->hasOne(SubmissionRevise::class)
            ->whereNull('resolved_at')
            ->latest('round');
    }

    public function hasActiveRevision(): bool
    {
        return $this->status === SubmissionStatus::REVISE_REQUIRED;
    }
}
