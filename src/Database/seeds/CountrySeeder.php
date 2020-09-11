<?php

namespace Codificar\Bank\Database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Codificar\Bank\Models\Country;

use Permission;
use ProfilePermission;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds for bank Menu.
     *
     * @return void
     */
    public function run()
    {
        Country::updateOrCreate(['iso' => 'AO'], ['name' => 'Angola', 'code' => '024', 'phone_code' => '+244', 'created_at' => '2020-08-24 00:00:00', 'updated_at' => '2020-08-24 00:00:00']);
        Country::updateOrCreate(['iso' => 'BR'], ['name' => 'Brasil', 'code' => '076', 'phone_code' => '+55', 'created_at' => '2020-08-24 00:00:00', 'updated_at' => '2020-08-24 00:00:00']);
        Country::updateOrCreate(['iso' => 'CL'], ['name' => 'Chile', 'code' => '152', 'phone_code' => '+56', 'created_at' => '2020-08-24 00:00:00', 'updated_at' => '2020-08-24 00:00:00']);
        Country::updateOrCreate(['iso' => 'PY'], ['name' => 'Paraguai', 'code' => '600', 'phone_code' => '+595', 'created_at' => '2020-08-24 00:00:00', 'updated_at' => '2020-08-24 00:00:00']);
        Country::updateOrCreate(['iso' => 'ES'], ['name' => 'Espanha', 'code' => '724', 'phone_code' => '+34', 'created_at' => '2020-08-24 00:00:00', 'updated_at' => '2020-08-24 00:00:00']);

        $this->command->info('Country table seeded!');

    }
}
