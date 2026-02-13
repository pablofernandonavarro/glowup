<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Usuarios</h3>
            <div class="card-tools">
                <a href="{{ route('admin.usuarios.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Nuevo Usuario
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Barra de búsqueda -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Buscar por nombre o email...">
                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Tabla de usuarios -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Fecha de Registro</th>
                            <th width="150">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @if($usuario->role === 'admin')
                                        <span class="badge badge-danger">Administrador</span>
                                    @else
                                        <span class="badge badge-primary">Usuario</span>
                                    @endif
                                </td>
                                <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($usuario->id !== auth()->id())
                                        <button wire:click="confirmUserDeletion({{ $usuario->id }})" class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No se encontraron usuarios</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ $usuarios->links() }}
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    @if($confirmingUserDeletion)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Eliminación</h5>
                        <button type="button" class="close" wire:click="$set('confirmingUserDeletion', false)">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('confirmingUserDeletion', false)">Cancelar</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteUser">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
