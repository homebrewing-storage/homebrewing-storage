<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fermentable extends Ingredient
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id',
        'name',
        'yield',
        'ebc',
        'amount',
        'expiration_date'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(FermentableType::class,'type_id');
    }
}
