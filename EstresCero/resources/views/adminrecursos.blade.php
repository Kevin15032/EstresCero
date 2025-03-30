@extends('layouts.admin')

@section('titulo', 'Gestión de Recursos')

@section('estilos')
<style>
    .resource-card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    .resource-card:hover {
        transform: translateY(-5px);
    }
    .resource-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px 8px 0 0;
    }
</style>
@endsection

@section('contenido')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title">Lista de Recursos</h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createResourceModal">
                            <i class="fas fa-plus"></i> Nuevo Recurso
                        </button>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        @forelse($recursos as $recurso)
                            <div class="col-md-4 mb-4">
                                <div class="resource-card">
                                    @if($recurso->imagen)
                                        <img src="{{ asset('storage/' . $recurso->imagen) }}" 
                                             class="resource-image" alt="{{ $recurso->titulo }}">
                                    @endif
                                    <div class="p-3">
                                        <h5>{{ $recurso->titulo }}</h5>
                                        <p class="text-muted">{{ Str::limit($recurso->descripcion, 100) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button class="btn btn-sm btn-primary" 
                                                    onclick="editResource({{ $recurso->id }})">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                            <form action="{{ route('admin.recursos.destroy', $recurso->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('¿Estás seguro?')">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">No hay recursos disponibles.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear/editar recurso -->
<div class="modal fade" id="createResourceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Nuevo Recurso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.recursos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="contenido" class="form-label">Contenido</label>
                        <textarea class="form-control" id="contenido" name="contenido" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Recurso</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection