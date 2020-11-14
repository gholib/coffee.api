<?php

Route::group(['middleware' => 'cors'], function () {
    Route::post('login', 'Auth\AuthController@login');

    Route::get('/images/{path}', 'MediaController@getImage');
});

Route::group(['middleware' => ['auth.jwt', 'cors']], function () {
    Route::get('logout', 'Auth\AuthController@logout');

    Route::group(['prefix' => 'import-types'], function () {
        Route::get('/', 'ImportTypeController@getAll');
    });

    Route::group(['prefix' => 'menu-items', 'middleware' => 'admin'], function () {
        Route::get('/', 'MenuItemController@getAll');
        Route::post('/', 'MenuItemController@store');
        Route::post('/{menu_item_id}', 'MenuItemController@update');
        Route::delete('/{menu_item_id}', 'MenuItemController@destroy');
    });

    Route::post('pay', 'SaleController@store');
    Route::get('calculation', 'SaleController@calculation');

    Route::group(['prefix' => 'import', 'middleware' => 'admin'], function () {
        Route::post('/', 'ImportController@store');
    });
});