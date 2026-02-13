<?php

namespace App\Livewire;

use App\Models\Peso;
use Livewire\Component;

class Graficos extends Component
{
    public $periodo = 30; // días por defecto

    public function updatedPeriodo()
    {
        // Se recarga automáticamente cuando cambia el período
    }

    public function render()
    {
        $usuario = auth()->user();

        // Obtener registros según el período
        $query = Peso::where('user_id', $usuario->id)
            ->orderBy('fecha', 'asc');

        if ($this->periodo != 'all') {
            $query->where('fecha', '>=', now()->subDays($this->periodo));
        }

        $registros = $query->get();

        // Preparar datos para el gráfico
        $labels = $registros->pluck('fecha')->map(fn($fecha) => $fecha->format('d M'))->toArray();
        $datos = $registros->pluck('peso')->toArray();

        // Estadísticas
        $pesoActual = $registros->last()?->peso ?? 0;
        $pesoInicial = $registros->first()?->peso ?? 0;
        $cambio = $pesoActual - $pesoInicial;

        // Meta (puedes hacer esto configurable por usuario)
        $meta = 70.0;

        // Calcular progreso hacia la meta
        $diferenciaTotal = abs($pesoInicial - $meta);
        $diferenciaActual = abs($pesoActual - $meta);
        $progreso = $diferenciaTotal > 0 ? (($diferenciaTotal - $diferenciaActual) / $diferenciaTotal) * 100 : 0;
        $progreso = max(0, min(100, $progreso)); // Entre 0 y 100

        $faltante = $pesoActual - $meta;

        // Estimación (basada en el cambio promedio)
        $diasConRegistros = $registros->count() > 1 ?
            $registros->first()->fecha->diffInDays($registros->last()->fecha) : 0;

        $tasaCambioDiaria = $diasConRegistros > 0 ? $cambio / $diasConRegistros : 0;
        $semanasEstimadas = $tasaCambioDiaria != 0 ? abs($faltante / ($tasaCambioDiaria * 7)) : 0;

        return view('livewire.graficos', [
            'labels' => $labels,
            'datos' => $datos,
            'pesoActual' => $pesoActual,
            'cambio' => $cambio,
            'meta' => $meta,
            'progreso' => round($progreso),
            'faltante' => $faltante,
            'semanasEstimadas' => round($semanasEstimadas),
            'hayDatos' => $registros->count() > 0
        ]);
    }
}
