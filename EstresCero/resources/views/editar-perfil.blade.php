@extends('layouts.navprincipal')

@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center animate__animated animate__fadeInDown">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4>Editar Perfil</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center mb-4">
                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}" class="rounded-circle shadow" style="width: 100px; height: 100px; object-fit: cover;">
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
                            <input type="password" name="password" class="form-control" placeholder="Dejar en blanco para no cambiar">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('perfil') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
