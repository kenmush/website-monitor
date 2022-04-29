<?php

use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('project',ProjectsController::class);
});

