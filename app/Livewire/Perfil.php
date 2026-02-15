<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Peso;
use App\Models\MedidaCorporal;

class Perfil extends Component
{
    use WithFileUploads;

    public $peso_inicial;
    public $peso_objetivo;
    public $altura;

    public $foto_perfil;
    public $password_actual;
    public $password_nuevo;
    public $password_confirmacion;

    public $mostrarModalConfirmacion = false;
    public $mostrarModalExito = false;

    public function mount()
    {
        $user = auth()->user();
        $this->peso_inicial = $user->peso_inicial;
        $this->peso_objetivo = $user->peso_objetivo;
        $this->altura = $user->altura;
    }

    public function rules()
    {
        return [
            'peso_inicial' => 'nullable|numeric|min:0|max:500',
            'peso_objetivo' => 'nullable|numeric|min:0|max:500',
            'altura' => 'nullable|numeric|min:0|max:300',
        ];
    }

    public function updatedFotoPerfil()
    {
        if ($this->foto_perfil) {
            $this->actualizarFoto();
        }
    }

    public function actualizarFoto()
    {
        $this->validate([
            'foto_perfil' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($user->foto_perfil && Storage::disk('public')->exists($user->foto_perfil)) {
            Storage::disk('public')->delete($user->foto_perfil);
        }

        $path = $this->foto_perfil->store('fotos-perfil', 'public');

        $user->update(['foto_perfil' => $path]);

        $this->dispatch('foto-actualizada');
        $this->reset('foto_perfil');
    }

    public function cambiarPassword()
    {
        $this->validate([
            'password_actual' => 'required',
            'password_nuevo' => 'required|min:8|same:password_confirmacion',
            'password_confirmacion' => 'required',
        ]);

        if (!\Hash::check($this->password_actual, auth()->user()->password)) {
            $this->addError('password_actual', 'La contraseña actual no es correcta.');
            return;
        }

        auth()->user()->update([
            'password' => \Hash::make($this->password_nuevo),
        ]);

        $this->reset(['password_actual', 'password_nuevo', 'password_confirmacion']);
        $this->dispatch('password-actualizada');
    }

    public function guardar()
    {
        try {
            $this->validate();

            auth()->user()->update([
                'peso_inicial' => $this->peso_inicial,
                'peso_objetivo' => $this->peso_objetivo,
                'altura' => $this->altura,
            ]);

            $this->dispatch('perfil-guardado');
        } catch (\Exception $e) {
            // Error handling
        }
    }

    public function confirmarEliminacion()
    {
        $this->mostrarModalConfirmacion = true;
    }

    public function cancelarEliminacion()
    {
        $this->mostrarModalConfirmacion = false;
    }

    public function eliminarDatos()
    {
        $user = auth()->user();

        Peso::where('user_id', $user->id)->delete();
        MedidaCorporal::where('user_id', $user->id)->delete();

        $this->mostrarModalConfirmacion = false;
        $this->mostrarModalExito = true;
    }

    public function render()
    {
        return view('livewire.perfil');
    }
}
