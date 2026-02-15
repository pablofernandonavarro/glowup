<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedidaCorporal extends Model
{
    protected $table = 'medidas_corporales';

    protected $fillable = [
        'user_id',
        'fecha',
        'cuello',
        'hombros',
        'pecho',
        'cintura',
        'cadera',
        'muslo',
        'pantorrilla',
        'brazo',
        'antebrazo',
        'notas',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'cuello' => 'decimal:2',
        'hombros' => 'decimal:2',
        'pecho' => 'decimal:2',
        'cintura' => 'decimal:2',
        'cadera' => 'decimal:2',
        'muslo' => 'decimal:2',
        'pantorrilla' => 'decimal:2',
        'brazo' => 'decimal:2',
        'antebrazo' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
