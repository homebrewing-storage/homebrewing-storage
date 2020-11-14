<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fermentable extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'yield', 'ebc', 'amount', 'expiration_date'];

    public function user()
    {
    	// reference users table
    	return $this->belongsTo(User::class);
    }
}
