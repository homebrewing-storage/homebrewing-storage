<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLogs extends Model
{

    protected $table = 'user_logs';

    protected $fillable = [
        'user_id',
        'message',
        'channel',
        'level',
        'level_name',
        'datetime',
        'context',
    ];

    protected $casts = [
        'context' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
