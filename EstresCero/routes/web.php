<?php

use App\Http\Controllers\PaginasController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rutas principales
Route::get('/', [PaginasController::class, 'index'])->name('home');
Route::get('/sesion', [PaginasController::class, 'sesion'])->name('sesion');
Route::get('/registro', [PaginasController::class, 'registro'])->name('registro');

// Rutas de autenticación
Route::post('/login', [AuthController::class, 'login'])->name('sesion.post');
Route::post('/register', [AuthController::class, 'register'])->name('registro.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PaginasController::class, 'dashboard'])->name('dashboard');
    Route::get('/recursos', [PaginasController::class, 'recursos'])->name('recursos');
    Route::get('/ejercicios', [PaginasController::class, 'ejercicios'])->name('ejercicios');
    Route::get('/seguimiento', [PaginasController::class, 'seguimiento'])->name('seguimiento');
    Route::get('/foro', [PaginasController::class, 'foro'])->name('foro');
    Route::get('/perfil', [PaginasController::class, 'perfil'])->name('perfil');
});


