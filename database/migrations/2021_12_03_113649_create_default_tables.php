<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->JSON('cases')->default('[]');
            $table->string('image');
            $table->bigInteger('author')->unsigned();
            $table->dateTime('due_date');
            $table->timestamps();

            $table->foreign('author')->references('id')->on('users');
        });
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('image');
            $table->smallInteger('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bets');
        Schema::dropIfExists('achievements');
    }
}
