<?php

use Illuminate\Database\Migrations\Migration;

class RunUnitedKingdomCountrySeeder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed --class=UnitedKingdomCountrySeeder');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
