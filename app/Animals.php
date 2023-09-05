<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animals extends Model
{
    protected $guarded = [];

    public function establecimiento(){
        
        return $this->hasOne(Producer::class,'renspa','renspa');

    }
}
