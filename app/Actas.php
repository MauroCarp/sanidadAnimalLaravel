<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actas extends Model
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
