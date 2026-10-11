<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('films', FilmController::class)
    ->only([
        'index',
        'show',
        'create',
        'store',
        'edit',
        'update',
        'destroy',
    ]);
