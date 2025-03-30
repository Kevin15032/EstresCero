@extends('layouts.admin')

@section('titulo', 'Gestión de Ejercicios')

@section('estilos')
<style>
    .exercise-card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    .exercise-card:hover {
        transform: translateY(-5px);
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
                        <h5 class="card-title">Lista de Ejercicios</h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createExerciseModal">
                            <i class="fas fa-plus"></i> Nuevo Ejercicio
                        </button>
                    </div>

                    <div class="row">
                        @forelse($ejercicios as $ejercicio)
                            <div class="col-md-4 mb-4">
                                <div class="exercise-card p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <i class="{{ $ejercicio->icono }} fa-2x"></i>
                                        <span class="badge bg-primary">{{ $ejercicio->duracion }} min</span>
                                    </div>
                                    <h5>{{ $ejercicio->titulo }}</h5>
                                    <p class="text-muted">{{ Str::limit($ejercicio->descripcion, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-secondary">{{ $ejercicio->categoria }}</span>
                                        <div>
                                            <button class="btn btn-sm btn-primary" onclick="editExercise({{ $ejercicio->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.ejercicios.destroy', $ejercicio->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('¿Estás seguro?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">No hay ejercicios disponibles.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear ejercicio -->
<div class="modal fade" id="createExerciseModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Nuevo Ejercicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.ejercicios.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="categoria" class="form-label">Categoría</label>
                        <select class="form-control" id="categoria" name="categoria" required>
                            <option value="Meditación">Meditación</option>
                            <option value="Yoga">Yoga</option>
                            <option value="Respiración">Respiración</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="duracion" class="form-label">Duración (minutos)</label>
                        <input type="number" class="form-control" id="duracion" name="duracion" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="video_url" class="form-label">URL del Video (YouTube/Vimeo)</label>
                        <input type="url" class="form-control" id="video_url" name="video_url" 
                               placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                    <div class="mb-3">
                        <label for="icono" class="form-label">Icono</label>
                        <select class="form-control" id="icono" name="icono" required>
                            <option value="fas fa-meditation">🧘 Meditación</option>
                            <option value="fas fa-yoga">🧘‍♀️ Yoga</option>
                            <option value="fas fa-wind">🌬️ Respiración</option>
                        </select>
                        <small class="text-muted">Selecciona el icono que mejor represente el ejercicio</small>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="destacado" name="destacado" value="1">
                            <label class="form-check-label" for="destacado">
                                ⭐ Mostrar en sección destacada
                            </label>
                            <small class="d-block text-muted">Los ejercicios destacados aparecerán en la página principal</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen de Presentación</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" 
                               accept="image/*">
                        <small class="text-muted">Sube una imagen representativa del ejercicio (opcional)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Ejercicio</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection