<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showModal = false;
    public $editMode = false;
    public $userId;

    // Form fields
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role = 'user';
    public $foto_perfil;
    public $peso_inicial;
    public $peso_objetivo;
    public $altura;
    public $cintura;
    public $cadera;
    public $pecho;
    public $brazo;
    public $pierna;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
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

        return view('livewire.admin.user-manager', [
            'users' => $users,
            'stats' => $stats,
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->peso_inicial = $user->peso_inicial;
        $this->peso_objetivo = $user->peso_objetivo;
        $this->altura = $user->altura;
        $this->cintura = $user->cintura;
        $this->cadera = $user->cadera;
        $this->pecho = $user->pecho;
        $this->brazo = $user->brazo;
        $this->pierna = $user->pierna;

        $this->editMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . ($this->userId ?? 'NULL'),
            'role' => 'required|in:admin,user',
            'peso_inicial' => 'nullable|numeric|min:0',
            'peso_objetivo' => 'nullable|numeric|min:0',
            'altura' => 'nullable|numeric|min:0',
            'cintura' => 'nullable|numeric|min:0',
            'cadera' => 'nullable|numeric|min:0',
            'pecho' => 'nullable|numeric|min:0',
            'brazo' => 'nullable|numeric|min:0',
            'pierna' => 'nullable|numeric|min:0',
            'foto_perfil' => 'nullable|image|max:2048',
        ];

        if ($this->editMode) {
            $rules['password'] = 'nullable|min:6|confirmed';
        } else {
            $rules['password'] = 'required|min:6|confirmed';
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'peso_inicial' => $this->peso_inicial,
            'peso_objetivo' => $this->peso_objetivo,
            'altura' => $this->altura,
            'cintura' => $this->cintura,
            'cadera' => $this->cadera,
            'pecho' => $this->pecho,
            'brazo' => $this->brazo,
            'pierna' => $this->pierna,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->foto_perfil) {
            $path = $this->foto_perfil->store('profile-photos', 'public');
            $data['foto_perfil'] = $path;
        }

        if ($this->editMode) {
            $user = User::findOrFail($this->userId);

            // Delete old photo if exists and new one is uploaded
            if ($this->foto_perfil && $user->foto_perfil) {
                Storage::disk('public')->delete($user->foto_perfil);
            }

            $user->update($data);
            session()->flash('message', 'Usuario actualizado correctamente.');
        } else {
            User::create($data);
            session()->flash('message', 'Usuario creado correctamente.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        // Prevent deleting yourself
        if (auth()->id() === $id) {
            session()->flash('error', 'No podés eliminarte a vos mismo.');
            return;
        }

        $user = User::findOrFail($id);

        // Delete profile photo if exists
        if ($user->foto_perfil) {
            Storage::disk('public')->delete($user->foto_perfil);
        }

        $user->delete();
        session()->flash('message', 'Usuario eliminado correctamente.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = 'user';
        $this->foto_perfil = null;
        $this->peso_inicial = null;
        $this->peso_objetivo = null;
        $this->altura = null;
        $this->cintura = null;
        $this->cadera = null;
        $this->pecho = null;
        $this->brazo = null;
        $this->pierna = null;
        $this->resetErrorBag();
    }
}
