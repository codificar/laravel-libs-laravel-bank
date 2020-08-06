<?php
namespace Codificar\Bank;
use Illuminate\Support\ServiceProvider;

class BankServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'bank');

        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
    }

    public function register()
    {

    }
}
?>