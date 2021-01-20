<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\Ingredient\AddedEvent;
use App\Events\Ingredient\DeletedEvent;
use App\Events\Ingredient\UpdatedEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

abstract class Ingredient extends Model
{
    protected string $type;

    protected $casts = [
        'expiration_date' => 'datetime',
    ];

    protected $dispatchesEvents = [
        "updated" => UpdatedEvent::class,
        "deleted" => DeletedEvent::class,
        "created" => AddedEvent::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getIngredientType(): string
    {
        return $this->type;
    }
}
