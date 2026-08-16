<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequerimientoController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TecnicoDashboardController;

/*
|--------------------------------------------------------------------------
| Ruta principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('inicio');
});

/*
|--------------------------------------------------------------------------
| Rutas de autenticación
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.procesar');

Route::get('/registro', [AuthController::class, 'showRegister'])
    ->name('registro');

Route::post('/registro', [AuthController::class, 'register'])
    ->name('registro.procesar');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Rutas protegidas del sistema
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Panel funcionario
    |--------------------------------------------------------------------------
    */

    Route::get('/funcionario', function () {
        return view('funcionario.dashboard');
    })->name('funcionario.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Panel técnico TI
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/tecnico',
        [TecnicoDashboardController::class, 'index']
    )->name('tecnico.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Gestión técnica de requerimientos
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/tecnico/requerimientos/{requerimiento}/gestionar',
        [TecnicoDashboardController::class, 'gestionar']
    )->name('tecnico.requerimientos.gestionar');

    Route::put(
        '/tecnico/requerimientos/{requerimiento}/gestionar',
        [TecnicoDashboardController::class, 'actualizarGestion']
    )->name('tecnico.requerimientos.update');

    /*
    |--------------------------------------------------------------------------
    | Panel administrador
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/dashboard',
        [AdminDashboardController::class, 'index']
    )->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Notificaciones
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/notificaciones',
        [NotificacionController::class, 'index']
    )->name('notificaciones.index');

    Route::get(
        '/notificaciones/contador',
        [NotificacionController::class, 'contador']
    )->name('notificaciones.contador');

    /*
    |--------------------------------------------------------------------------
    | Requerimientos del funcionario
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/requerimientos/crear',
        [RequerimientoController::class, 'create']
    )->name('requerimientos.create');

    Route::post(
        '/requerimientos',
        [RequerimientoController::class, 'store']
    )->name('requerimientos.store');

    Route::get(
        '/mis-requerimientos',
        [RequerimientoController::class, 'index']
    )->name('requerimientos.index');

    Route::get('/requerimientos', function () {
        return redirect('/mis-requerimientos');
    });

    /*
    |--------------------------------------------------------------------------
    | Administración de requerimientos
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/requerimientos',
        [RequerimientoController::class, 'adminIndex']
    )->name('admin.requerimientos.index');

    Route::get(
        '/admin/requerimientos/{requerimiento}/editar',
        [RequerimientoController::class, 'edit']
    )->name('admin.requerimientos.edit');

    Route::put(
        '/admin/requerimientos/{requerimiento}',
        [RequerimientoController::class, 'update']
    )->name('admin.requerimientos.update');

    Route::delete(
        '/admin/requerimientos/{requerimiento}',
        [RequerimientoController::class, 'destroy']
    )->name('admin.requerimientos.destroy');

    /*
    |--------------------------------------------------------------------------
    | Detalle de requerimiento
    |--------------------------------------------------------------------------
    | Debe permanecer al final para evitar conflictos.
    */

    Route::get(
        '/requerimientos/{requerimiento}',
        [RequerimientoController::class, 'show']
    )->name('requerimientos.show');
});