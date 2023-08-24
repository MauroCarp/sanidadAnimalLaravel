<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Brucelosi;
use App\Tuberculosi;
use Illuminate\Http\Request;
use App\Exports\informeSenasaExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class BruturController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function notifieds(){

        $notificadosBrucelosis = Brucelosi::with('establecimiento')->where('notificado','1')->get();
        $notificadosTuberculosis = Tuberculosi::with('establecimiento')->where('notificado','1')->get();

        $notificadosBrucelosis = $notificadosBrucelosis->map(function ($registro) {
            $registro->campania = "Brucelosis";
            return $registro;
        });
      
        $notificadosTuberculosis = $notificadosTuberculosis->map(function ($registro) {
            $registro->campania = "Tuberculosis";
            return $registro;
        });

        $notificados = $notificadosBrucelosis->merge($notificadosTuberculosis);

        return view('brutur/notifieds',['notificados'=>$notificados]);
    }

    public function pending(Request $request){

        $pendientesBrucelosis = Brucelosi::with('establecimiento')
        ->where('estadoSenasa','Pendiente')
        ->whereNotIn('estado',['S/D','En Saneamiento','Saneado'])
        ->get();
        $pendientesTuberculosis = Tuberculosi::with('establecimiento')
        ->where('estadoSenasa','Pendiente')
        ->whereNotIn('estado',['S/D','En Saneamiento','Saneado'])
        ->get();

        $pendientesBrucelosis = $pendientesBrucelosis->map(function ($registro) {
            $registro->campania = "Brucelosis";
            return $registro;
        });
      
        $pendientesTuberculosis = $pendientesTuberculosis->map(function ($registro) {
            $registro->campania = "Tuberculosis";
            return $registro;
        });

        $pendientes = $pendientesBrucelosis->merge($pendientesTuberculosis);

        $status = isset($request->status) ? $request->status : '';

        return view('brutur/pending',['pendientes'=>$pendientes,'status'=>$status]);
    }

    public function exportSenasa(){

        $today = Carbon::now()->format('d-m-Y');

        DB::update('UPDATE brucelosis SET estadoSenasa = "Enviado" WHERE estadoSenasa = "Pendiente"');
        DB::update('UPDATE tuberculosis SET estadoSenasa = "Enviado" WHERE estadoSenasa = "Pendiente"');
        
        return Excel::download(new informeSenasaExport, "Enviados Senasa ($today).xls");
    }

}
