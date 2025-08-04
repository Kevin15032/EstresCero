@extends('layouts.admin')

@section('titulo', 'Gestión de Usuarios')

@section('estilos')
<style>
    .table-custom {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .table-custom th {
        background-color: #1D3557;
        color: white;
        border: none;
        text-align: center;
        vertical-align: middle;
    }
    .table-custom td {
        vertical-align: middle;
        text-align: center;
    }
    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ccc;
    }
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85em;
    }
    .status-active {
        background-color: #28a745;
        color: white;
    }
    .status-inactive {
        background-color: #dc3545;
        color: white;
    }
    .search-box {
        max-width: 300px;
    }
    .btn-icon {
        padding: 6px 10px;
        font-size: 0.9rem;
    }
</style>
@endsection

@section('contenido')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 text-primary"><i class="fas fa-users me-2"></i>Lista de Usuarios</h4>
                        <form action="{{ route('admin.users.search') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control search-box me-2" 
                                   placeholder="Buscar usuario..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-custom">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-custom">
                            <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>
                                        <img src="{{ $user->avatar 
                                            ? asset('storage/' . $user->avatar) 
                                            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}" 
                                            alt="{{ $user->name }}" class="user-avatar">
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->is_admin ? 'info' : 'secondary' }}">
                                            {{ $user->is_admin ? 'Administrador' : 'Usuario' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $user->is_active ? 'status-active' : 'status-inactive' }}">
                                            {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary btn-icon" 
                                                onclick="editUser({{ $user->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.users.toggle', $user->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-icon {{ $user->is_active ? 'btn-warning' : 'btn-success' }}">
                                                <i class="fas {{ $user->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No se encontraron usuarios</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Editar Usuario</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="is_admin" class="form-label">Rol</label>
                        <select class="form-control" id="is_admin" name="is_admin">
                            <option value="0">Usuario</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function editUser(userId) {
    fetch(`/admin/users/${userId}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('name').value = data.name;
            document.getElementById('email').value = data.email;
            document.getElementById('is_admin').value = data.is_admin ? "1" : "0";
            document.getElementById('editUserForm').action = `/admin/users/${userId}`;
            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        });
}
</script>
@endsection
