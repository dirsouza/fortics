<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('sessions')->group(function () {
        Route::get('/', 'SessionController@list')->name('session.list');
        Route::post('create', 'SessionController@create')->name('session.create');
        Route::delete('{identifier}', 'SessionController@delete')->name('session.delete');
        Route::post('upload', 'SessionController@upload')->name('session.upload');
    });

});
