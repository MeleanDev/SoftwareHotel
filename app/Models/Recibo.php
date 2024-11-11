<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recibo extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'monto',
        'estado',
        'fecha_emision',
        'reserva_id',
        'identificador'
    ];

    public function reserva(): BelongsTo
    {
        return $this->belongsTo(Reserva::class);
    }
}
