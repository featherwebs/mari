<?php

Auth::routes();

Route::get('/', '\Featherwebs\Mari\Controllers\HomeController@index')->name('home');

Route::get('/thumbnails/{thumb}')->name('image.thumbs');

Route::get('/home', function () {
    return redirect()->route('admin.home');
});
Route::get('/post/{post}', '\Featherwebs\Mari\Controllers\PostController@show')->name('post');
Route::get('/post', '\Featherwebs\Mari\Controllers\PostController@archive')->name('post.index');

Route::any('{slug}', '\Featherwebs\Mari\Controllers\HomeController@page')->name('page');