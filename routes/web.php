<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
