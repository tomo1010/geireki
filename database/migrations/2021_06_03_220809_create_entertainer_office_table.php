<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntertainerOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entartainer_office', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('entartainer_id');
            $table->unsignedBigInteger('office_id');
            $table->timestamps();
            
            
            // 外部キー制約
            $table->foreign('entertainer_id')->references('id')->on('entertainers')->onDelete('cascade');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');;


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entartainer_office');
    }
}
