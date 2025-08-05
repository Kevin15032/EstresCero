@extends('layouts.navprincipal')

@section('titulo', 'Panel Principal')

@section('contenido')
<main class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Recursos Recientes -->
        <div class="col-md-6 animated-card" style="animation-delay: 0s;">
            <h2 class="section-title"><i class="fas fa-book-open me-2"></i>Recursos Recientes</h2>
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($recursosRecientes as $recurso)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $recurso->titulo }}</h6>
                                    <small class="text-muted">{{ $recurso->created_at->diffForHumans() }}</small>
                                </div>
                                <a href="{{ route('recursos.index') }}" class="btn btn-outline-primary btn-sm">Leer <i class="fas fa-arrow-right"></i></a>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No hay recursos disponibles</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Ejercicios Destacados -->
        <div class="col-md-6 animated-card" style="animation-delay: 0.1s;">
            <h2 class="section-title"><i class="fas fa-dumbbell me-2"></i>Ejercicios Destacados</h2>
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($ejerciciosDestacados as $ejercicio)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $ejercicio->titulo }}</h6>
                                    <small class="text-muted">{{ $ejercicio->duracion }} minutos · {{ $ejercicio->categoria }}</small>
                                </div>
                                <a href="{{ route('ejercicios') }}" class="btn btn-outline-success btn-sm">Comenzar <i class="fas fa-play"></i></a>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No hay ejercicios disponibles</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Seguimiento Emocional -->
        <div class="col-md-6 animated-card" style="animation-delay: 0.2s;">
            <h2 class="section-title"><i class="fas fa-heartbeat me-2"></i>Tu Seguimiento</h2>
            <div class="card shadow-sm border-0 bg-light" style="border-radius: 16px;">
                <div class="card-body">
                    <h6 class="mb-2 text-secondary">Nivel de Estrés Semanal</h6>
                    <div class="d-flex align-items-center mb-3">
                        @php
                            $nivelTexto = $nivelEstres > 66 ? 'Alto' : ($nivelEstres > 33 ? 'Medio' : 'Bajo');
                            $emoji = $nivelTexto === 'Alto' ? '😣' : ($nivelTexto === 'Medio' ? '😐' : '😊');
                            $color = $nivelTexto === 'Alto' ? 'bg-danger' : ($nivelTexto === 'Medio' ? 'bg-warning' : 'bg-success');
                        @endphp
                        <span class="me-2 fs-4">{{ $emoji }}</span>
                        <div class="progress w-100" style="height: 1.5rem; border-radius: 1rem; overflow: hidden;">
                            <div class="progress-bar {{ $color }}" style="width: {{ $nivelEstres }}%">
                                {{ $nivelTexto }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Último registro: {{ $ultimoRegistro ? $ultimoRegistro->date->diffForHumans() : 'Sin registros aún' }}
                        </small>
                        <a href="{{ route('seguimiento') }}" class="btn btn-outline-primary rounded-pill">
                            <i class="fas fa-pen"></i> Registrar Hoy
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actividad del Foro -->
        <div class="col-md-6 animated-card" style="animation-delay: 0.3s;">
            <h2 class="section-title"><i class="fas fa-comments me-2"></i>Actividad del Foro</h2>
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($postsRecientes as $post)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">{{ $post->titulo }}</h6>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                                <small class="text-muted">{{ $post->comments->count() }} respuestas</small>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No hay actividad reciente en el foro</li>
                        @endforelse
                    </ul>
                    <div class="text-end mt-3">
                        <a href="{{ route('foro') }}" class="btn btn-outline-info btn-sm">Ver Foro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('estilos')
<style>
    .section-title {
        color: #1D3557;
        border-bottom: 2px solid #457B9D;
        padding-bottom: 10px;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }

    .progress {
        background-color: #dee2e6;
        height: 1.5rem;
        border-radius: 0.75rem;
    }

    .btn-outline-primary, .btn-outline-success, .btn-outline-secondary, .btn-outline-info {
        border-radius: 20px;
    }

    .card {
        border-radius: 10px;
    }

    .progress-bar {
        font-weight: 500;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Animaciones */
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animated-card {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }
</style>
@endsection
