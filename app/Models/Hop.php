<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hop extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'amount', 'alpha_acid', 'expiration_date'];

    public function user(): belongsTo
    {
    	// reference users table
    	return $this->belongsTo(User::class);
    }
}
