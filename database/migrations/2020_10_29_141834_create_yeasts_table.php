<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYeastsTable extends Migration
{
    public function up()
    {
        Schema::create('yeasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('name');
            $table->enum('type',
                ['Liquid', 'Dry', 'Slant', 'Culture']
            );
            $table->integer('amount');
            $table->date('expiration_date');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('yeasts');
    }
}
