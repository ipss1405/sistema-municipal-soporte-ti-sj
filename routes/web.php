<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequerimientoController;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/registro', function () {
    return view('auth.register');
})->name('registro');

Route::get('/funcionario', function () {
    return view('funcionario.dashboard');
})->name('funcionario.dashboard');

Route::get('/requerimientos/crear', function () {
    return view('requerimientos.create');
})->name('requerimientos.create');

Route::get('/requerimientos', function () {
    return redirect('/mis-requerimientos');
});

Route::post('/requerimientos', [RequerimientoController::class, 'store'])
    ->name('requerimientos.store');

Route::get('/mis-requerimientos', [RequerimientoController::class, 'index'])
    ->name('requerimientos.index');

/*
|--------------------------------------------------------------------------
| Rutas de administración
|--------------------------------------------------------------------------
*/

Route::get('/admin/requerimientos', [RequerimientoController::class, 'adminIndex'])
    ->name('admin.requerimientos.index');

Route::get('/admin/requerimientos/{requerimiento}/editar', [RequerimientoController::class, 'edit'])
    ->name('admin.requerimientos.edit');

Route::put('/admin/requerimientos/{requerimiento}', [RequerimientoController::class, 'update'])
    ->name('admin.requerimientos.update');

/*
|--------------------------------------------------------------------------
| Detalle de requerimiento funcionario
|--------------------------------------------------------------------------
*/

Route::get('/requerimientos/{requerimiento}', [RequerimientoController::class, 'show'])
    ->name('requerimientos.show');