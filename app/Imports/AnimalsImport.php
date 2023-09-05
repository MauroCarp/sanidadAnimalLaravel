<?php

namespace App\Imports;

use App\Animal;
use Maatwebsite\Excel\Concerns\ToModel;

class AnimalsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Animal([
            //
        ]);
    }
}
