@extends('layouts.PlantillaNavinicio')

@section('titulo', 'Inicio')

@section('contenido')
    <div class="hero-section position-relative">
        <img src="{{ asset('img/salud-entorno-estudio-musica-XxXx80.jpg') }}" alt="Estudiantes" class="w-100" style="height: 400px; object-fit: cover;">
        <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
            <div class="hero-overlay">
                <h2 class="hero-title">Gestiona tu Bienestar Estudiantil</h2>
                <p class="hero-text mb-0">Tu espacio seguro para manejar el estrés académico</p>
            </div>
        </div>
    </div>

    <main class="container text-center py-5">
        <h2 class="section-title">Gestiona tu Bienestar Estudiantil</h2>
        <p class="mb-4">Una plataforma diseñada especialmente para estudiantes universitarios que buscan mantener un equilibrio emocional y académico.</p>
        <a href="{{ route('registro') }}" class="btn btn-primary me-2">Crear Cuenta</a>
    </main>

    <section class="container py-5 bg-light">
        <h2 class="section-title text-center mb-4">Nuestros Servicios</h2>
        <div class="row text-center">
            <div class="col-md-3">
                <i class="fas fa-book-reader card-icon"></i>
                <h3>Recursos Educativos</h3>
                <p>Accede a artículos, videos y guías sobre manejo del estrés académico.</p>
            </div>
            <div class="col-md-3">
                <i class="fas fa-yoga card-icon"></i>
                <h3>Ejercicios Prácticos</h3>
                <p>Explora técnicas de meditación, yoga y ejercicios de relajación.</p>
            </div>
            <div class="col-md-3">
                <i class="fas fa-users card-icon"></i>
                <h3>Foro de Apoyo</h3>
                <p>Conecta con otros estudiantes y comparte experiencias en un espacio seguro.</p>
            </div>
            <div class="col-md-3">
                <i class="fas fa-chart-line card-icon"></i>
                <h3>Seguimiento Personal</h3>
                <p>Registra y monitorea tus niveles de estrés y estado de ánimo.</p>
            </div>
        </div>
    </section>
@endsection

@section('estilos')
<style>
    body { background-color: #E0F7FA; }
    .nav-link { color: white; }
    .nav-link:hover { color: #A8DADC; }
    .section-title { color: #1D3557; }
    .btn-primary { background-color: #457B9D; border: none; }
    .btn-primary:hover { background-color: #1D3557; }
    .card-icon { font-size: 2rem; color: #457B9D; }
    .custom-bg { background-color: #1D3557; }
    .hero-overlay {
        background: rgba(0, 0, 0, 0.5);
        padding: 2rem;
        border-radius: 10px;
    }
    .hero-title {
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 1rem;
    }
    .hero-text {
        font-size: 1.2rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    .custom-btn-outline {
        color: white;
        border: 2px solid white;
        background: transparent;
        transition: all 0.3s ease;
    }

    .custom-btn-outline:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        transform: translateY(-2px);
    }

    .custom-btn-solid {
        background-color: white;
        color: #1D3557;
        border: none;
        transition: all 0.3s ease;
    }

    .custom-btn-solid:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
        color: #1D3557;
    }
</style>
@endsection

@section('header')
<header class="custom-bg text-white py-3">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <h1>
                <a href="{{ route('home') }}" class="text-white text-decoration-none">
                    <i class="fas fa-brain"></i> Estrés Cero
                </a>
            </h1>
        </div>
        <nav>
            <a href="{{ route('login') }}" class="btn custom-btn-outline me-2">Iniciar Sesión</a>
            <a href="{{ route('registro') }}" class="btn custom-btn-solid">Registrarse</a>
        </nav>
    </div>
</header>
@endsection

@section('footer')
<footer class="custom-bg text-white text-center py-3">
    <p>© 2024 Estrés Cero - Tu compañero en el bienestar estudiantil</p>
</footer>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection