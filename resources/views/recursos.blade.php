@extends('layouts.navprincipal')

@section('titulo', 'Recursos')

@section('estilos')
<style>
    .btn-category {
        background-color: #A8DADC;
        color: #1D3557;
        border-radius: 20px;
        border: none;
        padding: 8px 16px;
        margin: 0 5px;
        transition: all 0.3s ease;
    }

    .btn-category.active,
    .btn-category:hover {
        background-color: #1D3557;
        color: white;
    }

    .resource-card {
        transition: transform 0.3s ease;
        height: 100%;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    .resource-card:hover {
        transform: translateY(-5px);
    }

    .resource-card img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .resource-card .card-body {
        flex: 1;
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.1rem;
        color: #1D3557;
    }

    .card-text {
        color: #555;
        font-size: 0.95rem;
        flex-grow: 1;
        margin: 10px 0;
    }

    .btn-custom {
        background-color: #457B9D;
        color: white;
        border-radius: 30px;
        width: 100%;
        transition: 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #1D3557;
    }

    .category-badge {
        font-size: 0.75rem;
        font-weight: 600;
        background-color: #1D3557;
        color: white;
        padding: 5px 10px;
        border-radius: 12px;
    }

    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('contenido')
<main class="container py-4">

    <!-- Filtros -->
    <div class="text-center mb-4">
        <button class="btn btn-category active" data-category="Todos">Todos</button>
        <button class="btn btn-category" data-category="Artículo">Artículos</button>
        <button class="btn btn-category" data-category="Guía">Guías</button>
        <button class="btn btn-category" data-category="Tip">Tips</button>
    </div>

    <!-- Grid -->
    <div class="row g-4" id="resource-list">
        @forelse($recursos as $index => $recurso)
        <div class="col-md-4 recurso-item" data-category="{{ $recurso->categoria }}">
            <div class="card resource-card" style="animation-delay: {{ $index * 0.1 }}s;">
                @if($recurso->imagen)
                <img src="{{ asset('storage/' . $recurso->imagen) }}" alt="{{ $recurso->titulo }}">
                @endif
                <div class="card-body">
                    <span class="category-badge mb-2">{{ $recurso->categoria }}</span>
                    <h5 class="card-title">{{ $recurso->titulo }}</h5>
                    <p class="card-text">{{ Str::limit($recurso->descripcion, 100) }}</p>
                    <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#resourceModal" onclick="showResource({{ $recurso->id }})">
                        Leer más
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p>No hay recursos disponibles.</p>
        </div>
        @endforelse
    </div>

    <!-- Modal -->
    <div class="modal fade" id="resourceModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img id="resourceImage" src="" alt="" class="img-fluid rounded mb-4 shadow">
                    <h3 id="resourceTitle" class="text-primary fw-bold mb-3"></h3>
                    <p class="text-muted mb-2" id="resourceDate"></p>
                    <div id="resourceContent" class="text-dark fs-6 lh-lg"></div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection

@section('scripts')
<script>
function showResource(id) {
    fetch(`/recursos/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('resourceImage').src = data.imagen ? `/storage/${data.imagen}` : '/images/default.jpg';
            document.getElementById('resourceTitle').textContent = data.titulo;
            document.getElementById('resourceDate').textContent = new Date(data.created_at).toLocaleDateString('es-ES');
            document.getElementById('resourceContent').innerHTML = `
                <p class="lead">${data.descripcion}</p>
                <hr>
                <div>${data.contenido.replace(/\n/g, '<br>')}</div>
            `;
        });
}

// Ocultar con fade
function fadeOut(el) {
    el.style.opacity = 1;
    el.style.transition = "opacity 0.3s ease";
    el.style.opacity = 0;
    setTimeout(() => el.style.display = "none", 300);
}

// Mostrar con fade
function fadeIn(el) {
    el.style.display = "block";
    el.style.opacity = 0;
    el.style.transition = "opacity 0.3s ease";
    setTimeout(() => el.style.opacity = 1, 10);
}

// Filtro
document.querySelectorAll('.btn-category').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.btn-category').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const selected = btn.dataset.category;
        document.querySelectorAll('.recurso-item').forEach(card => {
            const cat = card.dataset.category;
            if (selected === 'Todos' || cat === selected) {
                fadeIn(card);
            } else {
                fadeOut(card);
            }
        });
    });
});
</script>
@endsection
