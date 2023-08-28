<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acta extends Model
{
    protected $guarded = [];

    protected $casts = [
        'fechaVacunacion'=>'datetime',
        'fechaRecepcion'=>'datetime'
    ];

    public function veterinario(){

        return $this->belongsTo(Veterinarie::class,'matricula','matricula');

    }
}
