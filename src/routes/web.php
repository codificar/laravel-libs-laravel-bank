<?php

Route::group(array('namespace' => 'Codificar\Bank\Http\Controllers'), function () {
    Route::group(['prefix' => '/libs/bank'], function () {
        Route::post('/bank_panel/filter', array('as' => 'BankPanelFilter', 'uses' =>
         'BankPanelController@filter'));
        Route::resource('/bank_panel', 'BankPanelController');
    });
});

Route::group(array('namespace' => 'Codificar\Bank\Http\Controllers', 'before' => 'auth.admin', 'middleware' => 'auth.admin'), function () {

    Route::group(['prefix' => '/admin'], function () {

        //Bank Panel
        Route::get('/bank_panel', array('as' => 'PanelBank', 'uses' => 'BankController@index'));
        //Create Bank
        Route::get('/bank_panel/create', array('as' => 'CreateBank', 'uses' => 'BankController@create'));
        //Edit Bank
        Route::get('/bank_panel/update/{id}', array('as' => 'UpdateBank', 'uses' => 'BankController@update'));
        
    });

});
