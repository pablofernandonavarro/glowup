<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar Usuario</h3>
        </div>
        <form wire:submit.prevent="save">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nombre completo">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="correo@ejemplo.com">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Nueva Contraseña (dejar en blanco para no cambiar)</label>
                    <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Mínimo 8 caracteres">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                    <input type="password" wire:model="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirmar contraseña">
                </div>

                <div class="form-group">
                    <label for="role">Rol</label>
                    <select wire:model="role" class="form-control @error('role') is-invalid @enderror" id="role">
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                    @error('role')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar Usuario
                </button>
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
