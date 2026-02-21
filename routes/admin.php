<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\FuncionarioController;
use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

/* Gestion */
Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
Route::resource('plantillas', \App\Http\Controllers\Admin\PlantillaController::class);
Route::resource('funcionarios', \App\Http\Controllers\Admin\FuncionarioController::class);
Route::get('funcionarios/{funcionario}/schedules', [FuncionarioController::class, 'schedules'])->name('funcionarios.schedules');

Route::get('appointments/{appointment}/consultation',[AppointmentController::class, 'consultation'])
    ->name('appointments.consultation');
Route::resource('appointments', \App\Http\Controllers\Admin\AppointmentController::class);

Route::get('calendar',[CalendarController::class, 'index'])->name('calendar.index');
