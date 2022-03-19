<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfomersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfomers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('office_id');
            $table->string('name');
            $table->string('realname')->nullable();
            $table->string('alias')->nullable();
            $table->date('birthday')->nullable();
            $table->date('deth')->nullable();
            $table->string('birthplace')->nullable(); 
            $table->string('bloodtype')->nullable();
            $table->string('height')->nullable();
            $table->string('dialect')->nullable();
            $table->string('educational')->nullable();
            $table->string('master')->nullable();
            $table->string('school')->nullable();
            $table->date('active')->nullable();
            $table->date('activeend')->nullable();
            $table->string('spouse')->nullable();
            $table->string('relatives')->nullable();
            $table->string('disciple')->nullable();            
            $table->text('memo')->nullable();                        
            $table->text('gag')->nullable();                                    
            $table->string('official')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();                        
            $table->string('tiktok')->nullable();            
            $table->string('blog')->nullable();            
            
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
        Schema::dropIfExists('perfomers');
    }
}
