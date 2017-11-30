<?php

use \Featherwebs\Mari\Controllers\HomeController;

Auth::routes();

Route::get('/', HomeController::class . '@index')->name('home');

Route::get('/thumbnails/{thumb}')->name('image.thumbs');

Route::get('/home', function () {
    return redirect()->route('admin.home');
});

Route::any('{slug}', HomeController::class . '@page')->name('page');