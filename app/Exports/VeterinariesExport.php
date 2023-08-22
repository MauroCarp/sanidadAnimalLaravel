<?php

namespace App\Exports;

use App\Veterinarie;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VeterinariesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Veterinarie::orderby('nombre','asc')->get(['nombre','matricula','domicilio','telefono','email','cuit']);
    }

}
