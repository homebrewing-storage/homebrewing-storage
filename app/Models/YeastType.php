<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class YeastType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function yeasts(): HasMany
    {
        return $this->hasMany(Yeast::class);
    }
}
