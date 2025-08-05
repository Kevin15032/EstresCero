@extends('layouts.PlantillaNavinicio')

@section('titulo', 'Inicio')

@section('contenido')
<div class="hero-section position-relative">
    <img src="{{ asset('img/salud-entorno-estudio-musica-XxXx80.jpg') }}" alt="Estudiantes" class="w-100" style="height: 400px; object-fit: cover;">
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white px-3">
        <div class="hero-overlay">
            <h2 class="hero-title">Gestiona tu Bienestar Estudiantil</h2>
            <p class="hero-text mb-0">Tu espacio seguro para manejar el estrés académico</p>
        </div>
    </div>
</div>

<main class="container text-center py-5">
    <h2 class="section-title mb-3">Gestiona tu Bienestar Estudiantil</h2>
    <p class="mb-4">Una plataforma diseñada especialmente para estudiantes universitarios que buscan mantener un equilibrio emocional y académico.</p>
    <a href="{{ route('registro') }}" class="btn btn-success btn-lg shadow-sm">
        <i class="fas fa-user-plus me-2"></i> Crear Cuenta
    </a>
</main>

<section class="container py-5 bg-light rounded shadow-sm">
    <h2 class="section-title text-center mb-4">Nuestros Servicios</h2>
    <div class="row text-center">
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="fs-2 text-primary"><i class="fas fa-book-reader"></i></div>
                <h5 class="mt-3">Recursos Educativos</h5>
                <p>Accede a artículos, videos y guías sobre manejo del estrés académico.</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="fs-2 text-primary"><i class="fas fa-dumbbell"></i></div> <!-- Ícono agregado -->
                <h5 class="mt-3">Ejercicios Prácticos</h5>
                <p>Explora técnicas de meditación, yoga y ejercicios de relajación.</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="fs-2 text-primary"><i class="fas fa-users"></i></div>
                <h5 class="mt-3">Foro de Apoyo</h5>
                <p>Conecta con otros estudiantes y comparte experiencias en un espacio seguro.</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="fs-2 text-primary"><i class="fas fa-chart-line"></i></div>
                <h5 class="mt-3">Seguimiento Personal</h5>
                <p>Registra y monitorea tus niveles de estrés y estado de ánimo.</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('estilos')
<style>
    body {
        background-color: #E0F7FA;
        font-family: 'Poppins', sans-serif;
    }

    .hero-overlay {
        background: rgba(0, 0, 0, 0.5);
        padding: 2rem;
        border-radius: 10px;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-text {
        font-size: 1.2rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    .section-title {
        color: #1D3557;
        font-weight: 600;
    }

    .btn-success {
        background-color: #2ca58d;
        border: none;
    }

    .btn-success:hover {
        background-color: #1d7f6b;
    }
</style>
@endsection
