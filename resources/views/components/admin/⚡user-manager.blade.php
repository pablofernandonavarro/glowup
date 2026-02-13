<?php

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

new class extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $editMode = false;

    // Form fields
    public $userId;
    public $name;
    public $email;
    public $password;
    public $role = 'user';

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:user,admin',
        ];

        if ($this->editMode) {
            $rules['email'] .= '|unique:users,email,' . $this->userId;
            $rules['password'] = 'nullable|min:8';
        } else {
            $rules['email'] .= '|unique:users,email';
            $rules['password'] = 'required|min:8';
        }

        return $rules;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->reset(['name', 'email', 'password', 'role', 'userId']);
        $this->editMode = false;
        $this->showModal = true;
    }

    public function openEditModal($userId)
    {
        $user = User::findOrFail($userId);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->password = '';
        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editMode) {
            $user = User::findOrFail($this->userId);
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ];

            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }

            $user->update($data);
            session()->flash('message', 'Usuario actualizado exitosamente.');
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => $this->role,
            ]);
            session()->flash('message', 'Usuario creado exitosamente.');
        }

        $this->closeModal();
    }

    public function delete($userId)
    {
        if ($userId == auth()->id()) {
            session()->flash('error', 'No podés eliminar tu propio usuario.');
            return;
        }

        User::findOrFail($userId)->delete();
        session()->flash('message', 'Usuario eliminado exitosamente.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['name', 'email', 'password', 'role', 'userId']);
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = [
            'total' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'users' => User::where('role', 'user')->count(),
        ];

        return [
            'users' => $users,
            'stats' => $stats,
        ];
    }
};
?>

<div>
    <!-- Messages -->
    @if (session()->has('message'))
        <div class="mb-4 rounded-xl bg-green-50 border border-green-200 p-4">
            <p class="text-sm text-green-800">{{ session('message') }}</p>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-4">
            <p class="text-sm text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600">Total Usuarios</p>
                    <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['total'] }}</p>
                </div>
                <div class="size-12 rounded-lg bg-indigo-50 grid place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6 text-indigo-600">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600">Administradores</p>
                    <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['admins'] }}</p>
                </div>
                <div class="size-12 rounded-lg bg-fuchsia-50 grid place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6 text-fuchsia-600">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600">Usuarios Normales</p>
                    <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['users'] }}</p>
                </div>
                <div class="size-12 rounded-lg bg-blue-50 grid place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-6 text-blue-600">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="bg-white rounded-xl border border-slate-200 p-4 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Buscar por nombre o email..."
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
            </div>
            <button
                wire:click="openCreateModal"
                class="px-6 py-2 rounded-lg bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white font-semibold shadow-lg hover:scale-105 transition whitespace-nowrap"
            >
                + Nuevo Usuario
            </button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Usuario</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Rol</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($user->foto_perfil)
                                        <img src="{{ asset('storage/' . $user->foto_perfil) }}" alt="" class="size-10 rounded-full object-cover">
                                    @else
                                        <div class="size-10 rounded-full bg-gradient-to-br from-fuchsia-500 to-indigo-500 grid place-items-center text-white font-bold">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-slate-900">{{ $user->name }}</p>
                                        @if($user->id === auth()->id())
                                            <span class="text-xs text-indigo-600">(Tú)</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-fuchsia-100 text-fuchsia-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $user->role === 'admin' ? 'Admin' : 'Usuario' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button
                                    wire:click="openEditModal({{ $user->id }})"
                                    class="text-indigo-600 hover:text-indigo-900 font-medium text-sm"
                                >
                                    Editar
                                </button>
                                @if($user->id !== auth()->id())
                                    <button
                                        wire:click="delete({{ $user->id }})"
                                        wire:confirm="¿Estás seguro de eliminar este usuario?"
                                        class="text-red-600 hover:text-red-900 font-medium text-sm"
                                    >
                                        Eliminar
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                No se encontraron usuarios
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" style="display: block;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" wire:click="closeModal"></div>

                <div class="relative bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-slate-900">
                            {{ $editMode ? 'Editar Usuario' : 'Nuevo Usuario' }}
                        </h3>
                        <button wire:click="closeModal" class="text-slate-400 hover:text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="save" class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nombre</label>
                            <input
                                type="text"
                                id="name"
                                wire:model="name"
                                class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                            @error('name') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                            <input
                                type="email"
                                id="email"
                                wire:model="email"
                                class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                            @error('email') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">
                                Contraseña {{ $editMode ? '(dejar vacío para no cambiar)' : '' }}
                            </label>
                            <input
                                type="password"
                                id="password"
                                wire:model="password"
                                class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                            @error('password') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-medium text-slate-700 mb-1">Rol</label>
                            <select
                                id="role"
                                wire:model="role"
                                class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                                <option value="user">Usuario</option>
                                <option value="admin">Administrador</option>
                            </select>
                            @error('role') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button
                                type="button"
                                wire:click="closeModal"
                                class="flex-1 px-4 py-2 rounded-lg border border-slate-200 text-slate-700 font-medium hover:bg-slate-50"
                            >
                                Cancelar
                            </button>
                            <button
                                type="submit"
                                class="flex-1 px-4 py-2 rounded-lg bg-gradient-to-br from-fuchsia-600 to-indigo-600 text-white font-semibold hover:scale-105 transition"
                            >
                                {{ $editMode ? 'Actualizar' : 'Crear' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
