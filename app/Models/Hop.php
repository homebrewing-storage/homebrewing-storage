<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hop extends Ingredient
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'alpha_acid',
        'expiration_date'
    ];
}
