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

    <div class="row">
        <!-- Recursos Recientes -->
        <div class="col-md-6 mb-4">
            <h2 class="section-title">
                <i class="fas fa-book-open"></i> Recursos Recientes
            </h2>
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($recursosRecientes as $recurso)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $recurso->titulo }}</h6>
                                    <small class="text-muted">{{ $recurso->created_at->diffForHumans() }}</small>
                                </div>
                                <a href="{{ route('recursos.index') }}" class="btn btn-sm btn-custom">
                                    Leer <i class="fas fa-arrow-right"></i>
                                </a>
                            </li>
                        @empty
                            <li class="list-group-item">No hay recursos disponibles</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Ejercicios Destacados -->
        <div class="col-md-6 mb-4">
            <h2 class="section-title">
                <i class="fas fa-running"></i> Ejercicios Destacados
            </h2>
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($ejerciciosDestacados as $ejercicio)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $ejercicio->titulo }}</h6>
                                    <small class="text-muted">{{ $ejercicio->duracion }} minutos · {{ $ejercicio->categoria }}</small>
                                </div>
                                <a href="{{ route('ejercicios') }}" class="btn btn-sm btn-custom">
                                    Comenzar <i class="fas fa-arrow-right"></i>
                                </a>
                            </li>
                        @empty
                            <li class="list-group-item">No hay ejercicios destacados</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Seguimiento Emocional -->
        <div class="col-md-6 mb-4">
            <h2 class="section-title">
                <i class="fas fa-chart-line"></i> Tu Seguimiento
            </h2>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h6>Nivel de Estrés Semanal</h6>
                        <div class="progress">
                            <div class="progress-bar {{ $nivelEstres > 66 ? 'bg-danger' : ($nivelEstres > 33 ? 'bg-warning' : 'bg-success') }}" 
                                 style="width: {{ $nivelEstres }}%">
                                {{ $nivelEstres > 66 ? 'Alto' : ($nivelEstres > 33 ? 'Medio' : 'Bajo') }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">
                            Último registro: {{ $ultimoRegistro ? $ultimoRegistro->date->diffForHumans() : 'Sin registros' }}
                        </small>
                        <a href="{{ route('seguimiento') }}" class="btn btn-sm btn-custom">Actualizar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Foro Actualizaciones -->
        <div class="col-md-6 mb-4">
            <h2 class="section-title">
                <i class="fas fa-comments"></i> Actividad del Foro
            </h2>
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($postsRecientes as $post)
                            <li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $post->titulo }}</h6>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                                <small class="text-muted">{{ $post->comments->count() }} respuestas</small>
                            </li>
                        @empty
                            <li class="list-group-item">No hay actividad reciente en el foro</li>
                        @endforelse
                    </ul>
                    <div class="text-end mt-3">
                        <a href="{{ route('foro') }}" class="btn btn-sm btn-custom">Ver Foro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('estilos')
<style>
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        border-radius: 8px;
    }
    
    .btn-custom {
        background-color: #1D3557;
        color: white;
    }
    
    .btn-custom:hover {
        background-color: #457B9D;
        color: white;
    }
    
    .section-title {
        color: #1D3557;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .progress {
        height: 1.5rem;
        border-radius: 0.75rem;
    }
</style>
@endsection