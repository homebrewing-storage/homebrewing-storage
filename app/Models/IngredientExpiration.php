<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IngredientExpiration extends Model
{
    use HasFactory;

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

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
