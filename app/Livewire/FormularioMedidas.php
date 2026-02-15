<?php

namespace App\Livewire;

use App\Models\MedidaCorporal;
use Livewire\Component;

class FormularioMedidas extends Component
{
    public $fecha;
    public $cuello;
    public $hombros;
    public $pecho;
    public $cintura;
    public $cadera;
    public $muslo;
    public $pantorrilla;
    public $brazo;
    public $antebrazo;
    public $notas;

    public function mount()
    {
        $this->fecha = date('Y-m-d\TH:i');
    }

    public function rules()
    {
        return [
            'fecha' => 'required|date_format:Y-m-d\TH:i',
            'cuello' => 'nullable|numeric|min:0|max:200',
            'hombros' => 'nullable|numeric|min:0|max:200',
            'pecho' => 'nullable|numeric|min:0|max:200',
            'cintura' => 'nullable|numeric|min:0|max:200',
            'cadera' => 'nullable|numeric|min:0|max:200',
            'muslo' => 'nullable|numeric|min:0|max:200',
            'pantorrilla' => 'nullable|numeric|min:0|max:200',
            'brazo' => 'nullable|numeric|min:0|max:200',
            'antebrazo' => 'nullable|numeric|min:0|max:200',
            'notas' => 'nullable|string|max:500',
        ];
    }

    public function guardar()
    {
        $this->validate();

        // Verificar que al menos una medida haya sido ingresada
        $medidas = collect([
            $this->cuello,
            $this->hombros,
            $this->pecho,
            $this->cintura,
            $this->cadera,
            $this->muslo,
            $this->pantorrilla,
            $this->brazo,
            $this->antebrazo,
        ])->filter()->count();

        if ($medidas === 0) {
            session()->flash('error', 'Debes ingresar al menos una medida corporal.');
            return;
        }

        MedidaCorporal::create([
            'user_id' => auth()->id(),
            'fecha' => $this->fecha,
            'cuello' => $this->cuello,
            'hombros' => $this->hombros,
            'pecho' => $this->pecho,
            'cintura' => $this->cintura,
            'cadera' => $this->cadera,
            'muslo' => $this->muslo,
            'pantorrilla' => $this->pantorrilla,
            'brazo' => $this->brazo,
            'antebrazo' => $this->antebrazo,
            'notas' => $this->notas,
        ]);

        session()->flash('message', 'Medidas registradas exitosamente!');

        $this->redirect(route('historial'), navigate: true);
    }

    public function render()
    {
        $ultimaMedida = MedidaCorporal::where('user_id', auth()->id())
            ->latest('fecha')
            ->first();

        return view('livewire.formulario-medidas', [
            'ultimaMedida' => $ultimaMedida,
        ]);
    }
}
