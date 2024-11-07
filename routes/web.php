<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('software.externo.index');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
