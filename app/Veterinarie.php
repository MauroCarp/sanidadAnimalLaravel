<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veterinarie extends Model
{
    
    protected $guarded = [];
    
    public function distributions(){
        return $this->hasMany(Distribution::class,'matricula','matricula');
    }
    
    public function actas(){
        return $this->hasMany(Acta::class,'matricula','matricula');
    }


}
