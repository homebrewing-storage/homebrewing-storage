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
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hops(): HasMany
    {
        // SELECT * FROM 'hops' WHERE 'user_id' = *current_user*
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

    public function notifications(): HasMany
    {
        return $this->hasMany(IngredientExpiration::class);
    }
}
