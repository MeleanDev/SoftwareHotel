<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habitacione extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'identificador',
        'piso',
        'tipo',
        'disponibilidad',
        'numPersonas',
        'precio',
        'sede_id'
        ];

    public function sede(): BelongsTo
    {
        return $this->belongsTo(Sede::class);
    }

    public function reserva(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }
}
