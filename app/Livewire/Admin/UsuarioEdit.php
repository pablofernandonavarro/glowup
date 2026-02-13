<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class UsuarioEdit extends Component
{
    public $userId;
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = 'user';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ];
    }

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El email es obligatorio.',
        'email.email' => 'El email debe ser válido.',
        'email.unique' => 'Este email ya está registrado.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'role.required' => 'El rol es obligatorio.',
    ];

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role ?? 'user';
    }

    public function save()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        session()->flash('message', 'Usuario actualizado correctamente.');

        return redirect()->route('admin.usuarios.index');
    }

    public function render()
    {
        return view('livewire.admin.usuario-edit');
    }
}
