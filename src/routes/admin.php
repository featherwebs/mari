<?php
use \Featherwebs\Mari\Controllers\AdminController;
use \Featherwebs\Mari\Controllers\ProfileController;
use \Featherwebs\Mari\Controllers\PageController;
use \Featherwebs\Mari\Controllers\PostController;
use \Featherwebs\Mari\Controllers\MenuController;
use \Featherwebs\Mari\Controllers\SubMenuController;
use \Featherwebs\Mari\Controllers\SettingController;
use \Featherwebs\Mari\Controllers\MediaController;
use \Featherwebs\Mari\Controllers\UserController;

Route::group([ 'middleware' => 'web' ], function () {
    Route::group([ 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth' ], function () {
        Route::get('/', function () {
            return redirect()->route('admin.home');
        });
        Route::get('/home', AdminController::class . '@index')->name('home');

        Route::resource('media', MediaController::class)->middleware('permission:manage-media');

        Route::get('profile', ProfileController::class . '@edit')->name('profile.edit');
        Route::put('profile', ProfileController::class . '@update')->name('profile.update');

        Route::resource('page', PageController::class)->middleware('permission:manage-page');
        Route::resource('post', PostController::class)->middleware('permission:manage-post');
        Route::resource('menu', MenuController::class)->middleware('permission:manage-menu');
        Route::resource('menu.submenu', SubMenuController::class)->only('store')->middleware('permission:manage-menu');
        Route::resource('user', UserController::class)->middleware('permission:manage-user');

        Route::resource('setting', SettingController::class)->except('edit')->middleware('permission:manage-setting');;
    });
});