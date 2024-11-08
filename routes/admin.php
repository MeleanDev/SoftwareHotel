<?php

use App\Http\Controllers\Admins\AdministradoreController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\HabitacioneController;
use App\Http\Controllers\Admins\HabitacionEstadoController;
use App\Http\Controllers\Admins\HuespedController;
use App\Http\Controllers\Admins\ModeradoreController;
use App\Http\Controllers\Admins\ReservaController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\Admins\SedeController;
use App\Http\Controllers\Huesped\MisReservascionesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('Sistema')->group(function () {

        // Actualizar Perfil
        Route::controller(ProfileController::class)->group(function () {
            Route::get('Perfil', 'edit')->name('profile.edit');
            Route::patch('Perfil', 'update')->name('profile.update');
            Route::delete('Perfil', 'destroy')->name('profile.destroy');
        });
    
        // Panel principal
        Route::controller(DashboardController::class)->group(function () {
            Route::get('Dashboard', 'index')->name('dashboard');
        });

        // Sede
        Route::controller(SedeController::class)->middleware('can:sedes')->group(function () {
            Route::get('Sedes', 'index')->name('sedes');
            Route::get('Sedes/Lista', 'lista');
            Route::post('Sedes', 'crear');
            Route::get('Sedes/{id}', 'detalle');
            Route::post('Sedes/Editar/{id}', 'editar');
            Route::delete('Sedes/{id}', 'eliminar');
        });

        // Habitaciones
        Route::controller(HabitacioneController::class)->middleware('can:habitaciones')->group(function () {
            Route::get('Habitaciones', 'index')->name('habitaciones');
            Route::get('Habitaciones/Lista', 'lista');
            Route::get('Habitaciones/Lista/Sedes', 'listaSedes');
            Route::post('Habitaciones', 'crear');
            Route::get('Habitaciones/{id}', 'detalle');
            Route::post('Habitaciones/Editar/{id}', 'editar');
            Route::delete('Habitaciones/{id}', 'eliminar');
        }); 

        // Habitaciones Estado
        Route::controller(HabitacionEstadoController::class)->middleware('can:habitacionesEstado')->group(function () {
            Route::get('HabitacionesEstado', 'index')->name('habitacionesEstado');
            Route::get('HabitacionesEstado/Lista', 'lista');
        }); 

        // reserva
        Route::controller(ReservaController::class)->middleware('can:reservas')->group(function () {
            Route::get('Reservas', 'index')->name('reservas');
            Route::get('Reservas/Lista', 'lista');
            Route::get('Reservas/Lista/Habitaciones', 'habitaciones');
            Route::get('Reservas/Lista/Huesped', 'huesped');
            Route::post('Reservas', 'crear');
            Route::get('Reservas/{id}', 'detalle');
            Route::post('Reservas/Editar/{id}', 'editar');
            Route::get('Reservas/Cancelar/{id}', 'cancelar');
            Route::get('Reservas/Activar/{id}', 'activar');
            Route::get('Reservas/Completada/{id}', 'completada');
        });

        // Administradores
        Route::controller(AdministradoreController::class)->middleware('can:administradores')->group(function () {
            Route::get('Administradores', 'index')->name('administradores');
            Route::get('Administradores/Lista', 'lista');
            Route::post('Administradores', 'crear');
            Route::get('Administradores/{id}', 'detalle');
            Route::post('Administradores/Editar/{id}', 'editar');
            Route::delete('Administradores/{id}', 'eliminar');
        });

        // Moderadores
        Route::controller(ModeradoreController::class)->middleware('can:moderadores')->group(function () {
            Route::get('Moderadores', 'index')->name('moderadores');
            Route::get('Moderadores/Lista', 'lista');
            Route::get('Moderadores/Lista/Sedes', 'sedes');
            Route::post('Moderadores', 'crear');
            Route::get('Moderadores/{id}', 'detalle');
            Route::post('Moderadores/Editar/{id}', 'editar');
            Route::delete('Moderadores/{id}', 'eliminar');
        });

        // Huesped
        Route::controller(HuespedController::class)->middleware('can:huesped')->group(function () {
            Route::get('Huesped', 'index')->name('huesped');
            Route::get('Huesped/Lista', 'lista');
            Route::post('Huesped', 'crear');
            Route::get('Huesped/{id}', 'detalle');
            Route::post('Huesped/Editar/{id}', 'editar');
            Route::delete('Huesped/{id}', 'eliminar');
        });

        // Mis Reservaciones
        Route::controller(MisReservascionesController::class)->middleware('can:reservashuesped')->group(function () {
            Route::get('MisReservas', 'index')->name('reservasHuesped');
            Route::get('MisReservas/Lista', 'lista');
            Route::get('MisReservas/Lista/Habitaciones', 'listaHabitaciones');
            Route::get('MisReservas/{id}', 'detalle');
            Route::post('MisReservas', 'crear');
            Route::post('MisReservas/Editar/{id}', 'editar');
            Route::get('MisReservas/Cancelar/{id}', 'cancelar');
        });

        // Recibos
        Route::controller(ReciboController::class)->middleware('can:habitacionesEstado')->group(function () {
            Route::get('Recibos', 'index')->name('recibos');
            Route::get('Recibos/Lista', 'lista');
        });

    });
});