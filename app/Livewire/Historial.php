<?php

namespace App\Livewire;

use App\Models\Peso;
use Livewire\Component;

class Historial extends Component
{
    public function render()
    {
        $registros = Peso::where('user_id', auth()->id())
            ->orderBy('fecha', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($registro) {
                return $registro->fecha->format('F Y'); // Agrupar por mes
            });

        $totalRegistros = Peso::where('user_id', auth()->id())->count();
        $primerRegistro = Peso::where('user_id', auth()->id())
            ->orderBy('fecha', 'asc')
            ->first();

        $usuario = auth()->user();

        return view('livewire.historial', [
            'registros' => $registros,
            'totalRegistros' => $totalRegistros,
            'primerRegistro' => $primerRegistro,
            'pesoObjetivo' => $usuario->peso_objetivo
        ]);
    }
}
