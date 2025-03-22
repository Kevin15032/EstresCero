@extends('layouts.navprincipal')

@section('titulo', 'Ejercicios')

@section('estilos')
<style>
    .exercise-card {
        transition: transform 0.3s ease;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .exercise-card:hover {
        transform: translateY(-5px);
    }
    .duration-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #457B9D;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
    }
</style>
@endsection

@section('contenido')
<main class="container py-2">
    <!-- Carousel de Destacados -->
    <div id="featuredExercises" class="carousel slide mb-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-caption">
                    <h3>Meditación Guiada</h3>
                    <p>Encuentra tu paz interior con nuestras sesiones de meditación.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredExercises" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredExercises" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Filtros de Categorías -->
    <div class="text-center mb-3">
        <div class="btn-group" role="group">
            <button class="btn btn-custom">Todos</button>
            <button class="btn btn-custom">Meditación</button>
            <button class="btn btn-custom">Yoga</button>
            <button class="btn btn-custom">Respiración</button>
        </div>
    </div>

    <!-- Grid de Ejercicios -->
    <div class="row g-4">
        <!-- Ejercicio de Meditación -->
        <div class="col-md-4">
            <div class="exercise-card card h-100">
                <div class="card-body position-relative">
                    <span class="duration-badge">15 min</span>
                    <div class="text-center mb-3">
                        <i class="fas fa-meditation text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="card-title">Meditación para Principiantes</h5>
                    <p class="card-text">Aprende las bases de la meditación con esta sesión guiada perfecta para comenzar.</p>
                    <button class="btn btn-custom w-100">Iniciar Sesión</button>
                </div>
            </div>
        </div>

        <!-- Ejercicio de Yoga -->
        <div class="col-md-4">
            <div class="exercise-card card h-100">
                <div class="card-body position-relative">
                    <span class="duration-badge">20 min</span>
                    <div class="text-center mb-3">
                        <i class="fas fa-pray text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="card-title">Yoga para el Estrés</h5>
                    <p class="card-text">Secuencia de yoga suave diseñada específicamente para reducir el estrés académico.</p>
                    <button class="btn btn-custom w-100">Iniciar Sesión</button>
                </div>
            </div>
        </div>

        <!-- Ejercicio de Respiración -->
        <div class="col-md-4">
            <div class="exercise-card card h-100">
                <div class="card-body position-relative">
                    <span class="duration-badge">10 min</span>
                    <div class="text-center mb-3">
                        <i class="fas fa-wind text-info" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="card-title">Respiración 4-7-8</h5>
                    <p class="card-text">Técnica de respiración probada para calmar la ansiedad rápidamente.</p>
                    <button class="btn btn-custom w-100">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection