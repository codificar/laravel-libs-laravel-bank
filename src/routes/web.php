<?php

Route::group(array('namespace' => 'Codificar\Bank\Http\Controllers'), function () {
    Route::group(['prefix' => '/api'], function () {
        Route::post('/banks/filter', array('as' => 'BankPanelFilter', 'uses' =>
         'BankPanelController@filter'));
        Route::resource('/banks', 'BankPanelController');
    });
});

Route::group(array('namespace' => 'Codificar\Bank\Http\Controllers', 'before' => 'auth.admin', 'middleware' => 'auth.admin'), function () {

    Route::group(['prefix' => '/admin'], function () {

        //Bank Panel
        Route::get('/banks', array('as' => 'PanelBank', 'uses' => 'BankController@index'));
        //Create Bank
        Route::get('/banks/create', array('as' => 'CreateBank', 'uses' => 'BankController@create'));
        //Edit Bank
        Route::get('/banks/update/{id}', array('as' => 'UpdateBank', 'uses' => 'BankController@update'));
        
    });

});

/**
 * Rota para permitir utilizar arquivos de traducao do laravel (dessa lib) no vue js
 */
Route::get('/libs/lang.trans/{file}', function () {
    $fileNames = explode(',', Request::segment(3));
    $lang = config('app.locale');
    $files = array();
    foreach ($fileNames as $fileName) {
        array_push($files, __DIR__.'/../resources/lang/' . $lang . '/' . $fileName . '.php');
    }
    $strings = [];
    foreach ($files as $file) {
        $name = basename($file, '.php');
        $strings[$name] = require $file;
    }

    header('Content-Type: text/javascript');
    return ('window.lang = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');

