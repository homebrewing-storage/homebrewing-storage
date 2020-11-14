<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function hops()
    {
        // SELECT * FROM 'hops' WHERE 'user_id' = *current_user*
        return $this->hasMany('App\Models\Hop');
    }

    public function yeasts()
    {
        return $this->hasMany('App\Models\Yeast');
    }

    public function extras()
    {
        return $this->hasMany('App\Models\Extra');
    }

    public function fermentables()
    {
        return $this->hasMany('App\Models\fermentable');
    }
}
