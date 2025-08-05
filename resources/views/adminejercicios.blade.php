@extends('layouts.admin')

@section('titulo', 'Gestión de Ejercicios')

@section('estilos')
<style>
    .exercise-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease-in-out;
        padding: 16px;
        height: 100%;
    }
    .exercise-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    }
    .exercise-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #1D3557;
    }
    .exercise-desc {
        font-size: 0.95rem;
        color: #555;
    }
    .badge-category {
        font-size: 0.8rem;
        background-color: #6c757d;
        color: #fff;
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
                        <h4 class="mb-0 text-primary"><i class="fas fa-dumbbell me-2"></i>Lista de Ejercicios</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createExerciseModal">
                            <i class="fas fa-plus"></i> Nuevo Ejercicio
                        </button>
                    </div>

                    <div class="row">
                        @forelse($ejercicios as $ejercicio)
                            <div class="col-md-4 mb-4">
                                <div class="exercise-card">
                                    @if($ejercicio->imagen)
                                        <img src="{{ asset('storage/' . $ejercicio->imagen) }}" class="img-fluid rounded mb-2">
                                    @endif
                                    <div class="d-flex justify-content-between mb-2">
                                        <i class="{{ $ejercicio->icono }} fa-2x text-secondary"></i>
                                        <span class="badge bg-primary">{{ $ejercicio->duracion }} min</span>
                                    </div>
                                    <div class="exercise-title">{{ $ejercicio->titulo }}</div>
                                    <p class="exercise-desc mt-1">{{ Str::limit($ejercicio->descripcion, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="badge badge-category">{{ $ejercicio->categoria }}</span>
                                        <div>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                onclick='setEditExercise(@json($ejercicio))' data-bs-target="#editExerciseModal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.ejercicios.destroy', $ejercicio->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('¿Estás seguro de eliminar este ejercicio?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted">
                                No hay ejercicios disponibles.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Ejercicio -->
<div class="modal fade" id="createExerciseModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Crear Nuevo Ejercicio</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.ejercicios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" class="form-control" name="titulo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Categoría</label>
                            <select name="categoria" class="form-select" required>
                                <option value="Meditación">Meditación</option>
                                <option value="Yoga">Yoga</option>
                                <option value="Respiración">Respiración</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duración (minutos)</label>
                            <input type="number" name="duracion" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Icono (Font Awesome)</label>
                            <select name="icono" class="form-select" required>
                                <option value="fas fa-music">🎵 fa-music (Meditación)</option>
                                <option value="fas fa-spa">🌿 fa-spa (Yoga)</option>
                                <option value="fas fa-brain">🧠 fa-brain (Respiración)</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Imagen del ejercicio</label>
                            <input type="file" name="imagen" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">URL del video</label>
                            <input type="url" name="video_url" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3 form-check">
                            <input type="checkbox" name="destacado" class="form-check-input" id="crear_destacado">
                            <label class="form-check-label" for="crear_destacado">Marcar como destacado</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Ejercicio</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Ejercicio -->
<div class="modal fade" id="editExerciseModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Editar Ejercicio</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editExerciseForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" class="form-control" name="titulo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Categoría</label>
                            <select name="categoria" class="form-select" required>
                                <option value="Meditación">Meditación</option>
                                <option value="Yoga">Yoga</option>
                                <option value="Respiración">Respiración</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duración (minutos)</label>
                            <input type="number" name="duracion" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Icono (Font Awesome)</label>
                            <select name="icono" class="form-select" required>
                                <option value="fas fa-music">🎵 fa-music (Meditación)</option>
                                <option value="fas fa-spa">🌿 fa-spa (Yoga)</option>
                                <option value="fas fa-brain">🧠 fa-brain (Respiración)</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Imagen del ejercicio</label>
                            <input type="file" name="imagen" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">URL del video</label>
                            <input type="url" name="video_url" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3 form-check">
                            <input type="checkbox" name="destacado" class="form-check-input" id="editar_destacado">
                            <label class="form-check-label" for="editar_destacado">Marcar como destacado</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Actualizar Ejercicio</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function setEditExercise(ejercicio) {
        const form = document.getElementById('editExerciseForm');
        form.action = `/admin/ejercicios/${ejercicio.id}`;
        form.querySelector('[name="titulo"]').value = ejercicio.titulo;
        form.querySelector('[name="descripcion"]').value = ejercicio.descripcion;
        form.querySelector('[name="categoria"]').value = ejercicio.categoria;
        form.querySelector('[name="duracion"]').value = ejercicio.duracion;
        form.querySelector('[name="icono"]').value = ejercicio.icono;
        form.querySelector('[name="video_url"]').value = ejercicio.video_url ?? '';
        form.querySelector('[name="destacado"]').checked = ejercicio.destacado == 1;
    }
</script>
@endsection
