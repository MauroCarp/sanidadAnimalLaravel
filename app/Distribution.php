<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $guarded = [];
    
    protected $casts = [
        'fechaEntrega' => 'datetime'
    ];

    public function veterinario(){
        return $this->belongsTo(Veterinarie::class,'matricula','matricula');
    }
}
