<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { 
            background-color: #f8f9fa; 
        }
        .sidebar {
            background-color: #1D3557;
            min-height: 100vh;
            padding-top: 20px;
        }
        .sidebar-link {
            color: white !important;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .sidebar-link:hover {
            background-color: #457B9D;
            padding-left: 25px;
        }
        .sidebar-link.active {
            background-color: #457B9D;
            border-left: 4px solid #ffc107;
        }
        .main-content {
            padding: 20px;
        }
        .admin-header {
            background-color: white;
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-custom {
            background-color: #457B9D;
            color: white;
            border: none;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #1D3557;
            transform: scale(1.05);
        }
    </style>
    @yield('estilos')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="text-center mb-4">
                    <h4 class="text-white">Panel Admin</h4>
                </div>
                <nav class="nav flex-column">
                    <a class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                       href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users me-2"></i> Usuarios
                    </a>
                    <a class="sidebar-link {{ request()->routeIs('admin.recursos.*') ? 'active' : '' }}" 
                       href="{{ route('admin.recursos.index') }}">
                        <i class="fas fa-book me-2"></i> Recursos
                    </a>
                    <a class="sidebar-link {{ request()->routeIs('admin.ejercicios.*') ? 'active' : '' }}" 
                       href="{{ route('admin.ejercicios.index') }}">
                        <i class="fas fa-dumbbell me-2"></i> Ejercicios
                    </a>
                    <a class="sidebar-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}" 
                       href="{{ route('admin.profile') }}">
                        <i class="fas fa-user me-2"></i> Perfil
                    </a>
                </nav>
            </div>

            <!-- Contenido principal -->
            <div class="col-md-10 main-content">
                <div class="admin-header d-flex justify-content-between align-items-center">
                    <h2 class="m-0">@yield('titulo')</h2>
                </div>

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

                @yield('contenido')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>