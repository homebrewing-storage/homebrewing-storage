<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Extra extends Model
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
