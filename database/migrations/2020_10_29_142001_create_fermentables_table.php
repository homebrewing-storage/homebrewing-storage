<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFermentablesTable extends Migration
{
    public function up()
    {
        Schema::create('fermentables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->enum('type',
                ['Grain', 'Sugar', 'Liquid extract', 'Dry extract', 'Adjunct']
            );
            $table->integer('yield');
            $table->integer('ebc');
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
        Schema::dropIfExists('fermentables');
    }
}
