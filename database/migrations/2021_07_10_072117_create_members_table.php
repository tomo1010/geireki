<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('entertainer_id')->nullable();                   
            $table->unsignedBigInteger('perfomer_id')->nullable();    
            
            $table->timestamps();
            
            // 外部キー制約
            // $table->foreign('entertainer_id')->references('id')->on('entertainers');
            // $table->foreign('perfomer_id')->references('id')->on('perfomers');
            //
            
            // entertainer_idとperfomer_idの組み合わせの重複を許さない
            $table->unique(['entertainer_id', 'perfomer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
