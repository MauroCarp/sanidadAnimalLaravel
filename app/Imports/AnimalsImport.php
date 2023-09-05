<?php

namespace App\Imports;

use App\Animals;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AnimalsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {

    }
}
