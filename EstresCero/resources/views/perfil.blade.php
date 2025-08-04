@extends('layouts.navprincipal')

@section('titulo', 'Mi Perfil')

@section('estilos')
<style>
    .perfil-card {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.6s ease;
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .perfil-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #457B9D;
        margin-bottom: 15px;
        transition: transform 0.3s;
    }

    .perfil-avatar:hover {
        transform: scale(1.05);
    }

    .perfil-info {
        text-align: left;
        margin-top: 20px;
    }

    .perfil-info p {
        font-size: 16px;
        margin: 10px 0;
    }

    .perfil-info strong {
        color: #1D3557;
    }

    .btn-edit {
        background-color: #1D4ED8;
        color: #fff;
        padding: 10px 20px;
        font-weight: 500;
        border: none;
        border-radius: 30px;
        margin-bottom: 20px;
        transition: background-color 0.3s ease;
    }

    .btn-edit:hover {
        background-color: #2563EB;
    }

    .btn-logout {
        background-color: #DC3545;
        color: #fff;
        border: none;
        border-radius: 30px;
        padding: 10px 20px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .btn-logout:hover {
        background-color: #c82333;
    }

    .form-control {
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #1D4ED8;
        border: none;
        border-radius: 20px;
        font-weight: 500;
        padding: 10px 25px;
    }

    .btn-primary:hover {
        background-color: #2563EB;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        border-radius: 20px;
        padding: 10px 25px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('contenido')
<main class="container py-5">
    <div class="perfil-card">
        @if(session('edit_mode'))
            <h4 class="mb-4">Editar Perfil</h4>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <img src="{{ asset('storage/' . $user->avatar) }}" class="perfil-avatar" alt="Foto de perfil">
                <div class="mb-3">
                    <label class="form-label">Cambiar foto de perfil</label>
                    <input type="file" name="avatar" class="form-control">
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Nueva Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="********">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="{{ route('profile.cancel') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        @else
            <h4 class="mb-4">Mi Perfil</h4>
            <img src="{{ asset('storage/' . $user->avatar) }}" class="perfil-avatar" alt="Foto de perfil">
            <div class="perfil-info mt-4">
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Correo:</strong> {{ $user->email }}</p>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('profile.edit') }}" class="btn btn-edit"><i class="bi bi-pencil-square"></i> Editar Perfil</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-logout"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</button>
                </form>
            </div>
        @endif
    </div>
</main>
@endsection
