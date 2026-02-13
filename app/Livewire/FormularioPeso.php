<?php

namespace App\Livewire;

use App\Models\Peso;
use Livewire\Component;

class FormularioPeso extends Component
{
    public $peso;
    public $fecha;
    public $notas;

    public function mount()
    {
        $this->fecha = date('Y-m-d');
    }

    public function rules()
    {
        return [
            'peso' => 'required|numeric|min:0|max:500',
            'fecha' => 'required|date',
            'notas' => 'nullable|string|max:500',
        ];
    }

    public function guardar()
    {
        $this->validate();

        Peso::create([
            'user_id' => auth()->id(),
            'peso' => $this->peso,
            'fecha' => $this->fecha,
            'notas' => $this->notas,
        ]);

        session()->flash('message', 'Peso registrado exitosamente!');

        // Limpiar el formulario
        $this->reset(['peso', 'notas']);
        $this->fecha = date('Y-m-d');
    }

    public function render()
    {
        $ultimoPeso = Peso::where('user_id', auth()->id())
            ->latest('fecha')
            ->first();

        return view('livewire.formulario-peso', [
            'ultimoPeso' => $ultimoPeso
        ]);
    }
}
