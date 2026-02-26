<?php

use Illuminate\Support\Facades\Route;


Route::redirect('/', '/admin');

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    /* Route::resource('admin.roles', \App\Http\Controllers\Admin\RoleController::class); */

});
