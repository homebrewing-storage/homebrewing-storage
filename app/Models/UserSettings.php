<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'reminder',
        'email',
        'hop',
        'yeast',
        'fermentable',
        'extra'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
