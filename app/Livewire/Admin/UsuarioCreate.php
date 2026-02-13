<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class UsuarioCreate extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = 'user';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:user,admin',
    ];

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El email es obligatorio.',
        'email.email' => 'El email debe ser válido.',
        'email.unique' => 'Este email ya está registrado.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'role.required' => 'El rol es obligatorio.',
    ];

    public function save()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'email_verified_at' => now(),
        ]);

        session()->flash('message', 'Usuario creado correctamente.');

        return redirect()->route('admin.usuarios.index');
    }

    public function render()
    {
        return view('livewire.admin.usuario-create');
    }
}
