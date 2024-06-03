<?php
namespace Codificar\Bank;
use Illuminate\Support\ServiceProvider;

class BankServiceProvider extends ServiceProvider {

    public function register()
    {
        // $this->app->register(BankServiceProvider::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'bank');

        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');

        // Load trans files (Carrega tos arquivos de traducao) 
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'trans');

        // Publish the VueJS files inside public folder of main project (Copia os arquivos do vue minificados dessa biblioteca para pasta public do projeto que instalar essa lib)
        $this->publishes([
            __DIR__.'/../public/js' => public_path('vendor/codificar/bank'),
        ], 'public_vuejs_libs');

        // Publish the seeders
        $this->publishes([
            __DIR__.'/Database/seeders' => database_path('seeders')
        ], 'public_vuejs_libs');

        // Publish the tests files 
        $this->publishes([
            __DIR__ . '/../tests/' => base_path('tests/Unit/libs/bank'),
        ], 'publishes_tests');
        
    }

}
?>