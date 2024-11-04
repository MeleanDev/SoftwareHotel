<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ubicacione extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'pais',
        'estado',
        'municipio',
        'direccion',
        'sede_id'
    ];

    protected $hidden = ['sede_id'];

    public function sede(): BelongsTo
    {
        return $this->belongsTo(Sede::class);
    }
}
