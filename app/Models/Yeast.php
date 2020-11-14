<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yeast extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'amount', 'expiration_date'];

    public function user()
    {
    	// reference users table
    	return $this->belongsTo(User::class);
    }
}
