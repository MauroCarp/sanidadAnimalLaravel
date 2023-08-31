<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $casts = [
        'fechaEstado'=> 'dateTime',
        'fechaCarga'=> 'dateTime'
    ];
}
