<?php

//Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/', '\Featherwebs\Mari\Controllers\HomeController@index')->name('home');

Route::get('/thumbnails/{thumb}')->name('image.thumbs');

Route::get('/home', function () {
    return redirect()->route('admin.home');
});
Route::get('/post/{post}', '\Featherwebs\Mari\Controllers\PostController@show')->name('post');
Route::get('/post', '\Featherwebs\Mari\Controllers\PostController@archive')->name('post.index');

Route::any('{slug}', '\Featherwebs\Mari\Controllers\HomeController@page')->name('page');