<?php

namespace App\Exports;

use App\Brucelosi;
use App\Tuberculosi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class informeSenasaExport implements FromView
{

    public function view(): View
    {
        $pendientesBrucelosis = Brucelosi::with(['establecimiento','establecimiento.veterinarioInfo'])
        ->where(['positivo'=>0,'estadoSenasa'=>'Pendiente'])
        ->whereIn('brucelosis.estado',['DOES Total','MuVe'])
        ->get();

        $pendientesTuberculosis = Tuberculosi::with(['establecimiento','establecimiento.veterinarioInfo'])
        ->where(['positivo'=>0,'estadoSenasa'=>'Pendiente'])
        ->whereIn('estado',['Libre','Recertificación'])
        ->get();

        $pendientesBrucelosis = $pendientesBrucelosis->map(function ($registro) {
            $registro->campania = "Brucelosis";
            return $registro;
        });
      
        $pendientesTuberculosis = $pendientesTuberculosis->map(function ($registro) {
            $registro->campania = "Tuberculosis";
            return $registro;
        });

        $pending = $pendientesBrucelosis->merge($pendientesTuberculosis);

        $output = $pending->map(function($pend){

            return [
                'renspa'=>$pend->renspa,
                'propietario'=>$pend->establecimiento->propietario,
                'motivo'=>$pend->estado,
                'fechaMuestra'=>$pend->fechaEstado->format('d-m-Y'),
                'veterinario'=>$pend->establecimiento->veterinarioInfo->nombre,
            ];

        });

        return view('exports.informeSenasaExport', [
            'pending' => $output
        ]);        
    }

}
