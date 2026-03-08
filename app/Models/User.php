<?php

namespace App\Models;

use App\Enums\ParticipationType;
use App\Enums\PaymentStatus;
use App\Enums\PresentationType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'is_admin',
        'payment_required',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'payment_required' => 'boolean',
        ];
    }

    protected static function booted()
    {
        static::deleting(function ($user) {
            if ($user->isForceDeleting()) {
                $user->profile()->forceDelete();
            } else {
                $user->profile()->delete();
            }
        });
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function scopeActive(Builder $query): mixed
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeParticipants(Builder $query): Builder
    {
        return $query->where('is_admin', false);
    }

    public function scopeAttendees(Builder $query): Builder
    {
        return $query->whereHas('profile', function ($q) {
            $q->where('participation_type', ParticipationType::ATTENDEE);
        });
    }

    public function scopePresenters(Builder $query): Builder
    {
        return $query->whereHas('profile', function ($q) {
            $q->where('participation_type', ParticipationType::PRESENTER);
        });
    }
    
    // payment
    public function scopePaymentRequired(Builder $query): Builder
    {
        return $query->where('payment_required', true);
    }

    public function scopeHasPayment(Builder $query): Builder
    {
        return $query->whereHas('payments');
    }

    public function scopeUnpaid(Builder $query): Builder
    {
        return $query
            ->paymentRequired()
            ->where(function ($q) {
            $q->whereDoesntHave('payments')

            ->orWhere(function ($q2) {
                $q2->whereHas('payments')
                   ->whereDoesntHave('payments', function ($p) {
                       $p->whereIn('status', [
                           PaymentStatus::VERIFIED,
                           PaymentStatus::PENDING,
                       ]);
                   });
            });
        });
    }

    public function scopePaymentSubmitted(Builder $query): Builder
    {
        return $query
            ->paymentRequired()
            ->whereHas('payments', function ($q) {
                $q->where('status', PaymentStatus::PENDING);
            });
    }

    public function scopePaymentVerified(Builder $query): Builder
    {
        return $query->whereHas('payments', function ($q) {
            $q->where('status', PaymentStatus::VERIFIED);
        });
    }

    public function recalculatePaymentRequirement(): void
    {
        $this->payment_required = is_null($this->profile->organization_id);
        $this->save();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function hasPayment(): bool
    {
        return $this->payments()->exists();
    }

    public function hasVerifiedPayment(): bool
    {
        return $this->payments()
            ->where('status', PaymentStatus::VERIFIED)
            ->exists();
    }

    public function paymentsRejected(): bool
    {
        if (! $this->payment_required) {
            return false;
        }

        return $this->payments()
            ->whereNotIn('status', [PaymentStatus::REJECTED])
            ->doesntExist()
            && $this->payments()
                ->where('status', PaymentStatus::REJECTED)
                ->exists();
    }

    public function needsPayment(): bool
    {
        return $this->payment_required
            && ! $this->hasPayment();
    }

    public function registrationComplete(): bool
    {
        if ($this->payment_required) {
            return $this->hasPayment();
        }

        return true;
    }

    // submission
    public function isPresenter(): bool
    {
        return $this->profile?->participation_type === ParticipationType::PRESENTER;
    }

    public function presentationType(): PresentationType
    {
        return $this->profile?->presentation_type;
    }

    public function isOral(): bool
    {
        return $this->presentationType() === PresentationType::ORAL;
    }

    public function isPoster(): bool
    {
        return $this->presentationType() === PresentationType::POSTER;
    }

    public function canSubmitAbstract(): bool
    {
        return $this->isPresenter()
            && $this->registrationComplete()
            && ! $this->hasSubmission();
    }
    
    public function submission(): HasOne
    {
        return $this->hasOne(Submission::class, 'submitted_by', 'id')
            ->active();
    }

    public function hasSubmission(): bool
    {
        return $this->submission !== null;
    }

    public function hasAcceptedSubmission(): bool
    {
        return $this->submission->accepted()->exists();
    }

    public function canSubmitFinal(): bool
    {
        return $this->hasAcceptedSubmission() && ! $this->submission->finalRound();
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['participationType'] ?? null, function ($q, $type) {
                $q->whereHas('profile', function ($profileQuery) use ($type) {
                    $profileQuery->where('participation_type', $type);
                });
            })
            ->when($filters['presentationType'] ?? null, function ($q, $type) {
                $q->whereHas('profile', function ($profileQuery) use ($type) {
                    $profileQuery->where('presentation_type', $type);
                });
            })
            ->when($filters['submission'] ?? null, function ($q, $submission) {
                if ($submission === 'submitted') {
                    $q->whereHas('submission');
                }
                if ($submission === 'not_submitted') {
                    $q->whereDoesntHave('submission');
                }
            })
            ->when($filters['payment'] ?? null, function ($q, $payment) {
                $q->filterByPayment($payment);
            })
            ->when($filters['role'] ?? null, function ($q, $role) {
                if ($role === 'member') {
                    $q->where('is_admin', false);
                }
                if ($role === 'admin') {
                    $q->where('is_admin', true);
                }
            });
    }

    public function paymentStatus(): string
    {
        if (! $this->payment_required) {
            return 'ไม่ต้องชำระ';
        }

        $payments = $this->payments;

        if ($payments->isEmpty()) {
            return 'ยังไม่ได้ชำระ';
        }

        if ($payments->contains('status', PaymentStatus::VERIFIED)) {
            return 'ชำระแล้ว';
        }

        if ($payments->contains('status', PaymentStatus::PENDING)) {
            return 'ยังไม่ได้ตรวจสอบ';
        }

        if ($this->paymentsRejected()) {
            return 'ถูกปฏิเสธ';
        }

        return 'ไม่ทราบสถานะ';
    }

    public function scopeFilterByPayment(Builder $query, ?string $payment): Builder
    {
        return $query->when($payment, function ($q, $payment) {
            switch ($payment) {

                case 'not_required':
                    $q->where('payment_required', false);
                    break;

                case 'unpaid':
                    $q->paymentRequired()
                    ->whereDoesntHave('payments');
                    break;

                case 'submitted':
                    $q->paymentRequired()
                    ->whereHas('payments', fn ($p) =>
                        $p->where('status', PaymentStatus::PENDING)
                    );
                    break;

                case 'verified':
                    $q->whereHas('payments', fn ($p) =>
                        $p->where('status', PaymentStatus::VERIFIED)
                    );
                    break;

                case 'rejected':
                    $q->paymentRequired()
                    ->whereDoesntHave('payments', fn ($p) =>
                        $p->where('status', PaymentStatus::VERIFIED)
                    )
                    ->whereDoesntHave('payments', fn ($p) =>
                        $p->where('status', PaymentStatus::PENDING)
                    )
                    ->whereHas('payments', fn ($p) =>
                        $p->where('status', PaymentStatus::REJECTED)
                    );
                    break;
            }
        });
    }
}