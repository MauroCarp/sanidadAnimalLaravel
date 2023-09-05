<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    protected $guarded = [];
 
    public function distrito()
    {

        return $this->belongsTo(District::class,'distrito_id','key');

    }
 
    public function veterinarioInfo()
    {
        
        return $this->belongsTo(Veterinarie::class,'veterinario','matricula');
        

    }

    public function tuberculosis(){
        
        return $this->hasOne(Tuberculosi::class,'renspa','renspa');

    }

    public function brucelosis(){

        return $this->hasOne(Brucelosi::class,'renspa','renspa');

    }

    public function animals(){

        return $this->belongsTo(Animals::class,'renspa','renspa');

    }

}
