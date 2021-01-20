<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Extra extends Ingredient
{
    use HasFactory;

    protected string $type = "Extra";

    protected $fillable = [
        'user_id',
        'type_id',
        'name',
        'amount',
        'expiration_date'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ExtraType::class, 'type_id');
    }
}
