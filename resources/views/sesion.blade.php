@extends('layouts.PlantillaNavinicio')

@section('titulo', 'Iniciar Sesión')

@section('estilos')
<style>
    body {
        background-color: #E0F7FA;
        font-family: 'Poppins', sans-serif;
    }

    .form-container {
        background-color: #FFFFFF;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        max-width: 420px;
        margin: 3rem auto;
    }

    .header-title {
        color: #1D3557;
        font-weight: 600;
        font-size: 1.8rem;
    }

    .form-group label {
        color: #1D3557;
        font-weight: 500;
    }

    .form-control {
        border: 1.8px solid #A8DADC;
        border-radius: 6px;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: #1D3557;
        box-shadow: 0 0 5px rgba(29, 53, 87, 0.5);
    }

    .btn-primary {
        background-color: #2CA58D;
        border: none;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #1D7F6B;
    }

    .text-muted a {
        color: #1D3557;
        text-decoration: none;
    }

    .text-muted a:hover {
        text-decoration: underline;
        color: #1a2b44;
    }

    .alert-danger {
        font-size: 0.9rem;
    }
</style>
@endsection

@section('contenido')
<div class="container">
    <div class="form-container">
        <h2 class="header-title text-center mb-4">Iniciar Sesión</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.login') }}">
            @csrf

            <!-- Correo -->
            <div class="form-group mb-3">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control"
                    placeholder="ejemplo@correo.com" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="form-group mb-3">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control"
                    placeholder="••••••••" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-muted mb-2">
                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            </p>
            <p class="text-muted">
                ¿No tienes una cuenta?
                <a href="{{ route('registro') }}">Regístrate aquí</a>
            </p>
        </div>
    </div>
</div>
@endsection
