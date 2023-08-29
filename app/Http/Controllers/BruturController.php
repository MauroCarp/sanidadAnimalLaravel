<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Brucelosi;
use App\Tuberculosi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\informeSenasaExport;



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

    public function generalReport(Request $request){

        $dates = explode('*',str_replace(' ','',str_replace('/','-',str_replace('-','*',$request->rangeDate))));
        list($from,$to) = $dates;
        $from = date('Y-m-d',strtotime($from));
        $to = date('Y-m-d',strtotime($to));
        $today = date('d-m-Y');

        $brucelosis = Brucelosi::whereBetween('fechaEstado',[$from,$to])
        ->get();

        $dataBrucelosis = array('cantEstablecimientosDOESTotal'=>0,
                                'cantEstablecimientosDOESParcial'=>0,
                                'cantEstablecimientosMuVe'=>0,
                                'cantEstablecimientosSAN'=>0,
                                'cantEstablecimientosCSM'=>0,
                                'cantEstablecimientosCtrlInt'=>0,
                                'cantEstablecimientosRemuestreo'=>0,
                                'cantEstablecimientosPositivos'=>0,
                                'cantEstablecimientosNegativos'=>0,
                                'cantEstablecimientosSospechosos'=>0,
                                'cantAnimalesSAN'=>0,
                                'cantAnimalesCSM'=>0,
                                'cantAnimalesCtrlInt'=>0,
                                'cantAnimalesRemuestreo'=>0,
                                'cantAnimalesPositivos'=>0,
                                'cantAnimalesNegativos'=>0,
                                'cantAnimalesSospechosos'=>0,
                                'cantUPLibresCert'=>0,
                                'cantUPLibresCertCargadas'=>0,
                                'cantAnimalesLibresTotal'=>0
        );

        $tuberculosis = Tuberculosi::whereBetween('fechaEstado',[$from,$to])
        ->get();

        $dataTuberculosis= array('cantAnimalesTuberculinizados'=>0,
                                 'cantAnimalesLibresTuberculinizados'=>0,
                                 'cantEstablecimientosLibres'=>0,
                                 'cantEstablecimientosLibresCargados'=>0        
        );

        foreach ($brucelosis as $value) {
            
            $totalAnimales = $value->vacas + $value->vaquillonas + $value->toros;

            switch ($value->estado) {
                case 'DOES Total':
                    $dataBrucelosis['cantEstablecimientosDOESTotal']++;
                    $dataBrucelosis['cantUPLibresCert']++;
                    $dataBrucelosis['cantAnimalesLibresTotal'] += $totalAnimales;

                    if($value->fechaCarga >= $from AND $value->fechaCarga <= $to) 
                        $dataBrucelosis['cantUPLibresCertCargadas']++;

                    break;
                case 'DOES Parcial':
                    $dataBrucelosis['cantEstablecimientosDOESParcial']++;
                    
                    break;
                case 'MuVe':
                    $dataBrucelosis['cantEstablecimientosMuVe']++;
                    $dataBrucelosis['cantUPLibresCert']++;
                    $dataBrucelosis['cantAnimalesLibresTotal'] += $totalAnimales;

                    if($value->fechaCarga >= $from AND $value->fechaCarga <= $to) 
                        $dataBrucelosis['cantUPLibresCertCargadas']++;

                    break;
                case 'SAN':
                    $dataBrucelosis['cantEstablecimientosSAN']++;
                    $dataBrucelosis['cantAnimalesSAN'] += $totalAnimales;
                    
                    break;
                case 'CSM':
                    $dataBrucelosis['cantEstablecimientosCSM']++;
                    $dataBrucelosis['cantAnimalesCSM'] += $totalAnimales;

                    break;
                case 'Remuestreo':
                    $dataBrucelosis['cantEstablecimientosRemuestreo']++;
                    $dataBrucelosis['cantAnimalesRemuestreo'] += $totalAnimales;
                    
                    break;
                
                default:
                    # code...
                    break;
            }

            if($value->positivo > 0){
                $dataBrucelosis['cantEstablecimientosPositivos']++;
                $dataBrucelosis['cantAnimalesPositivos'] += $value->positivo;
            }

            if($value->negativo > 0){
                $dataBrucelosis['cantEstablecimientosNegativos']++;
                $dataBrucelosis['cantAnimalesNegativos'] += $value->negativo;
            }

            if($value->sospechoso > 0){
                $dataBrucelosis['cantEstablecimientosSospechosos']++;
                $dataBrucelosis['cantAnimalesSospechosos'] += $value->sospechoso;
            }
            
        }

        foreach ($tuberculosis as $value) {

            $totalAnimales = $value->vacas + $value->vaquillonas + $value->toros + $value->terneros + $value->terneras + $value->novillos + $value->novillitos;

            switch ($value->estado) {
                case 'Libre':
                    $dataTuberculosis['cantEstablecimientosLibres']++;
                    $dataTuberculosis['cantAnimalesLibresTuberculinizados'] += $totalAnimales;
                    $dataTuberculosis['cantAnimalesTuberculinizados'] += $totalAnimales;

                    if($value->fechaCarga >= $from AND $value->fechaCarga <= $to) 
                        $dataTuberculosis['cantEstablecimientosLibresCargados']++;

                    break;
                case 'RecertificaciÃ³n';
                case 'Recertificacion';
                case 'Recertificación':
                    $dataTuberculosis['cantEstablecimientosLibres']++;
                    $dataTuberculosis['cantAnimalesTuberculinizados']++;

                    if($value->fechaCarga >= $from AND $value->fechaCarga <= $to) 
                        $dataTuberculosis['cantEstablecimientosLibresCargados']++;
                    
                    break;
                
                default:
                    # code...
                    break;
            }
            
        }

        $data = ['dataBrucelosis'=>$dataBrucelosis,'dataTuberculosis'=>$dataTuberculosis,'today'=>$today,'periodo'=> $request->rangeDate];

        $pdf = Pdf::loadView('brutur.generalReport',$data)->setOption(['defaultFont' => 'sans-serif']);

        return $pdf->stream();


    }

}
