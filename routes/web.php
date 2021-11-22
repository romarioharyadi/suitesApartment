<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\Banner\AdminBannerController;
use App\Http\Controllers\Room\AdminRoomController;
use App\Http\Controllers\Tipe\AdminTipeController;


Route::get('/','App\Http\Controllers\MasterController@index')->name('index');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::prefix('banner') -> name('banner.')->group(function(){
        Route::get('/index','App\Http\Controllers\Banner\AdminBannerController@index')->name('index');
        Route::get('/apiData', 'App\Http\Controllers\Banner\AdminBannerController@apiData')->name('apiData');
        Route::post('/saveBanner', 'App\Http\Controllers\Banner\AdminBannerController@save')->name('save');
        Route::post('/deleteBanner', 'App\Http\Controllers\Banner\AdminBannerController@delete')->name('delete');
    });
    Route::prefix('room') -> name('room.')->group(function(){
        Route::get('/index','App\Http\Controllers\Room\AdminRoomController@index')->name('index');
        Route::get('/apiData', 'App\Http\Controllers\Room\AdminRoomController@apiData')->name('apiData');
        Route::post('/saveRoom', 'App\Http\Controllers\Room\AdminRoomController@save')->name('save');
        Route::get('/editRoom', 'App\Http\Controllers\Room\AdminRoomController@edit')->name('edit');
        Route::post('/updateRoom', 'App\Http\Controllers\Room\AdminRoomController@update')->name('update');
        Route::post('/deleteRoom', 'App\Http\Controllers\Room\AdminRoomController@delete')->name('delete');
        //getTipe
        Route::get('/getTipe', 'App\Http\Controllers\Room\AdminRoomController@getTipe')->name('apiTipe');
    });
    Route::prefix('tipe') -> name('tipe.')->group(function(){
        Route::get('/index','App\Http\Controllers\Tipe\AdminTipeController@index')->name('index');
        Route::get('/apiData', 'App\Http\Controllers\Tipe\AdminTipeController@apiData')->name('apiData');
        Route::post('/saveTipe', 'App\Http\Controllers\Tipe\AdminTipeController@save')->name('save');
        Route::get('/editTipe', 'App\Http\Controllers\Tipe\AdminTipeController@edit')->name('edit');
        Route::post('/updateTipe', 'App\Http\Controllers\Tipe\AdminTipeController@update')->name('update');
        Route::post('/deleteTipe', 'App\Http\Controllers\Tipe\AdminTipeController@delete')->name('delete');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
