<?php

namespace App\Models;

use App\Enums\ParticipationType;
use App\Enums\PaymentStatus;
use App\Enums\RegistrationStatus;
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
        'registration_status',
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
            'registration_status' => RegistrationStatus::class,
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
    
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function activePayment(): ?Payment
    {
        return $this->payments()
            ->where('status', PaymentStatus::SUBMITTED)
            ->latest()
            ->first();
    }

    public function hasSubmittedPayment(): bool
    {
        return $this->activePayment() !== null;
    }

    public function paymentVerified(): bool
    {
        return $this->payments()
            ->where('status', PaymentStatus::VERIFIED)
            ->exists();
    }

    public function needsPayment(): bool
    {
        return $this->payment_required
            && $this->registrationStatus !== RegistrationStatus::REGISTERED;
    }

    public function isPresenter(): bool
    {
        return $this->profile?->participation_type === ParticipationType::PRESENTER;
    }

    public function canSubmitAbstract(): bool
    {
        return $this->isPresenter() && 
            $this->registrationStatus === RegistrationStatus::REGISTERED &&
            $this->payment_status === PaymentStatus::VERIFIED;
    }
}
