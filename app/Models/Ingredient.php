<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

abstract class Ingredient extends Model
{
    protected $casts = [
        'expiration_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notificaion(): BelongsTo
    {
        return $this->belongsTo(IngredientExpiration::class);
    }
}