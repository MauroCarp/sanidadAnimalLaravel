<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $guarded = [];

    protected $cast = [
        'inicio'=>'datetime',
        'final'=>'datetime'
    ];
}
