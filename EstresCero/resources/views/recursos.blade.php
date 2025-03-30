@extends('layouts.navprincipal')

@section('titulo', 'Recursos')

@section('estilos')
<style>
    .resource-card {
        transition: transform 0.3s ease;
        height: 400px; /* Altura fija para todas las tarjetas */
        display: flex;
        flex-direction: column;
    }
    .resource-card:hover {
        transform: translateY(-5px);
    }
    .resource-card .card-img-top {
        height: 200px; /* Altura fija para todas las imágenes */
        object-fit: cover; /* Mantiene la proporción de la imagen */
    }
    .resource-card .card-body {
        flex: 1;
        overflow: hidden; /* Evita que el contenido se desborde */
        display: flex;
        flex-direction: column;
    }
    .resource-card .card-text {
        flex-grow: 1;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Límite de 3 líneas de texto */
        -webkit-box-orient: vertical;
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
    /* Estilos para el modal */
    .modal-body img {
        max-width: 100%;
        height: auto;
        max-height: 400px; /* Altura máxima para imágenes en el modal */
        display: block;
        margin: 0 auto;
    }
    .modal-body {
        max-height: 70vh; /* Altura máxima del modal */
        overflow-y: auto; /* Permite scroll si el contenido es muy largo */
    }
    .modal-content {
        border: none;
        border-radius: 15px;
    }
    .article-header {
        position: relative;
        margin-bottom: 2rem;
    }
    .article-header img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 10px;
    }
    .article-title {
        font-size: 2rem;
        color: #1D3557;
        margin: 1.5rem 0;
        font-weight: bold;
    }
    .article-metadata {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }
    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
        padding: 0 1rem;
    }
    .article-content p {
        margin-bottom: 1.5rem;
    }
</style>
@endsection

@section('contenido')
<main class="container py-4">
    <!-- Categorías y Filtros -->
    <div class="text-center mb-4">
        <div class="btn-group" role="group">
            <button class="btn btn-custom active">Todos</button>
            <button class="btn btn-custom">Artículos</button>
            <button class="btn btn-custom">Guías</button>
            <button class="btn btn-custom">Tips</button>
        </div>
    </div>

    <!-- Grid de Recursos -->
    <div class="row g-4">
        @forelse($recursos as $recurso)
        <div class="col-md-4">
            <div class="card h-100 resource-card">
                @if($recurso->imagen)
                    <img src="{{ asset('storage/' . $recurso->imagen) }}" 
                         class="card-img-top" alt="{{ $recurso->titulo }}">
                @else
                    <div class="text-center pt-4">
                        <i class="fas fa-book-reader text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="badge bg-primary mb-2">Recurso</span>
                        <i class="fas fa-heart favorite-btn"></i>
                    </div>
                    <h5 class="card-title">{{ $recurso->titulo }}</h5>
                    <p class="card-text">{{ Str::limit($recurso->descripcion, 100) }}</p>
                    <button class="btn btn-custom" data-bs-toggle="modal" 
                            data-bs-target="#resourceModal" 
                            onclick="showResource({{ $recurso->id }})">
                        Leer más
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-center">No hay recursos disponibles.</p>
        </div>
        @endforelse
    </div>
</main>

<!-- Modal para recursos -->
<div class="modal fade" id="resourceModal" tabindex="-1">
    <div class="modal-dialog modal-xl"> <!-- Cambiado a modal-xl para más espacio -->
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <article class="article-container">
                    <div class="article-header">
                        <img id="resourceImage" src="" alt="" class="mb-3">
                    </div>
                    <h1 class="article-title" id="resourceTitle"></h1>
                    <div class="article-metadata">
                        <span class="category" id="resourceCategory">
                            <i class="fas fa-folder-open me-2"></i>
                            <span id="resourceCategoryText"></span>
                        </span>
                        <span class="mx-2">•</span>
                        <span class="date">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <span id="resourceDate"></span>
                        </span>
                    </div>
                    <div class="article-content" id="resourceContent">
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function showResource(id) {
    fetch(`/recursos/${id}`)
        .then(response => response.json())
        .then(data => {
            // Actualizar imagen
            const imageElement = document.getElementById('resourceImage');
            imageElement.src = data.imagen ? `/storage/${data.imagen}` : '/images/default-resource.jpg';
            imageElement.alt = data.titulo;

            // Actualizar título
            document.getElementById('resourceTitle').textContent = data.titulo;
            
            // Actualizar categoría
            document.getElementById('resourceCategoryText').textContent = 'Recurso';
            
            // Actualizar fecha
            const fecha = new Date(data.created_at).toLocaleDateString('es-ES', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('resourceDate').textContent = fecha;
            
            // Actualizar contenido
            document.getElementById('resourceContent').innerHTML = `
                <div class="lead mb-4">${data.descripcion}</div>
                ${data.contenido}
            `;
        });
}
</script>
@endsection