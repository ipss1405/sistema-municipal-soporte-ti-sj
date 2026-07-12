<?php

use Illuminate\Support\Facades\Route;

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