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
    public function index()
    {
        $brucelosisInfo = Brucelosi::join('producers','producers.renspa','=','brucelosis.renspa')
        ->whereIn('brucelosis.estado',['DOES Total','MuVe','Libre','RecertificaciÃ³n','Recertificacion','Recertificación'])
        ->where('notificado',0)
        ->where('notificado',0)
        ->get(['brucelosis.renspa',
               'producers.establecimiento',
               'producers.propietario',
               'producers.explotacion',
               'producers.veterinario',
               'brucelosis.estado',
               'brucelosis.fechaEstado']);

        $tuberculosisInfo = Tuberculosi::join('producers','producers.renspa','=','tuberculosis.renspa')
        ->whereIn('tuberculosis.estado',['Libre','RecertificaciÃ³n','Recertificacion','Recertificación'])
        ->get(['tuberculosis.renspa',
               'producers.establecimiento',
               'producers.propietario',
               'producers.explotacion',
               'producers.veterinario',
               'tuberculosis.estado',
               'tuberculosis.fechaEstado']);
        
        $alerts = array('vencidos'=>array(),'porVencer'=>array());

        $today = Carbon::today();

        foreach ($brucelosisInfo as $registro) {
            
            $fechaVencimiento = $registro->fechaEstado->addDays(365);
            $fechaMargen = $registro->fechaEstado->addMonths(11);

            $registro->campaign = 'Brucelosis';
            $registro->fechaVencimiento = $fechaVencimiento->format('d-m-Y');

            if($fechaVencimiento > $today) $alerts['vencidos'][] = $registro;

            if($today < $fechaVencimiento AND $today > $fechaMargen){
                $alerts['porVencer'][] = $registro;
            }

        }

        foreach ($tuberculosisInfo as $registro) {
            
            $fechaVencimiento = $registro->fechaEstado->addDays(365);
            $fechaMargen = $registro->fechaEstado->addMonths(11);

            $registro->campaign = 'Tuberculosis';
            $registro->fechaVencimiento = $fechaVencimiento->format('d-m-Y');

            if($today > $fechaVencimiento) $alerts['vencidos'][] = $registro;

            if($today < $fechaVencimiento AND $today > $fechaMargen){
                $alerts['porVencer'][] = $registro;
            }

        }

        return view('brutur/alerts',['alerts'=>$alerts]);
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
