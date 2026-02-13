<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingUserDeletion = false;
    public $userIdBeingDeleted = null;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmUserDeletion($userId)
    {
        $this->confirmingUserDeletion = true;
        $this->userIdBeingDeleted = $userId;
    }

    public function deleteUser()
    {
        if ($this->userIdBeingDeleted) {
            $user = User::find($this->userIdBeingDeleted);

            if ($user && $user->id !== auth()->id()) {
                $user->delete();
                session()->flash('message', 'Usuario eliminado correctamente.');
            }
        }

        $this->confirmingUserDeletion = false;
        $this->userIdBeingDeleted = null;
    }

    public function render()
    {
        $usuarios = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.usuarios', [
            'usuarios' => $usuarios
        ]);
    }
}
