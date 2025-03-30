@extends('layouts.admin')

@section('titulo', 'Perfil de Administrador')

@section('estilos')
<style>
    .profile-section {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }
    .profile-info {
        padding: 20px;
    }
    .profile-info p {
        margin-bottom: 10px;
        font-size: 1.1em;
    }
    .profile-label {
        font-weight: bold;
        color: #1D3557;
    }
    .profile-info img {
        border: 4px solid #1D3557;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    .profile-info img:hover {
        transform: scale(1.05);
    }
    .btn-danger {
        transition: all 0.3s ease;
    }
    .btn-danger:hover {
        transform: translateY(-2px);
    }
</style>
@endsection

@section('contenido')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-section">
                <h3 class="mb-4">Perfil de Administrador</h3>

                <div class="profile-info">
                    <div class="text-center mb-4">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" 
                                 class="rounded-circle mb-3" 
                                 style="width: 150px; height: 150px; object-fit: cover;"
                                 alt="Avatar de Administrador">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1D3557&color=fff&size=150&bold=true" 
                                 class="rounded-circle mb-3"
                                 style="width: 150px; height: 150px; object-fit: cover;"
                                 alt="Avatar de Administrador">
                        @endif
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><span class="profile-label">Nombre:</span> {{ $user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="profile-label">Correo:</span> {{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><span class="profile-label">Rol:</span> Administrador</p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="profile-label">Estado:</span> 
                                <span class="badge bg-success">Activo</span>
                            </p>
                        </div>
                    </div>

                    <!-- Botón de cerrar sesión -->
                    <div class="text-center mt-4">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection