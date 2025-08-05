@extends('layouts.PlantillaNavinicio')

@section('titulo', 'Verifica tu correo')

@section('contenido')
<div class="container mt-5">
    <div class="form-container text-center">
        <h2 class="header-title mb-4">Verifica tu correo electrónico</h2>

        @if (session('message'))
            <div class="alert alert-success mb-3">
                {{ session('message') }}
            </div>
        @endif

        <p class="mb-4">
            Antes de continuar, por favor revisa tu correo y haz clic en el enlace de verificación.
        </p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                Reenviar correo de verificación
            </button>
        </form>
    </div>
</div>
@endsection