@extends('layouts.admin')

@section('titulo', 'Editar Perfil de Administrador')

@section('estilos')
<style>
    .edit-form-section {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 20px;
    }
    .edit-form-section .form-label {
        font-weight: bold;
        color: #1D3557;
    }
    .edit-form-section input[type="file"] {
        border: none;
    }
    .btn-primary, .btn-secondary {
        transition: all 0.3s ease;
    }
    .btn-primary:hover, .btn-secondary:hover {
        transform: translateY(-2px);
    }
</style>
@endsection

@section('contenido')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="edit-form-section">
                <h3 class="mb-4 text-center">Editar Perfil de Administrador</h3>

                <form method="POST" action="{{ route('admin.perfil.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="text-center mb-4">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=1D3557&color=fff&size=150&bold=true' }}" 
                             class="rounded-circle shadow" style="width: 120px; height: 120px; object-fit: cover;">
                        <p class="mt-2">Cambiar foto de perfil</p>
                        <input type="file" name="avatar" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
                        <input type="password" name="password" class="form-control" placeholder="Dejar en blanco si no deseas cambiarla">
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.perfil') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
