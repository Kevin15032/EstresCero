<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo') - Estrés Cero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #E0F7FA; }
        .nav-link { color: white; }
        .nav-link:hover { color: #A8DADC; }
        .custom-bg { background-color: #1D3557; }
    </style>
    @yield('estilos')
</head>
<body>
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
                <a class="btn btn-outline-light me-2" href="{{ route('sesion') }}">Iniciar Sesión</a>
                <a class="btn btn-light" href="{{ route('registro') }}">Registrarse</a>
            </nav>
        </div>
    </header>

    @yield('contenido')

    <footer class="custom-bg text-white text-center py-3 mt-4">
        <p>&copy; {{ date('Y') }} Estrés Cero - Tu compañero en el bienestar estudiantil</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>