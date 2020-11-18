<?php

Route::group(['middleware' => 'cors'], function () {
    Route::post('login', 'Auth\AuthController@login');

    Route::get('/images/{path}', 'MediaController@getImage');
});

Route::get('/test', function () {
    $calculations = \App\Sale::select(\Illuminate\Support\Facades\DB::raw('COUNT(menu_item_id) as count'),
        'menu_items.price',
        'menu_items.cost_price',
        'menu_items.display_name',
        'import_types.display_name as import_display_name',
        'import_types.price as import_price')
        ->join('menu_items', function ($join) {
            $join->on('sales.menu_item_id', '=', 'menu_items.id');
        })
        ->join('import_types', function ($join) {
            $join->on('menu_items.import_type_id', '=', 'import_types.id');
        })
        ->groupBy('menu_items.import_type_id')
        ->get()->toArray();
    $imports = \App\Import::select(\Illuminate\Support\Facades\DB::raw('COUNT(import_type_id) as count'),
        \Illuminate\Support\Facades\DB::raw('SUM(quantity) as import_quantity'),
        'import_types.name as import_name')
        ->groupBy('import_type_id')
        ->get()->toArray();
    dd($calculations);
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