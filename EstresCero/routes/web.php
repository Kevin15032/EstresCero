<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Controladores
use App\Http\Controllers\PaginasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForoController;
use App\Http\Controllers\EmotionalEntryController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\EjercicioController as UserEjercicioController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Admin
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RecursoController as AdminRecursoController;
use App\Http\Controllers\Admin\EjercicioController;
use App\Http\Controllers\Admin\AdminProfileController;

//
// 🏠 RUTA PRINCIPAL
//
Route::get('/', [PaginasController::class, 'index'])->name('home');

//
// 🔐 AUTENTICACIÓN
//
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/registro', [AuthController::class, 'showRegistrationForm'])->name('registro');
    Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//
// 👤 USUARIO AUTENTICADO
//
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil Usuario
    Route::get('/perfil', [ProfileController::class, 'index'])->name('perfil');
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/perfil/cancelar', [ProfileController::class, 'cancel'])->name('profile.cancel');
    Route::post('/perfil/update', [ProfileController::class, 'update'])->name('perfil.update');

    // Recursos
    Route::get('/recursos', [RecursoController::class, 'index'])->name('recursos.index');
    Route::get('/recursos/{recurso}', [RecursoController::class, 'show'])->name('recursos.show');

    // Ejercicios
    Route::get('/ejercicios', [UserEjercicioController::class, 'index'])->name('ejercicios');
    Route::get('/ejercicios/{ejercicio}', [UserEjercicioController::class, 'show'])->name('ejercicios.show');

    // Seguimiento emocional
    Route::get('/seguimiento', [EmotionalEntryController::class, 'index'])->name('seguimiento');
    Route::post('/seguimiento', [EmotionalEntryController::class, 'store'])->name('seguimiento.store');

    // Foro
    Route::get('/foro', [ForoController::class, 'index'])->name('foro');
    Route::post('/posts', [ForoController::class, 'store'])->name('posts.store');
    Route::post('/comments', [ForoController::class, 'storeComment'])->name('comments.store');
});

//
// ⚙️ ADMINISTRACIÓN
//
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminProfileController::class, 'dashboard'])->name('dashboard');

        // Perfil del administrador
        Route::get('/perfil', [AdminProfileController::class, 'index'])->name('perfil');
        Route::get('/perfil/editar', [AdminProfileController::class, 'edit'])->name('perfil.edit');
        Route::put('/perfil', [AdminProfileController::class, 'update'])->name('perfil.update');

        // Gestión de usuarios
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::patch('/users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');
        Route::get('/users/search', [UserController::class, 'search'])->name('users.search');

        // Recursos y Ejercicios
        Route::resource('recursos', AdminRecursoController::class);
        Route::resource('ejercicios', EjercicioController::class);
    });

//
// 🔄 RECUPERACIÓN DE CONTRASEÑA
//
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

//
// ✉️ VERIFICACIÓN DE CORREO (desactivada temporalmente)
//
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', '¡Correo de verificación reenviado!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
