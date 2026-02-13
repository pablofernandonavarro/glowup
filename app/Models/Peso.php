<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peso extends Model
{
    protected $fillable = [
        'user_id',
        'peso',
        'fecha',
        'notas',
    ];

    protected $casts = [
        'fecha' => 'date',
        'peso' => 'decimal:1',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
