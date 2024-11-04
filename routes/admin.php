<?php

use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\HabitacioneController;
use App\Http\Controllers\Admins\SedeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('Sistema')->group(function () {

        // Actualizar Perfil
        Route::controller(ProfileController::class)->group(function () {
            Route::get('Perfil', 'edit')->name('profile.edit');
            Route::patch('Perfil', 'update')->name('profile.update');
            // Route::delete('Perfil', 'destroy')->name('profile.destroy');
        });
    
        // Panel principal
        Route::controller(DashboardController::class)->group(function () {
            Route::get('Dashboard', 'index')->name('dashboard');
        });

        // Sede
        Route::controller(SedeController::class)->group(function () {
            Route::get('Sedes', 'index')->name('sede');
            Route::get('Sedes/Lista', 'lista');
            Route::post('Sedes', 'crear');
            Route::get('Sedes/{id}', 'detalle');
            Route::post('Sedes/Editar/{id}', 'editar');
            Route::delete('Sedes/{id}', 'eliminar');
        });

        // Habitaciones
        Route::controller(HabitacioneController::class)->group(function () {
            Route::get('Habitaciones', 'index')->name('habitaciones');
            Route::get('Habitaciones/Lista', 'lista');
            Route::get('Habitaciones/Lista/Sedes', 'listaSedes');
            Route::post('Habitaciones', 'crear');
            Route::get('Habitaciones/{id}', 'detalle');
            Route::post('Habitaciones/Editar/{id}', 'editar');
            Route::delete('Habitaciones/{id}', 'eliminar');
        });

        

    });
});