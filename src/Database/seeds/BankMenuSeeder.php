<?php

namespace Codificar\Bank\Database\seeds;

use Illuminate\Database\Seeder;
use Permission;
use ProfilePermission;

class BankMenuSeeder extends Seeder
{
    /**
     * Run the database seeds for bank Menu.
     *
     * @return void
     */
    public function run()
    {
        $bank = Permission::updateOrCreate(['name' => 'bank'] , ['name' => 'bank', 'parent_id' => 2317, 'order' => null, 'is_menu' => 1, 'url' => '', 'icon' => 'mdi mdi-bank']);

        $add_bank = Permission::updateOrCreate(['name' => 'add_bank'], ['name' => 'add_bank', 'parent_id' => $bank->id, 'is_menu' => 1, 'order' => null, 'url' => '/admin/banks/create']);

        $list_bank = Permission::updateOrCreate(['name' => 'list_bank'], ['name' => 'list_bank', 'parent_id' => $bank->id, 'is_menu' => 1, 'order' => null, 'url' => '/admin/banks']);

        ProfilePermission::updateOrCreate(['permission_id' => $bank->id], ['profile_id' => 3, 'permission_id' => $bank->id]);
        ProfilePermission::updateOrCreate(['permission_id' => $add_bank->id], ['profile_id' => 3, 'permission_id' => $add_bank->id]);
        ProfilePermission::updateOrCreate(['permission_id' => $list_bank->id], ['profile_id' => 3, 'permission_id' => $list_bank->id]);

        $this->command->info('Bank Permissions created!');
    }
}
