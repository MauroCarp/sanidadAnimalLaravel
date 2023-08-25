<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    protected $guarded = [];

    protected $casts = [
        'fechaVencimiento' => 'datetime', 
        'fechaEntrega' => 'datetime'
    ];


}
