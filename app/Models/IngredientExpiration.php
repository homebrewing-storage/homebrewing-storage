<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IngredientExpiration extends Model
{
    public $table = 'notifications';

    protected $fillable = [
        'id',
        'user_id',
        'type',
        // 'notifiable_type',
        'data',
        'read_at'
    ];

    protected $casts = [
        'id' => 'string',
        'data' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ingredient(): HasOne
    {
        return $this->hasOne(Ingredient::class);
    }
}
