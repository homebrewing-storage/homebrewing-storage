<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
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
}
