<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tuberculosi extends Model
{

    protected $casts = [
        'fechaCarga' => 'datetime', 
        'fechaEstado' => 'datetime', 
        'fechaEnviado' => 'datetime', 
        'fechaNotificado' => 'datetime', 
        
    ];
    
    public function establecimiento(){

        return $this->belongsTo(Producer::class,'renspa','renspa');

    }
}
