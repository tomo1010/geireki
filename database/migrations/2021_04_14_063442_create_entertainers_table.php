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
            $table->unsignedBigInteger('office_id');
            $table->string('name');
            $table->integer('numberofpeople');
            $table->integer('gender');
            $table->string('alias')->nullable();
            $table->date('active')->nullable();
            $table->date('activeend')->nullable();
            $table->string('master')->nullable();
            $table->string('oldname')->nullable();
            $table->string('brain')->nullable();
            $table->string('encounter')->nullable(); 
            $table->string('named')->nullable();             
            $table->text('memo')->nullable();                         
            $table->string('official')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();            
            
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('office_id')->references('id')->on('offices');

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
