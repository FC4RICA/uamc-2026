<?php

namespace App\Models;

use App\Enums\ParticipationType;
use App\Enums\PaymentStatus;
use App\Enums\PresentationType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasUuids;

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

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
    
    // payment
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
        return $this->hasOne(Submission::class, 'submitted_by', 'id');
    }

    public function hasSubmission(): bool
    {
        return $this->submission !== null;
    }
}
