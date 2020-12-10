<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Yeast extends Ingredient
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id',
        'name',
        'type',
        'amount',
        'expiration_date'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(YeastType::class, 'type_id');
    }
}
