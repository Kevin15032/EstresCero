<?php

use App\Http\Controllers\PaginasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PaginasController::class, 'index'])->name('home');
Route::get('/sesion', [PaginasController::class, 'sesion'])->name('sesion');
Route::get('/registro', [PaginasController::class, 'registro'])->name('registro');
Route::get('/dashboard', [PaginasController::class, 'dashboard'])->name('dashboard');
Route::get('/recursos', [PaginasController::class, 'recursos'])->name('recursos');
Route::get('/ejercicios', [PaginasController::class, 'ejercicios'])->name('ejercicios');
Route::get('/seguimiento', [PaginasController::class, 'seguimiento'])->name('seguimiento');
Route::get('/foro', [PaginasController::class, 'foro'])->name('foro');
Route::get('/perfil', [PaginasController::class, 'perfil'])->name('perfil');


