<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
 
    public function distrito()
    {

        return $this->belongsTo(District::class,'distrito_id','key');

    }

}
