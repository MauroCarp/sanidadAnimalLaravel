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
        return Veterinarie::get(['nombre','matricula','domicilio','telefono','email','cuit']);
    }

    public function headings(): array
    {
        return [
            'nombre',
            'matricula',
            'domicilio',
            'telefono',
            'email',
            'cuit',
        ];
    }
}
