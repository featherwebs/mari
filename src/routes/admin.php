<?php

use \Featherwebs\Mari\Controllers\AdminController;
use \Featherwebs\Mari\Controllers\PostTypeController;
use \Featherwebs\Mari\Controllers\PageTypeController;
use \Featherwebs\Mari\Controllers\ProfileController;
use \Featherwebs\Mari\Controllers\PageController;
use \Featherwebs\Mari\Controllers\PostController;
use \Featherwebs\Mari\Controllers\MenuController;
use \Featherwebs\Mari\Controllers\RoleController;
use \Featherwebs\Mari\Controllers\SettingController;
use \Featherwebs\Mari\Controllers\MediaController;
use \Featherwebs\Mari\Controllers\SupportController;
use \Featherwebs\Mari\Controllers\UserController;

Route::group([ 'middleware' => 'web' ], function () {
    Route::group([ 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:web' ], function () {
        Route::get('/', AdminController::class . '@redirectToIndex');
        Route::get('/home', AdminController::class . '@index')->name('home');

        Route::get('role', RoleController::class.'@index')->name('role.index')->middleware('permission:read-role');
        Route::get('role/create', RoleController::class.'@create')->name('role.create')->middleware('permission:create-role');
        Route::post('role', RoleController::class.'@store')->name('role.store')->middleware('permission:create-role');
        Route::get('role/{role}', RoleController::class.'@show')->name('role.show')->middleware('permission:read-role');
        Route::get('role/{role}/edit', RoleController::class.'@edit')->name('role.edit')->middleware('permission:update-role');
        Route::put('role/{role}', RoleController::class.'@update')->name('role.update')->middleware('permission:update-role');
        Route::delete('role/{role}', RoleController::class.'@destroy')->name('role.destroy')->middleware('permission:delete-role');Route::get('media', MediaController::class.'@index')->name('media.index')->middleware('permission:read-media');

        Route::get('media/create', MediaController::class.'@create')->name('media.create')->middleware('permission:create-media');
        Route::post('media', MediaController::class.'@store')->name('media.store')->middleware('permission:create-media');
        Route::get('media/{medium}', MediaController::class.'@show')->name('media.show')->middleware('permission:read-media');
        Route::get('media/{medium}/edit', MediaController::class.'@edit')->name('media.edit')->middleware('permission:update-media');
        Route::put('media/{medium}', MediaController::class.'@update')->name('media.update')->middleware('permission:update-media');
        Route::delete('media/{medium}', MediaController::class.'@destroy')->name('media.destroy')->middleware('permission:delete-media');

        Route::get('profile', ProfileController::class . '@edit')->name('profile.edit');

        Route::get('page', PageController::class.'@index')->name('page.index')->middleware('permission:read-page');
        Route::get('page/create', PageController::class.'@create')->name('page.create')->middleware('permission:create-page');
        Route::post('page', PageController::class.'@store')->name('page.store')->middleware('permission:create-page');
        Route::get('page/{page}', PageController::class.'@show')->name('page.show')->middleware('permission:read-page');
        Route::get('page/{page}/edit', PageController::class.'@edit')->name('page.edit')->middleware('permission:update-page');
        Route::put('page/{page}', PageController::class.'@update')->name('page.update')->middleware('permission:update-page');
        Route::delete('page/{page}', PageController::class.'@destroy')->name('page.destroy')->middleware('permission:delete-page');

        Route::get('post/{postType}', PostController::class.'@index')->name('post.index')->middleware('permission:read-post');
        Route::get('post/create/{postType}', PostController::class.'@create')->name('post.create')->middleware('permission:create-post');
        Route::post('post', PostController::class.'@store')->name('post.store')->middleware('permission:create-post');
        Route::get('post/{post}', PostController::class.'@show')->name('post.show')->middleware('permission:read-post');
        Route::get('post/{post}/edit', PostController::class.'@edit')->name('post.edit')->middleware('permission:update-post');
        Route::put('post/{post}', PostController::class.'@update')->name('post.update')->middleware('permission:update-post');
        Route::delete('post/{post}', PostController::class.'@destroy')->name('post.destroy')->middleware('permission:delete-post');

        Route::get('menu', MenuController::class.'@index')->name('menu.index')->middleware('permission:read-menu');
        Route::get('menu/create', MenuController::class.'@create')->name('menu.create')->middleware('permission:create-menu');
        Route::post('menu', MenuController::class.'@store')->name('menu.store')->middleware('permission:create-menu');
        Route::get('menu/{menu}', MenuController::class.'@show')->name('menu.show')->middleware('permission:read-menu');
        Route::get('menu/{menu}/edit', MenuController::class.'@edit')->name('menu.edit')->middleware('permission:update-menu');
        Route::put('menu/{menu}', MenuController::class.'@update')->name('menu.update')->middleware('permission:update-menu');
        Route::delete('menu/{menu}', MenuController::class.'@destroy')->name('menu.destroy')->middleware('permission:delete-menu');

        Route::get('user', UserController::class.'@index')->name('user.index')->middleware('permission:read-user');
        Route::get('user/create', UserController::class.'@create')->name('user.create')->middleware('permission:create-user');
        Route::post('user', UserController::class.'@store')->name('user.store')->middleware('permission:create-user');
        Route::get('user/{user}', UserController::class.'@show')->name('user.show')->middleware('permission:read-user');
        Route::get('user/{user}/edit', UserController::class.'@edit')->name('user.edit')->middleware('permission:update-user');
        Route::put('user/{user}', UserController::class.'@update')->name('user.update');
        Route::delete('user/{user}', UserController::class.'@destroy')->name('user.destroy')->middleware('permission:delete-user');

        Route::get('setting', SettingController::class.'@index')->name('setting.index')->middleware('permission:read-setting');
        Route::get('setting/create', SettingController::class.'@create')->name('setting.create')->middleware('permission:create-setting');
        Route::post('setting', SettingController::class.'@store')->name('setting.store')->middleware('permission:create-setting');
        Route::get('setting/{setting}', SettingController::class.'@show')->name('setting.show')->middleware('permission:read-setting');
        Route::put('setting/{setting}', SettingController::class.'@update')->name('setting.update')->middleware('permission:update-setting');
        Route::delete('setting/{setting}', SettingController::class.'@destroy')->name('setting.destroy')->middleware('permission:delete-setting');

        Route::get('post-type', PostTypeController::class.'@index')->name('post-type.index')->middleware('permission:read-post-type');
        Route::get('post-type/create', PostTypeController::class.'@create')->name('post-type.create')->middleware('permission:create-post-type');
        Route::post('post-type', PostTypeController::class.'@store')->name('post-type.store')->middleware('permission:create-post-type');
        Route::get('post-type/{postType}/edit', PostTypeController::class.'@edit')->name('post-type.edit')->middleware('permission:update-post-type');
        Route::put('post-type/{postType}', PostTypeController::class.'@update')->name('post-type.update')->middleware('permission:update-post-type');
        Route::delete('post-type/{postType}', PostTypeController::class.'@destroy')->name('post-type.destroy')->middleware('permission:delete-post-type');

        Route::get('page-type', PageTypeController::class.'@index')->name('page-type.index')->middleware('permission:read-post-type');
        Route::get('page-type/create', PageTypeController::class.'@create')->name('page-type.create')->middleware('permission:create-post-type');
        Route::post('page-type', PageTypeController::class.'@store')->name('page-type.store')->middleware('permission:create-post-type');
        Route::get('page-type/{pageType}/edit', PageTypeController::class.'@edit')->name('page-type.edit')->middleware('permission:update-post-type');
        Route::put('page-type/{pageType}', PageTypeController::class.'@update')->name('page-type.update')->middleware('permission:update-post-type');
        Route::delete('page-type/{pageType}', PageTypeController::class.'@destroy')->name('page-type.destroy')->middleware('permission:delete-post-type');

        Route::resource('support', SupportController::class)->only('index', 'create', 'show');
        Route::get('support/{slug}/message/create', SupportController::class.'@messageCreate')->name('support.message.create');

        if (is_readable(base_path('routes/mari.php')))
        {
            include base_path('routes/mari.php');
        }
    });

    Route::group(['prefix' => 'laraberg', 'middleware' => ['auth:web']], function() {
        Route::apiResource('blocks', 'VanOns\Laraberg\Http\Controllers\BlockController');
        Route::get('oembed', 'VanOns\Laraberg\Http\Controllers\OEmbedController');
    });

    Route::group([ 'prefix' => 'api', 'as' => 'api.' ], function () {
        Route::post('page', PageController::class.'@api')->name('page.datatable');
        Route::post('menu', MenuController::class.'@api')->name('menu.datatable');
        Route::post('post', PostController::class.'@api')->name('post.datatable');
        Route::post('role', RoleController::class.'@api')->name('role.datatable');
        Route::post('user', UserController::class.'@api')->name('user.datatable');
        Route::post('post-type', PostTypeController::class.'@api')->name('post-type.datatable');
        Route::post('page-type', PageTypeController::class.'@api')->name('page-type.datatable');
        Route::post('media', MediaController::class.'@api')->name('media.api');
    });
});