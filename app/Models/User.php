<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'email_verified_at',
        'provider_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hops(): HasMany
    {
        return $this->hasMany(Hop::class);
    }

    public function yeasts(): HasMany
    {
        return $this->hasMany(Yeast::class);
    }

    public function extras(): HasMany
    {
        return $this->hasMany(Extra::class);
    }

    public function fermentables(): HasMany
    {
        return $this->hasMany(Fermentable::class);
    }
}
