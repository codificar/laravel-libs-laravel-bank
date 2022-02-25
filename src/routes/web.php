<?php

Route::group(array('namespace' => 'Codificar\Bank\Http\Controllers'), function () {
    Route::group(['prefix' => '/api'], function () {
        Route::get('/banks/filter', array('as' => 'BankPanelFilter', 'uses' =>
         'BankPanelController@filter'));
        Route::resource('/banks', 'BankPanelController');
        Route::get('/countries', array('as' => 'Countries', 'uses' => 'CountryController@countries'));
    });
});

Route::group(array('namespace' => 'Codificar\Bank\Http\Controllers'), function () {
    Route::group(['prefix' => '/api/v1'], function () {
        Route::get('/banks/filter', array('as' => 'BankPanelFilter', 'uses' =>
         'BankPanelController@filter'));
        Route::resource('/banks', 'BankPanelController');
        Route::get('/countries', array('as' => 'Countries', 'uses' => 'CountryController@countries'));
    });
});

Route::group(array('namespace' => 'Codificar\Bank\Http\Controllers', 'middleware' => 'auth.admin'), function () {

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
    
    app('debugbar')->disable();
    
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

    return response('window.lang = ' . json_encode($strings) . ';')
            ->header('Content-Type', 'text/javascript');

})->name('assets.lang');

