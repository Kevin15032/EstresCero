@extends('layouts.navprincipal')

@section('titulo', 'Ejercicios')

@section('estilos')
<style>
    /* Carrusel */
    .carousel-item {
        position: relative;
        height: 350px;
        background-size: cover;
        background-position: center;
        border-radius: 20px;
        overflow: hidden;
    }

    .carousel-item::before {
        content: "";
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(3px);
        z-index: 1;
    }

    .carousel-caption {
        position: absolute;
        z-index: 2;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        padding: 0 20px;
        max-width: 700px;
    }

    .carousel-caption h3 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .btn-custom {
        background-color: #457B9D;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 20px;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #1D3557;
        transform: scale(1.05);
    }

    /* Tarjetas */
    .exercise-card {
        display: flex;
        flex-direction: column;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        height: 100%;
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    .exercise-card:hover {
        transform: translateY(-4px);
        transition: transform 0.3s ease;
    }

    .exercise-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 1rem;
        flex: 1;
    }

    .card-body h5 {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .card-body p {
        font-size: 0.95rem;
        flex-grow: 1;
    }

    .duration-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background-color: #457B9D;
        color: white;
        padding: 4px 10px;
        font-size: 0.8rem;
        border-radius: 12px;
        z-index: 2;
    }

    /* Filtros */
    .btn-filter {
        background-color: #A8DADC;
        border: none;
        border-radius: 20px;
        padding: 6px 16px;
        margin: 5px;
        color: #1D3557;
        font-weight: 500;
    }

    .btn-filter.active {
        background-color: #1D3557;
        color: white;
    }

    /* Animación */
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('contenido')
<main class="container py-4">
    <!-- Carrusel -->
    <div id="featuredExercises" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($ejercicios->where('destacado', true) as $ejercicio)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}"
                style="background-image: url('{{ asset('storage/' . $ejercicio->imagen) }}');">
                <div class="carousel-caption">
                    <h3>{{ $ejercicio->titulo }}</h3>
                    <p>{{ Str::limit($ejercicio->descripcion, 300) }}</p>
                    <button class="btn btn-custom" onclick="showExercise({{ $ejercicio->id }})">Comenzar Ejercicio</button>
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

    <!-- Filtros -->
    <div class="text-center mb-4">
        <div class="btn-group" role="group">
            <button class="btn btn-filter active" data-category="todos">Todos</button>
            <button class="btn btn-filter" data-category="Meditación">Meditación</button>
            <button class="btn btn-filter" data-category="Yoga">Yoga</button>
            <button class="btn btn-filter" data-category="Respiración">Respiración</button>
        </div>
    </div>

    <!-- Tarjetas -->
    <div class="row g-4">
        @foreach($ejercicios as $index => $ejercicio)
        <div class="col-md-4 exercise-item" data-category="{{ $ejercicio->categoria }}">
            <div class="exercise-card position-relative" style="animation-delay: {{ $index * 0.1 }}s;">
                @if($ejercicio->imagen)
                <span class="duration-badge">{{ $ejercicio->duracion }} min</span>
                <img src="{{ asset('storage/' . $ejercicio->imagen) }}" class="exercise-image" alt="{{ $ejercicio->titulo }}">
                @endif
                <div class="card-body">
                    <h5>{{ $ejercicio->titulo }}</h5>
                    <p>{{ Str::limit($ejercicio->descripcion, 100) }}</p>
                    <button class="btn btn-custom w-100 mt-3" onclick="showExercise({{ $ejercicio->id }})">
                        Comenzar Ejercicio
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exerciseModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded">
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
    fetch(`/detalle-ejercicio/${id}`)

        .then(response => response.json())
        .then(data => {
            document.getElementById('exerciseTitle').textContent = data.titulo;
            document.getElementById('exerciseDescription').textContent = data.descripcion;
            document.getElementById('exerciseDuration').textContent = `${data.duracion} minutos`;
            document.getElementById('exerciseCategory').textContent = data.categoria;

            const videoContainer = document.getElementById('videoContainer');
            if (data.video_url) {
                let embedUrl = data.video_url;

                if (data.video_url.includes('watch?v=')) {
                    const videoId = data.video_url.split('watch?v=')[1].split('&')[0];
                    embedUrl = `https://www.youtube.com/embed/${videoId}`;
                } else if (data.video_url.includes('youtu.be')) {
                    const videoId = data.video_url.split('youtu.be/')[1];
                    embedUrl = `https://www.youtube.com/embed/${videoId}`;
                }

                videoContainer.innerHTML = `
                    <div class="ratio ratio-16x9">
                        <iframe src="${embedUrl}" frameborder="0" allowfullscreen></iframe>
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

// Filtro de categorías
document.querySelectorAll('.btn-filter').forEach(button => {
    button.addEventListener('click', function () {
        const category = this.dataset.category;
        document.querySelectorAll('.btn-filter').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');

        document.querySelectorAll('.exercise-item').forEach(item => {
            item.style.display = (category === 'todos' || item.dataset.category === category) ? 'block' : 'none';
        });
    });
});
</script>
@endsection
