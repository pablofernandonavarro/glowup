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
        $this->fecha = date('Y-m-d\TH:i');
    }

    public function rules()
    {
        return [
            'peso' => 'required|numeric|min:0|max:500',
            'fecha' => 'required|date_format:Y-m-d\TH:i',
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

        $this->redirect(route('graficos'), navigate: true);
    }

    public function render()
    {
        $user = auth()->user();
        $ultimoPeso = Peso::where('user_id', auth()->id())
            ->latest('fecha')
            ->first();

        // Calcular progreso
        $progreso = null;
        $diferencia = null;
        if ($user->peso_objetivo && $ultimoPeso) {
            $diferencia = $ultimoPeso->peso - $user->peso_objetivo;
            if ($user->peso_inicial) {
                $totalPerder = $user->peso_inicial - $user->peso_objetivo;
                $perdido = $user->peso_inicial - $ultimoPeso->peso;
                $progreso = $totalPerder > 0 ? ($perdido / $totalPerder) * 100 : 0;
            }
        }

        return view('livewire.formulario-peso', [
            'ultimoPeso' => $ultimoPeso,
            'pesoObjetivo' => $user->peso_objetivo,
            'pesoInicial' => $user->peso_inicial,
            'progreso' => $progreso,
            'diferencia' => $diferencia
        ]);
    }
}
