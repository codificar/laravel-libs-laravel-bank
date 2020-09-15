<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Codificar\Bank\Database\seeds\BankMenuSeeder;

class AddBankToMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Artisan::call('db:seed', [
        '--class' => BankMenuSeeder::class,
        ]);
        */
        $bank = Permission::updateOrCreate(['name' => 'bank'] , ['name' => 'bank', 'parent_id' => 2317, 'order' => null, 'is_menu' => 1, 'url' => '', 'icon' => 'mdi mdi-bank']);
        $add_bank = Permission::updateOrCreate(['name' => 'add_bank'], ['name' => 'add_bank', 'parent_id' => $bank->id, 'is_menu' => 1, 'order' => null, 'url' => '/admin/banks/create']);
        $list_bank = Permission::updateOrCreate(['name' => 'list_bank'], ['name' => 'list_bank', 'parent_id' => $bank->id, 'is_menu' => 1, 'order' => null, 'url' => '/admin/banks']);

        // get all admin profiles
        $profiles = Profile::filter(null, null, 'admin', null, 20);  

        foreach ($profiles as $profile) {
            ProfilePermission::updateOrCreate(['permission_id' => $bank->id], ['profile_id' => $profile->id, 'permission_id' => $bank->id]);
            ProfilePermission::updateOrCreate(['permission_id' => $add_bank->id], ['profile_id' => $profile->id, 'permission_id' => $add_bank->id]);
            ProfilePermission::updateOrCreate(['permission_id' => $list_bank->id], ['profile_id' => $profile->id, 'permission_id' => $list_bank->id]);
        }
        
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
