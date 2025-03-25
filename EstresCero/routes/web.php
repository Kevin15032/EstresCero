<?php

use App\Http\Controllers\PaginasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForoController;
use App\Http\Controllers\EmotionalEntryController;
use App\Models\Post;
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
    Route::get('/seguimiento', [EmotionalEntryController::class, 'index'])->name('seguimiento');
    Route::post('/seguimiento', [EmotionalEntryController::class, 'store'])->name('seguimiento.store');
    Route::get('/foro', [ForoController::class, 'index'])->name('foro');
    Route::get('/perfil', [ProfileController::class, 'index'])->name('perfil');
    Route::post('/perfil/update', [ProfileController::class, 'update'])->name('perfil.update');
    Route::post('/posts', [ForoController::class, 'store'])->name('posts.store');
    Route::post('/comments', [ForoController::class, 'storeComment'])->name('comments.store');
});


