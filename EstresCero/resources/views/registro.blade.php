@extends('layouts.PlantillaNavinicio')

@section('titulo', 'Registro')

@section('estilos')
<style>
    .form-container {
        background-color: #FFFFFF;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: auto;
    }
    .header-title {
        color: #1D3557;
    }
    .btn-primary {
        background-color: #457B9D;
        color: #FFFFFF;
    }
    .btn-primary:hover {
        background-color: #1D3557;
    }
    .btn-secondary {
        background-color: #A8DADC;
        color: #1D3557;
    }
    .btn-secondary:hover {
        background-color: #1D3557;
        color: #FFFFFF;
    }
    .form-group label {
        color: #1D3557;
    }
    .form-group input,
    .form-group select {
        border-color: #457B9D;
        box-shadow: none;
    }
    .form-group input:focus,
    .form-group select:focus {
        border-color: #1D3557;
        box-shadow: 0 0 5px #1D3557;
    }
</style>
@endsection

@section('contenido')
<div class="container mt-5">
    <div class="form-container">
        <h2 class="header-title text-center mb-4">Registro</h2>
        <form method="POST" action="{{ route('auth.register') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" class="form-control" 
                       value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" 
                       class="form-control" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>

        <div class="mt-3 text-center">
            <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia Sesión</a></p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Aquí puedes agregar tu JavaScript personalizado
</script>
@endsection