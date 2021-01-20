<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExtraType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function extras(): HasMany
    {
        return $this->hasMany(Extra::class);
    }
}
