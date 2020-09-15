<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//use Codificar\Bank\Database\seeds\CountrySeeder;

use Codificar\Bank\Models\Country;

class AddCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Artisan::call('db:seed', [
        '--class' => CountrySeeder::class,
        ]);*/
        Country::updateOrCreate(['iso' => 'AO'], ['name' => 'Angola', 'code' => '024', 'phone_code' => '+244', 'created_at' => '2020-08-24 00:00:00', 'updated_at' => '2020-08-24 00:00:00']);
        Country::updateOrCreate(['iso' => 'BR'], ['name' => 'Brasil', 'code' => '076', 'phone_code' => '+55', 'created_at' => '2020-08-24 00:00:00', 'updated_at' => '2020-08-24 00:00:00']);
        Country::updateOrCreate(['iso' => 'CL'], ['name' => 'Chile', 'code' => '152', 'phone_code' => '+56', 'created_at' => '2020-08-24 00:00:00', 'updated_at' => '2020-08-24 00:00:00']);
        Country::updateOrCreate(['iso' => 'PY'], ['name' => 'Paraguai', 'code' => '600', 'phone_code' => '+595', 'created_at' => '2020-08-24 00:00:00', 'updated_at' => '2020-08-24 00:00:00']);
        Country::updateOrCreate(['iso' => 'ES'], ['name' => 'Espanha', 'code' => '724', 'phone_code' => '+34', 'created_at' => '2020-08-24 00:00:00', 'updated_at' => '2020-08-24 00:00:00']);

        $this->command->info('Country table seeded!');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permission', function (Blueprint $table) {
            //
        });
    }
}
