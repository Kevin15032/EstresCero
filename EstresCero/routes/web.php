<?php

use App\Http\Controllers\PaginasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController; // Agregar esta línea
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForoController;
use App\Http\Controllers\EmotionalEntryController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RecursoController as AdminRecursoController;
use App\Http\Controllers\Admin\EjercicioController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\EjercicioController as UserEjercicioController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', [PaginasController::class, 'index'])->name('home');

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/registro', [AuthController::class, 'showRegistrationForm'])->name('registro');
    Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Recursos
    Route::get('/recursos', [RecursoController::class, 'index'])->name('recursos.index');
    Route::get('/recursos/{recurso}', [RecursoController::class, 'show'])->name('recursos.show');
    
    // Ejercicios
    Route::get('/ejercicios', [UserEjercicioController::class, 'index'])->name('ejercicios');
    Route::get('/ejercicios/{ejercicio}', [UserEjercicioController::class, 'show'])->name('ejercicios.show');
    
    // Seguimiento
    Route::get('/seguimiento', [EmotionalEntryController::class, 'index'])->name('seguimiento');
    Route::post('/seguimiento', [EmotionalEntryController::class, 'store'])->name('seguimiento.store');
    
    // Foro
    Route::get('/foro', [ForoController::class, 'index'])->name('foro');
    Route::post('/posts', [ForoController::class, 'store'])->name('posts.store');
    Route::post('/comments', [ForoController::class, 'storeComment'])->name('comments.store');
    
    // Perfil
    Route::get('/perfil', [ProfileController::class, 'index'])->name('perfil');
    Route::post('/perfil/update', [ProfileController::class, 'update'])->name('perfil.update');
});

// Rutas de administración
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard de administración
        Route::get('/dashboard', [AdminProfileController::class, 'dashboard'])->name('dashboard');

        // Usuarios
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::patch('/users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');
        Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
        
        // Recursos y Ejercicios
        Route::resource('recursos', AdminRecursoController::class);
        Route::resource('ejercicios', EjercicioController::class);
        
        // Perfil de administrador
        Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    });


