<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reserva extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'estado',
        'identificador',
        'fecha_entrada',
        'fecha_salida',
        'habitacione_id',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function habitacione(): BelongsTo
    {
        return $this->belongsTo(Habitacione::class);
    }

    public function recibo(): HasMany
    {
        return $this->hasMany(Recibo::class);
    }
}
