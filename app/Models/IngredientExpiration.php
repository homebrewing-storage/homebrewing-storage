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
        'notifiable',
        'data',
        'read_at'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
