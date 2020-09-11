<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank', function(Blueprint $table)
		{
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank', function($table)
		{
            $table->dropColumn('country_id');
        });
    }
}
