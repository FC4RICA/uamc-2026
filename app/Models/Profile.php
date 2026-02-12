<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\AcademicTitle;
use App\Enums\Education;
use App\Enums\ParticipationType;
use App\Enums\PaymentStatus;
use App\Enums\PresentationType;
use App\Enums\Title;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasUuids, SoftDeletes;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function submissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Submission::class,
            'submission_profiles'
        )
        ->active();
    }

    public function submission(): ?Submission
    {
        return $this->submissions->first();
    }

    public function scopeRealParticipants(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->whereHas('user', function ($queryUser) {
                $queryUser->where('is_admin', false);
            })
            ->orWhereHas('submissions', function ($q) {
                $q->active();
            });
        });
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['participationType'] ?? null, function ($q, $type) {
                $q->where('participation_type', $type);
            })
            ->when($filters['presentationType'] ?? null, function ($q, $type) {
                $q->where('presentation_type', $type);
            })
            ->when($filters['payment'] ?? null, function ($q, $payment) {
                $q->whereHas('creator', function ($q) use ($payment) {
                    switch ($payment) {
                        case 'not_required':
                            $q->where('payment_required', false);
                            break;
                        case 'unpaid':
                            $q->paymentRequired()->whereDoesntHave('payments');
                            break;
                        case 'submitted':
                            $q->paymentRequired()
                                ->whereHas('payments', fn ($p) =>
                                    $p->where('status', PaymentStatus::SUBMITTED)
                                );
                            break;
                        case 'verified':
                            $q->whereHas('payments', fn ($p) =>
                                $p->where('status', PaymentStatus::VERIFIED)
                            );
                            break;
                    }
                });
            })
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('firstname', 'ilike', "%{$search}%")
                    ->orWhere('lastname', 'ilike', "%{$search}%")
                    ->orWhere('organization_other', 'ilike', "%{$search}%")
                    ->orWhereHas('organization', fn ($q) =>
                        $q->where('name', 'ilike', "%{$search}%")
                    );
                });
            });
    }
}
