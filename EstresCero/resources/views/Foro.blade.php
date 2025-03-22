@extends('layouts.navprincipal')

@section('titulo', 'Foro')

@section('estilos')
<style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-title {
        color: #1D3557;
    }
    .card-text {
        color: #333333;
    }
    .btn-custom {
        background: #457B9D;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 16px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.2s ease;
        font-weight: 500;
        min-width: 80px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }
    .btn-custom:hover {
        background: #1D3557;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
        transform: translateY(-1px);
        color: white;
    }
    .btn-custom:active {
        transform: translateY(0px);
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('contenido')
<main class="container py-4">
    <!-- Sección para crear un nuevo post -->
    <div class="card p-4 mb-4">
        <h4>Crear un nuevo post</h4>
        <form>
            <div class="mb-3">
                <label for="postTitle" class="form-label">Título</label>
                <input type="text" class="form-control" id="postTitle" placeholder="Título del post">
            </div>
            <div class="mb-3">
                <label for="postContent" class="form-label">Contenido</label>
                <textarea class="form-control" id="postContent" rows="3" placeholder="Escribe tu post aquí..."></textarea>
            </div>
            <button type="submit" class="btn btn-custom">Publicar</button>
        </form>
    </div>

    <!-- Posts existentes -->
    <div class="card p-4 mb-4">
        <div class="d-flex align-items-start">
            <img src="https://cdn.pixabay.com/photo/2014/09/17/20/03/profile-449912_1280.jpg" alt="Sarah Dev" class="rounded-circle me-3" width="50" height="50">
            <div>
                <h5 class="card-title">Sarah Dev</h5>
                <p class="text-muted">18 Feb 2024, 10:30 AM</p>
                <p class="card-text">Hablemos sobre técnicas de manejo del estrés durante los exámenes...</p>
                <button class="btn btn-custom" title="Comentarios">
                    <i class="bi bi-chat-dots"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="card p-4 mb-4">
        <div class="d-flex align-items-start">
            <img src="https://cdn.pixabay.com/photo/2024/06/22/22/56/man-8847069_1280.jpg" alt="Mike Student" class="rounded-circle me-3" width="40" height="40">
            <div>
                <h5 class="card-title">Mike Student</h5>
                <p class="text-muted">18 Feb 2024, 11:00 AM</p>
                <p class="card-text">Recomiendo practicar mindfulness antes de cada sesión de estudio...</p>
                <button class="btn btn-custom" title="Comentarios">
                    <i class="bi bi-chat-dots"></i>
                </button>
            </div>
        </div>
    </div>
</main>
@endsection