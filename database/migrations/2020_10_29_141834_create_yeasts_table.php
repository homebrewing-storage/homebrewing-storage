<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYeastsTable extends Migration
{
    public function up(): void
    {
        Schema::create('yeasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('type_id')->references('id')->on('yeast_types')->cascadeOnDelete();
            $table->string('name');
            $table->integer('amount');
            $table->date('expiration_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yeasts');
    }
}
