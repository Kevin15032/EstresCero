@extends('layouts.navprincipal')

@section('titulo', 'Ejercicios')

@section('estilos')
<style>
    .exercise-card {
        transition: transform 0.3s ease;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        height: auto; /* Cambiado de altura fija a auto */
    }
    .exercise-card:hover {
        transform: translateY(-5px);
    }
    .duration-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #457B9D;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9rem;
    }
    .carousel-item {
        height: 300px;
        background-color: #1D3557;
        border-radius: 15px;
    }
    .carousel-caption {
        background: rgba(0,0,0,0.5);
        border-radius: 10px;
        padding: 20px;
    }
    .btn-custom {
        background-color: #457B9D;
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-custom:hover {
        background-color: #1D3557;
        transform: translateY(-2px);
    }
    .modal-content {
        border-radius: 15px;
    }
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
    }
    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 10px;
    }
    .exercise-image {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
</style>
@endsection

@section('contenido')
<main class="container py-4">
    <!-- Carousel de Destacados -->
    <div id="featuredExercises" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($ejercicios->where('destacado', true) as $ejercicio)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <div class="carousel-caption">
                    <h3>{{ $ejercicio->titulo }}</h3>
                    <p>{{ $ejercicio->descripcion }}</p>
                    <button class="btn btn-custom" onclick="showExercise({{ $ejercicio->id }})">
                        Comenzar Ejercicio
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredExercises" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredExercises" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Filtros de Categorías -->
    <div class="text-center mb-4">
        <div class="btn-group" role="group">
            <button class="btn btn-custom active" data-category="todos">Todos</button>
            <button class="btn btn-custom" data-category="Meditación">Meditación</button>
            <button class="btn btn-custom" data-category="Yoga">Yoga</button>
            <button class="btn btn-custom" data-category="Respiración">Respiración</button>
        </div>
    </div>

    <!-- Grid de Ejercicios -->
    <div class="row g-4">
        @foreach($ejercicios as $ejercicio)
        <div class="col-md-4 exercise-item" data-category="{{ $ejercicio->categoria }}">
            <div class="exercise-card">
                @if($ejercicio->imagen)
                    <img src="{{ asset('storage/' . $ejercicio->imagen) }}" 
                         class="card-img-top exercise-image" 
                         alt="{{ $ejercicio->titulo }}">
                @endif
                <div class="card-body position-relative">
                    <span class="duration-badge">{{ $ejercicio->duracion }} min</span>
                    <div class="text-center mb-3">
                        <i class="{{ $ejercicio->icono }} text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="card-title text-center">{{ $ejercicio->titulo }}</h5>
                    <p class="card-text">{{ Str::limit($ejercicio->descripcion, 100) }}</p>
                    <button class="btn btn-custom w-100" onclick="showExercise({{ $ejercicio->id }})">
                        Comenzar Ejercicio
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</main>

<!-- Modal del Ejercicio -->
<div class="modal fade" id="exerciseModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exerciseTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="videoContainer" class="mb-4"></div>
                <p id="exerciseDescription"></p>
                <div class="d-flex justify-content-between">
                    <span class="badge bg-primary" id="exerciseDuration"></span>
                    <span class="badge bg-secondary" id="exerciseCategory"></span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function showExercise(id) {
    fetch(`/ejercicios/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('exerciseTitle').textContent = data.titulo;
            document.getElementById('exerciseDescription').textContent = data.descripcion;
            document.getElementById('exerciseDuration').textContent = `${data.duracion} minutos`;
            document.getElementById('exerciseCategory').textContent = data.categoria;
            
            const videoContainer = document.getElementById('videoContainer');
            if (data.video_url) {
                // Convertir la URL de YouTube al formato embed correcto
                let embedUrl = data.video_url;
                
                // Si es una URL normal de YouTube (watch?v=)
                if (data.video_url.includes('watch?v=')) {
                    const videoId = data.video_url.split('watch?v=')[1].split('&')[0];
                    embedUrl = `https://www.youtube.com/embed/${videoId}`;
                }
                // Si es una URL corta (youtu.be)
                else if (data.video_url.includes('youtu.be')) {
                    const videoId = data.video_url.split('youtu.be/')[1];
                    embedUrl = `https://www.youtube.com/embed/${videoId}`;
                }
                // Si ya es una URL de embed, la dejamos igual
                
                videoContainer.innerHTML = `
                    <div class="video-container">
                        <iframe 
                            src="${embedUrl}"
                            width="100%" 
                            height="400"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>`;
            } else {
                videoContainer.innerHTML = '<p class="text-center">No hay video disponible</p>';
            }
            
            new bootstrap.Modal(document.getElementById('exerciseModal')).show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cargar el ejercicio');
        });
}

// Filtrado de categorías
document.querySelectorAll('.btn-group .btn').forEach(button => {
    button.addEventListener('click', function() {
        const category = this.dataset.category;
        
        document.querySelectorAll('.btn-group .btn').forEach(btn => 
            btn.classList.remove('active'));
        this.classList.add('active');
        
        document.querySelectorAll('.exercise-item').forEach(item => {
            if (category === 'todos' || item.dataset.category === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>
@endsection