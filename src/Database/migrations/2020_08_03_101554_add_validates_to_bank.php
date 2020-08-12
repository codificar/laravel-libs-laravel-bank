<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValidatesToBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank', function (Blueprint $table) {
            $table->integer('agency_max_length')->nullable()->default(4);

            $table->boolean('agency__digit_required')->nullable()->default(false);
            $table->integer('agency__digit_max_length')->nullable()->default(1);

            $table->integer('account_max_length')->nullable()->default(11);

            $table->boolean('account__digit_required')->nullable()->default(true);
            $table->integer('account_digit_max_length')->nullable()->default(1);           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank', function (Blueprint $table) {
            $table->dropColumn('agency_max_length');
            $table->dropColumn('agency__digit_required');
            $table->dropColumn('agency__digit_max_length');
            $table->dropColumn('account_max_length');
            $table->dropColumn('account__digit_required');
            $table->dropColumn('account_digit_max_length');
        });
    }
}
