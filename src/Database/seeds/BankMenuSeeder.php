<?php

use Illuminate\Database\Seeder;

class BankMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::updateOrCreate(['id' => 6213] , ['name' => 'bank', 'parent_id' => 2317, 'order' => 713, 'is_menu' => 1, 'url' => '', 'icon' => 'mdi mdi-bank']);

        Permission::updateOrCreate(['id' => 6214], ['name' => 'add_bank', 'parent_id' => 6213, 'is_menu' => 1,
        'order' =>
        714, 'url' => '/admin/bank_panel/create']);

        Permission::updateOrCreate(['id' => 6215], ['name' => 'list_bank', 'parent_id' => 6213, 'is_menu' => 1,
        'order' =>
        715, 'url' => '/admin/bank_panel']);

        ProfilePermission::updateOrCreate(['id' => 1548], ['profile_id' => 3, 'permission_id' => 6213]);
        ProfilePermission::updateOrCreate(['id' => 1549], ['profile_id' => 3, 'permission_id' => 6214]);
        ProfilePermission::updateOrCreate(['id' => 1550], ['profile_id' => 3, 'permission_id' => 6215]);

        $this->command->info('Bank Permissions created!');
    }
}
