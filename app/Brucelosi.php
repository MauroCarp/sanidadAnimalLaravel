<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brucelosi extends Model
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

    public function tuberculosis(){
        
        return $this->hasOne(Tuberculosi::class,'renspa','renspa');

    }

}
