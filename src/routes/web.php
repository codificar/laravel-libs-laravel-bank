<?php

Route::group(array('namespace' => 'Codificar\Bank\Http\Controllers'), function () {

    Route::group(['prefix' => 'libs/bank', 'middleware' => 'auth.provider_api:api'], function () {

        Route::post('/report', 'GenericController@getGenericReport');
    
        Route::post('/add', 'GenericController@addWithDraw');
    });

});
