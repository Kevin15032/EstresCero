@extends('layouts.navprincipal')

@section('titulo', 'Recursos')

@section('estilos')
<style>
    .resource-card {
        transition: transform 0.3s ease;
    }
    .resource-card:hover {
        transform: translateY(-5px);
    }
    .category-filter {
        background-color: #457B9D;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 16px;
        margin: 5px;
        cursor: pointer;
    }
    .category-filter:hover {
        background-color: #1D3557;
    }
    .favorite-btn {
        color: #457B9D;
        cursor: pointer;
    }
    .favorite-btn:hover {
        color: #e31b23;
    }
</style>
@endsection

@section('contenido')
<main class="container py-4">
    <!-- Categorías y Filtros -->
    <div class="text-center mb-4">
        <div class="btn-group" role="group">
            <button class="btn btn-custom">Todos</button>
            <button class="btn btn-custom">Artículos</button>
            <button class="btn btn-custom">Guías</button>
            <button class="btn btn-custom">Tips</button>
        </div>
    </div>

    <!-- Grid de Recursos -->
    <div class="row g-4">
        <!-- Artículo 1 -->
        <div class="col-md-4">
            <div class="card h-100 resource-card">
                <div class="text-center pt-4">
                    <i class="fas fa-lungs text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="badge bg-primary mb-2">Artículo</span>
                        <i class="fas fa-heart favorite-btn"></i>
                    </div>
                    <h5 class="card-title">Técnicas de Respiración para Estudiantes</h5>
                    <p class="card-text">Aprende técnicas efectivas de respiración para manejar el estrés durante los exámenes.</p>
                    <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#resourceModal">Leer más</button>
                </div>
            </div>
        </div>

        <!-- Guía -->
        <div class="col-md-4">
            <div class="card h-100 resource-card">
                <div class="text-center pt-4">
                    <i class="fas fa-book-reader text-success" style="font-size: 2.5rem;"></i>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="badge bg-success mb-2">Guía</span>
                        <i class="fas fa-heart favorite-btn"></i>
                    </div>
                    <h5 class="card-title">Planificación Efectiva de Estudio</h5>
                    <p class="card-text">Guía práctica para organizar tu tiempo y reducir el estrés académico.</p>
                    <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#resourceModal">Ver guía</button>
                </div>
            </div>
        </div>

        <!-- Tips -->
        <div class="col-md-4">
            <div class="card h-100 resource-card">
                <div class="text-center pt-4">
                    <i class="fas fa-lightbulb text-warning" style="font-size: 2.5rem;"></i>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="badge bg-warning text-dark mb-2">Tips</span>
                        <i class="fas fa-heart favorite-btn"></i>
                    </div>
                    <h5 class="card-title">Tips para Mantener la Calma</h5>
                    <p class="card-text">Consejos prácticos para mantener la calma durante situaciones académicas estresantes.</p>
                    <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#resourceModal">Leer tips</button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal para recursos -->
<div class="modal fade" id="resourceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Título del Recurso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido dinámico del recurso -->
            </div>
        </div>
    </div>
</div>
@endsection