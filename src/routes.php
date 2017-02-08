<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'admin']], function() {
    Route::get('/', 'BenjaminChen\Admin\Controllers\AdminController@index');

    Route::get('login', 'BenjaminChen\Admin\Controllers\AuthController@getLogin');
    Route::post('login', 'BenjaminChen\Admin\Controllers\AuthController@postLogin');
    Route::get('logout', 'BenjaminChen\Admin\Controllers\AuthController@getLogout');

    Route::resource('manager', 'BenjaminChen\Admin\Controllers\AdminUserController');
    Route::resource('{model}', 'BenjaminChen\Admin\Controllers\ModelController', [
        'only' =>['index', 'create', 'store'],
    ]);
    Route::get('{model}/{key}', 'BenjaminChen\Admin\Controllers\ModelController@show');
    Route::get('{model}/{key}/edit', 'BenjaminChen\Admin\Controllers\ModelController@edit');
    Route::put('{model}/{key}', 'BenjaminChen\Admin\Controllers\ModelController@update');
    Route::delete('{model}/{key}', 'BenjaminChen\Admin\Controllers\ModelController@destroy');
});
