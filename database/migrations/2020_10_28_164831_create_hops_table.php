<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHopsTable extends Migration
{
    public function up()
    {
        Schema::create('hops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('amount');
            $table->smallInteger('alpha_acid');
            $table->date('expiration_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hops');
    }
}
