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
            $table->string('alias');
            $table->date('active');
            $table->date('activeend')->nullable();
            $table->string('master');
            $table->string('oldname');
            $table->string('official');
            $table->string('youtube');
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
