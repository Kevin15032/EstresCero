@extends('layouts.navprincipal')

@section('titulo', 'Panel Principal')

@section('contenido')
<main class="container py-4">
    <div class="row">
        <!-- Recursos Recientes -->
        <div class="col-md-6 mb-4">
            <h2 class="section-title">
                <i class="fas fa-book-open"></i> Recursos Recientes
            </h2>
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Técnicas de Estudio Efectivas</h6>
                                <small class="text-muted">Nuevo artículo</small>
                            </div>
                            <button class="btn btn-sm btn-custom">Leer</button>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Gestión del Tiempo</h6>
                                <small class="text-muted">Guía actualizada</small>
                            </div>
                            <button class="btn btn-sm btn-custom">Leer</button>
                        </li>
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
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Meditación Guiada - Nivel Básico</h6>
                                <small class="text-muted">15 minutos · Popular</small>
                            </div>
                            <button class="btn btn-sm btn-custom">Comenzar</button>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Ejercicios de Respiración</h6>
                                <small class="text-muted">10 minutos · Nuevo</small>
                            </div>
                            <button class="btn btn-sm btn-custom">Comenzar</button>
                        </li>
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
                            <div class="progress-bar bg-warning" style="width: 65%">Medio</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">Último registro: Hace 2 días</small>
                        <button class="btn btn-sm btn-custom">Actualizar</button>
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
                        <li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">¿Cómo manejan el estrés en época de exámenes?</h6>
                                <small class="text-muted">Nuevo</small>
                            </div>
                            <small class="text-muted">5 respuestas nuevas</small>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Técnicas de estudio efectivas</h6>
                                <small class="text-muted">2h</small>
                            </div>
                            <small class="text-muted">3 respuestas nuevas</small>
                        </li>
                    </ul>
                    <div class="text-end mt-3">
                        <button class="btn btn-sm btn-custom">Ver Foro</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection