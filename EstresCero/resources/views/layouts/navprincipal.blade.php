<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo') - Estrés Cero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background-color: #E0F7FA; }
        .custom-bg { background-color: #1D3557; }
        .nav-link {
            color: white !important;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .nav-link:hover { color: #E0F7FA !important; }
        .feature-card {
            transition: transform 0.3s ease;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .feature-card:hover { transform: translateY(-5px); }
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
    </style>
    @yield('estilos')
</head>
<body>
    <header class="custom-bg text-white py-3">
        <div class="container d-flex align-items-center justify-content-between">
            <h1>
                <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">
                    <i class="fas fa-brain"></i> Estrés Cero
                </a>
            </h1>
            <nav>
                <a class="nav-link d-inline px-3" href="{{ route('dashboard') }}">Inicio</a>
                <a class="nav-link d-inline px-3" href="{{ route('recursos') }}">Recursos</a>
                <a class="nav-link d-inline px-3" href="{{ route('ejercicios') }}">Ejercicios</a>
                <a class="nav-link d-inline px-3" href="{{ route('seguimiento') }}">Seguimiento Emocional</a>
                <a class="nav-link d-inline px-3" href="{{ route('foro') }}">Foro</a>
                <a class="nav-link d-inline px-3" href="{{ route('perfil') }}">Mi Perfil</a>
            </nav>
        </div>
    </header>

    @yield('contenido')

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Estrés Cero - Tu compañero en el bienestar estudiantil</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>