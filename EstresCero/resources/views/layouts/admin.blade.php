<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('titulo')</title>
    
    <!-- Bootstrap y Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            background-color: #1D3557;
            min-height: 100vh;
            padding-top: 20px;
            box-shadow: 2px 0 6px rgba(0,0,0,0.1);
        }

        .sidebar h4 {
            color: #fff;
            font-weight: bold;
        }

        .sidebar-link {
            color: #f1f1f1;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .sidebar-link i {
            margin-right: 10px;
        }

        .sidebar-link:hover {
            background-color: #2e5a99;
            padding-left: 25px;
        }

        .sidebar-link.active {
            background-color: #457B9D;
            border-left: 5px solid #ffc107;
            font-weight: bold;
        }

        .main-content {
            padding: 30px;
        }

        .admin-header {
            background-color: white;
            padding: 20px 30px;
            margin-bottom: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-custom {
            background-color: #457B9D;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #1D3557;
            transform: scale(1.05);
        }

        .content-box {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
    </style>

    @yield('estilos')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar d-flex flex-column align-items-start px-3">
                <div class="text-center w-100 mb-4">
                    <h4>Panel Admin</h4>
                </div>
                <nav class="w-100">
                    <a class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                       href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users"></i> Usuarios
                    </a>
                    <a class="sidebar-link {{ request()->routeIs('admin.recursos.*') ? 'active' : '' }}" 
                       href="{{ route('admin.recursos.index') }}">
                        <i class="fas fa-book"></i> Recursos
                    </a>
                    <a class="sidebar-link {{ request()->routeIs('admin.ejercicios.*') ? 'active' : '' }}" 
                       href="{{ route('admin.ejercicios.index') }}">
                        <i class="fas fa-dumbbell"></i> Ejercicios
                    </a>
                    <a class="sidebar-link {{ request()->routeIs('admin.perfil') ? 'active' : '' }}" 
                       href="{{ route('admin.perfil') }}">
                        <i class="fas fa-user"></i> Perfil
                    </a>
                </nav>
            </div>

            <!-- Contenido principal -->
            <div class="col-md-10 main-content">
                <div class="admin-header">
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

                <div class="content-box">
                    @yield('contenido')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
