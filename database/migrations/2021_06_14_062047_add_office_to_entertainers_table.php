<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfficeToEntertainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entertainers', function (Blueprint $table) {
            $table->unsignedBigInteger('office_id');
            
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
        Schema::table('entertainers', function (Blueprint $table) {
            $table->dropColumn('office_id');
        });
    }
}
