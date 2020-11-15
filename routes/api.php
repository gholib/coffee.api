<?php

Route::group(['middleware' => 'cors'], function () {
    Route::post('login', 'Auth\AuthController@login');

    Route::get('/images/{path}', 'MediaController@getImage');
});

Route::group(['middleware' => ['auth.jwt', 'cors']], function () {
    Route::get('logout', 'Auth\AuthController@logout');

    Route::group(['prefix' => 'branches'], function () {
        Route::get('/', 'BranchController@getAll');
    });

    Route::group(['prefix' => 'import-types'], function () {
        Route::get('/', 'ImportTypeController@getAll');
        Route::post('/', 'ImportTypeController@store')->middleware('admin');
        Route::post('/{import_type_id}', 'ImportTypeController@update')->middleware('admin');
        Route::delete('/{import_type_id}', 'ImportTypeController@destroy')->middleware('admin');
    });

    Route::group(['prefix' => 'menu-items'], function () {
        Route::get('/', 'MenuItemController@getAll');
        Route::post('/', 'MenuItemController@store')->middleware('admin');
        Route::post('/{menu_item_id}', 'MenuItemController@update')->middleware('admin');
        Route::delete('/{menu_item_id}', 'MenuItemController@destroy')->middleware('admin');
    });

    Route::post('pay', 'SaleController@store');
    Route::get('calculation', 'SaleController@calculation')->middleware('admin');
    Route::get('leftovers', 'SaleController@getLeftOvers')->middleware('admin');

    Route::group(['prefix' => 'import', 'middleware' => 'admin'], function () {
        Route::post('/', 'ImportController@store');
    });
});