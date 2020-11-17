<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Yeast extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'amount',
        'expiration_date'
    ];

    public function user(): BelongsTo
    {
        // reference users table
        return $this->belongsTo(User::class);
    }
}
