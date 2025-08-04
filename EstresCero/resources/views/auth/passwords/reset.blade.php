@extends('layouts.PlantillaNavinicio')

@section('titulo', 'Restablecer Contraseña')

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

    .text-danger {
        font-size: 0.85rem;
    }
</style>
@endsection

@section('contenido')
<div class="container">
    <div class="form-container">
        <h2 class="header-title text-center mb-4">Restablecer Contraseña</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group mb-3">
                <label for="email">Correo Electrónico</label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
                       class="form-control" placeholder="ejemplo@correo.com" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password">Nueva Contraseña</label>
                <input id="password" type="password" name="password" class="form-control" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Restablecer Contraseña</button>
        </form>
    </div>
</div>
@endsection
