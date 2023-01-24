<?php

namespace Codificar\Bank\Database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Codificar\Bank\Models\Country;

use Permission;
use ProfilePermission;

class UnitedKingdomCountrySeeder extends Seeder
{
    /**
     * Run the database seeds for bank Menu.
     *
     * @return void
     */
    public function run()
    {
        Country::updateOrCreate(
            ['iso' => 'GB'],
            [
                'name' => 'United Kingdom',
                'code' => '826',
                'phone_code' => '+44',
                'created_at' => '2022-1-17 00:00:00',
                'updated_at' => '2022-1-17 00:00:00']
        );

        $this->command->info('Country UNITED KINGDOM seeded!');

    }
}
