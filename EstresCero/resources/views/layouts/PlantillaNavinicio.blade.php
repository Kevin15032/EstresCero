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
        body { 
            background-color: #E0F7FA; 
        }
        .custom-bg { 
            background-color: #1D3557; 
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
                @guest
                    <a href="{{ route('login') }}" class="btn custom-btn-outline me-2">Iniciar Sesión</a>
                    <a href="{{ route('registro') }}" class="btn custom-btn-solid">Registrarse</a>
                @else
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn custom-btn-outline me-2">Panel Admin</a>
                        <a href="{{ route('admin.users.index') }}" class="btn custom-btn-outline me-2">Gestión Usuarios</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn custom-btn-outline">Cerrar Sesión</button>
                    </form>
                @endguest
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