<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntertainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entertainers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('numberofpeople');
            $table->string('alias')->nullable();
            $table->date('active');
            $table->date('activeend')->nullable();
            $table->string('master')->nullable();
            $table->string('oldname')->nullable();
            $table->string('official')->nullable();
            $table->string('youtube')->nullable();
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
        Schema::dropIfExists('entertainers');
    }
}
