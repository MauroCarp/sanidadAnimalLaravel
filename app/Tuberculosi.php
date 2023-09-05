<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tuberculosi extends Model
{

    protected $guarded = [];
    
    protected $casts = [
        'fechaCarga' => 'datetime', 
        'fechaEstado' => 'datetime', 
        'fechaEnviado' => 'datetime', 
        'fechaNotificado' => 'datetime', 
        
    ];
    
    public function establecimiento(){

        return $this->hasOne(Producer::class,'renspa','renspa');

    }

    public function brucelosis(){

        return $this->hasOne(Brucelosi::class,'renspa','renspa');

    }
}
