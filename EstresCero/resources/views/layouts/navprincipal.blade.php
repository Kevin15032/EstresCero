<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo') - Estrés Cero</title>

    <!-- Bootstrap y librerías externas -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Animate.css para animaciones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #E0F7FA;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header.custom-bg {
            background-color: #1D3557;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #A8DADC !important;
        }

        .nav-link.text-warning {
            color: #ffc107 !important;
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

        .section-title {
            color: #1D3557;
            border-bottom: 2px solid #457B9D;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        footer.footer {
            background-color: #1D3557;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: auto;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .nav-link {
                display: block;
                padding: 0.5rem 0;
            }

            .navbar-collapse {
                background-color: #1D3557;
                padding: 1rem;
            }
        }
    </style>

    @yield('estilos')
</head>
<body>
    <!-- Header -->
    <header class="custom-bg text-white py-3">
        <div class="container d-flex align-items-center justify-content-between flex-wrap">
            <h1 class="fs-4 mb-0">
                <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">
                    <i class="fas fa-brain me-2"></i> Estrés Cero
                </a>
            </h1>
            <nav class="d-flex flex-wrap align-items-center justify-content-end">
                <a class="nav-link px-3 {{ Route::is('dashboard') ? 'text-warning' : '' }}" href="{{ route('dashboard') }}">Inicio</a>
                <a class="nav-link px-3 {{ Route::is('recursos.index') ? 'text-warning' : '' }}" href="{{ route('recursos.index') }}">Recursos</a>
                <a class="nav-link px-3 {{ Route::is('ejercicios') ? 'text-warning' : '' }}" href="{{ route('ejercicios') }}">Ejercicios</a>
                <a class="nav-link px-3 {{ Route::is('seguimiento') ? 'text-warning' : '' }}" href="{{ route('seguimiento') }}">Seguimiento Emocional</a>
                <a class="nav-link px-3 {{ Route::is('foro') ? 'text-warning' : '' }}" href="{{ route('foro') }}">Foro</a>
                <a class="nav-link px-3 {{ Route::is('perfil') ? 'text-warning' : '' }}" href="{{ route('perfil') }}">Mi Perfil</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                </form>
            </nav>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="flex-grow-1">
        @yield('contenido')
    </main>

    <!-- Alertas -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true
            });
        </script>
    @endif

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Estrés Cero - Tu compañero en el bienestar estudiantil</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>

