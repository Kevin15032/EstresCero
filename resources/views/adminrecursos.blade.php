@extends('layouts.admin')

@section('titulo', 'Gestión de Recursos')

@section('estilos')
<style>
    .resource-card {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }
    .resource-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    }
    .resource-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .resource-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #1D3557;
    }
    .resource-desc {
        font-size: 0.95rem;
        color: #555;
    }
    .btn-sm {
        padding: 4px 10px;
        font-size: 0.85rem;
    }
</style>
@endsection

@section('contenido')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 text-primary"><i class="fas fa-book-open me-2"></i>Lista de Recursos</h4>
                        <button class="btn btn-primary" onclick="openCreateModal()">
                            <i class="fas fa-plus"></i> Nuevo Recurso
                        </button>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
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
                                        <div class="resource-title">{{ $recurso->titulo }}</div>
                                        <p class="resource-desc">{{ Str::limit($recurso->descripcion, 100) }}</p>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <button class="btn btn-sm btn-primary" onclick="editResource({{ $recurso->id }})">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                            <form action="{{ route('admin.recursos.destroy', $recurso->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este recurso?')">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center text-muted">No hay recursos disponibles.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear/Editar Recurso -->
<div class="modal fade" id="createResourceModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTitle"><i class="fas fa-plus-circle me-2"></i>Crear Nuevo Recurso</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="resourceForm" action="{{ route('admin.recursos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select name="categoria" id="categoria" class="form-select" required>
                                <option value="Artículo">Artículo</option>
                                <option value="Guía">Guía</option>
                                <option value="Tip">Tip</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="2" required></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="contenido" class="form-label">Contenido</label>
                            <textarea class="form-control" id="contenido" name="contenido" rows="5" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openCreateModal() {
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-plus-circle me-2"></i>Crear Nuevo Recurso';
    document.getElementById('resourceForm').action = "{{ route('admin.recursos.store') }}";
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('titulo').value = '';
    document.getElementById('descripcion').value = '';
    document.getElementById('contenido').value = '';
    document.getElementById('categoria').value = 'Artículo';
    document.getElementById('imagen').value = '';
    new bootstrap.Modal(document.getElementById('createResourceModal')).show();
}

function editResource(id) {
    fetch(`/admin/recursos/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit me-2"></i>Editar Recurso';
            document.getElementById('titulo').value = data.titulo;
            document.getElementById('descripcion').value = data.descripcion;
            document.getElementById('contenido').value = data.contenido;
            document.getElementById('categoria').value = data.categoria;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('resourceForm').action = `/admin/recursos/${id}`;
            new bootstrap.Modal(document.getElementById('createResourceModal')).show();
        });
}
</script>
@endsection
