<?php

namespace App\Exports;

use App\Veterinarie;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VeterinariesExport implements FromView
{

    public function view(): View
    {
        return view('exports.veterinariesExport', [
            'veterinaries' => Veterinarie::orderby('nombre','asc')->get(['nombre','matricula','domicilio','telefono','email','cuit'])
        ]);    
    }

}
