@extends('layouts.navprincipal')

@section('titulo', 'Mi Perfil')

@section('estilos')
<style>
    .profile-section {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }
    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #457B9D;
    }
    .form-control:focus {
        border-color: #457B9D;
        box-shadow: 0 0 0 0.2rem rgba(69, 123, 157, 0.25);
    }
</style>
@endsection

@section('contenido')
<main class="container py-4">
    <div class="row">
        <!-- Información del Perfil -->
        <div class="col-md-4">
            <div class="profile-section text-center">
                <img src="{{ asset('img/man-4994636_1280.jpg') }}" alt="Foto de perfil" class="profile-img mb-3">
                <h4>Nombre del Usuario</h4>
                <p class="text-muted">Estudiante</p>
                <button class="btn btn-custom btn-sm" data-bs-toggle="modal" data-bs-target="#editPhotoModal">
                    <i class="fas fa-camera"></i> Cambiar foto
                </button>
            </div>
        </div>

        <!-- Formulario de Edición -->
        <div class="col-md-8">
            <div class="profile-section">
                <h3 class="mb-4">Editar Perfil</h3>
                <form id="profileForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="name" name="name" value="Nombre del Usuario">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="usuario@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Dejar en blanco para mantener la actual">
                    </div>
                    <button type="submit" class="btn btn-custom">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Modal para cambiar foto -->
<div class="modal fade" id="editPhotoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Foto de Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="photoForm" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control" id="photoInput" name="photo" accept="image/*">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-custom">Guardar</button>
            </div>
        </div>
    </div>
</div>
@endsection