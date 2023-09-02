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
use App\Producer;
use App\Record;
use DateTime;

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

    }

    public function show($renspa){

        $renspa = str_replace('-','/',$renspa);

        $dataEstablecimiento = Producer::with(['tuberculosis','brucelosis','veterinarioInfo'])->where('renspa',$renspa)->first();

        $registrosBrucelosis = Record::where(['campaign'=>'brucelosis','renspa'=>$renspa])
        ->selectRaw("id,fechaEstado,protocolo,estado,(positivo + negativo + sospechoso) as total, saneamiento, positivo,negativo,sospechoso")
        ->orderby('created_at','desc')
        ->get();

        $registrosTuberculosis = Record::where(['campaign'=>'tuberculosis','renspa'=>$renspa])
        ->selectRaw("id,fechaEstado,protocolo,estado,(positivo + negativo + sospechoso) as total, saneamiento, positivo,negativo,sospechoso")
        ->orderby('created_at','desc')
        ->get();

        $estados = array('brucelosis'=>array('DOES Total','DOES Muestreo','Tecnica PAL','MuVe','SAN','CSM','Control Interno','Remuestreo'),'tuberculosis'=>array('Libre','No Libre','Recertificación','En Saneamiento'));

        return view('/brutur/updateStatus',['dataEstablecimiento'=>$dataEstablecimiento,
                                            'registrosBrucelosis'=>$registrosBrucelosis,
                                            'registrosTuberculosis'=>$registrosTuberculosis,
                                            'estados'=>$estados]);

    }

    public function store(Request $request){
                
    }

    public function update(Request $request,$renspa){
        
        $renspaUrl = $renspa;
        $renspa = str_replace('-','/',$renspa);

        $request->validate([
            'fechaEstadoBrucelosis' => 'required',
            'fechaEstadoTuberculosis' => 'required'
        ]);

        $brucelosis = Brucelosi::where('renspa',$renspa)->first();
        $tuberculosis = Tuberculosi::where('renspa',$renspa)->first();

        $changes = BruturController::hasChanges($request->toArray(),$brucelosis->toArray(),$tuberculosis->toArray());

        $registroTuberculosis = ['campaign'=>'Tuberculosis',
                                'renspa'=>$renspa,
                                'protocolo'=>$request->protocoloTuberculosis,
                                'estado'=>$request->estadoTuberculosis,
                                'fechaEstado'=>$request->fechaEstadoTuberculosis,
                                'saneamiento'=>$request->saneamientoTuberculosis,
                                'positivo'=>$request->positivoTuberculosis,
                                'negativo'=>$request->negativoTuberculosis,
                                'sospechoso'=>$request->sospechosoTuberculosis
        ];

        $registroBrucelosis = ['campaign'=>'Brucelosis',
                                'renspa'=>$renspa,
                                'protocolo'=>$request->protocoloBrucelosis,
                                'estado'=>$request->estadoBrucelosis,
                                'fechaEstado'=>$request->fechaEstadoBrucelosis,
                                'saneamiento'=>$request->saneamientoBrucelosis,
                                'positivo'=>$request->positivoBrucelosis,
                                'negativo'=>$request->negativoBrucelosis,
                                'sospechoso'=>$request->sospechosoBrucelosis
        ];

        if($changes['brucelosis'] && $changes['tuberculosis']){
        Record::create($registroTuberculosis);
        Record::create($registroBrucelosis);
        }else if($changes['brucelosis']){
        Record::create($registroBrucelosis);
        }else if($changes['tuberculosis']){
        Record::create($registroTuberculosis);
        }

        $brucelosis->vacas = $request->vacasBrucelosis;
        $brucelosis->vaquillonas = $request->vaquillonasBrucelosis;
        $brucelosis->toros = $request->torosBrucelosis;
        $brucelosis->protocolo = $request->protocoloBrucelosis;

        $brucelosis->saneamiento = $request->saneamientoBrucelosis;
        $brucelosis->positivo = $request->positivoBrucelosis;
        $brucelosis->negativo = $request->negativoBrucelosis;
        $brucelosis->sospechoso = $request->sospechosoBrucelosis;

        if($brucelosis->estado == 'DOES Total' || $brucelosis->estado == 'MuVe'){

            if($brucelosis->estado != $request->estadoBrucelosis) $brucelosis->estadoSenasa = 'Pendiente';

            $brucelosis->saneamiento = 0;
            $brucelosis->positivo = 0;
            $brucelosis->negativo = 0;
            $brucelosis->sospechoso = 0;

        }

        $brucelosis->estado = $request->estadoBrucelosis;
        $brucelosis->fechaEstado = $request->fechaEstadoBrucelosis;

        $brucelosis->save();

        $tuberculosis->vacas = $request->vacasTuberculosis;
        $tuberculosis->vaquillonas = $request->vaquillonasTuberculosis;
        $tuberculosis->terneros = $request->ternerosTuberculosis;
        $tuberculosis->terneras = $request->ternerasTuberculosis;
        $tuberculosis->novillos = $request->novillosTuberculosis;
        $tuberculosis->novillitos = $request->novillitosTuberculosis;
        $tuberculosis->toros = $request->torosTuberculosis;
        $tuberculosis->protocolo = $request->protocoloTuberculosis;
        $tuberculosis->saneamiento = $request->saneamientoTuberculosis;
        $tuberculosis->positivo = $request->positivoTuberculosis;
        $tuberculosis->negativo = $request->negativoTuberculosis;
        $tuberculosis->sospechoso = $request->sospechosoTuberculosis;

        if($tuberculosis->estado == 'Libre' || $tuberculosis->estado == 'Recertificación'){

            if($tuberculosis->estado != $request->estadoTuberculosis) $tuberculosis->estadoSenasa = 'Pendiente';

            $tuberculosis->saneamiento = 0;
            $tuberculosis->positivo = 0;
            $tuberculosis->negativo = 0;
            $tuberculosis->sospechoso = 0;

        }

        $tuberculosis->estado = $request->estadoTuberculosis;
        $tuberculosis->fechaEstado = $request->fechaEstadoTuberculosis;
        $tuberculosis->save();
            
        return redirect("/brutur/updateStatus/$renspaUrl")->with(['update'=>'ok']);

    }

    public function alerts()
    {
        $brucelosisInfo = Brucelosi::join('producers','producers.renspa','=','brucelosis.renspa')
        ->whereIn('brucelosis.estado',['DOES Total','MuVe','Libre','RecertificaciÃ³n','Recertificacion','Recertificación'])
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
        ->where('notificado',0)
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
        ->whereNotIn('estado',['S/D','En Saneamiento','Saneado','No Libre'])
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
        
        $excel = Excel::download(new informeSenasaExport, "Enviados Senasa ($today).xls");

        DB::update('UPDATE brucelosis SET estadoSenasa = "Enviado" WHERE estadoSenasa = "Pendiente"');
        DB::update('UPDATE tuberculosis SET estadoSenasa = "Enviado" WHERE estadoSenasa = "Pendiente"');
        
        return $excel;
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

    public function setCertificate(Request $request){

        if($request->type == 'brucelosis'){
            $registro = Brucelosi::where('renspa',$request->renspa)->first();
        } else {
            $registro = Tuberculosi::where('renspa',$request->renspa)->first();
        }

        $registro->certificado = $request->certificado;
        $registro->estadoSenasa = 'Aprobado';

        $registro->save();
        
        $renspa = str_replace('/','-',$request->renspa);

        return redirect("/brutur/updateStatus/$renspa")->with('certificado','ok');

    }

    public function hasChanges($request,$brucelosis,$tuberculosis){

        $changes = array('brucelosis'=>false,'tuberculosis'=>false);

        $ignore = ['id',
                   'renspa',
                   'fechaEnviado',
                   'fechaCarga',
                   'certificado',
                   'notificado',
                   'fechaNotificado',
                   'estadoSenasa',
                   'created_at',
                   'updated_at'
                ];
                
        foreach ($brucelosis as $key => $value) {


            if(!in_array($key,$ignore)){
                
                if($key == 'fechaEstado') $value = date('Y-m-d',strtotime($value));
                
                if($value != $request[$key . "Brucelosis"]) $changes['brucelosis'] = true;    

            }

        }

        foreach ($tuberculosis as $key => $value) {


            if(!in_array($key,$ignore)){
                
                if($key == 'fechaEstado') $value = date('Y-m-d',strtotime($value));
                
                if($value != $request[$key . "Tuberculosis"]) $changes['tuberculosis'] = true;    

            }

        }

        return $changes;

    }

    // public function updateStatus($renspa){

    //     $renspa = str_replace('-','/',$renspa);

    //     $dataEstablecimiento = Producer::with(['tuberculosis','brucelosis','veterinarioInfo'])->where('renspa',$renspa)->first();

    //     $registrosBrucelosis = Record::where(['campaign'=>'brucelosis','renspa'=>$renspa])
    //     ->selectRaw("id,fechaEstado,protocolo,estado,(positivo + negativo + sospechoso) as total, saneamiento, positivo,negativo,sospechoso")
    //     ->orderby('fechaCarga','asc')
    //     ->get();

    //     $registrosTuberculosis = Record::where(['campaign'=>'tuberculosis','renspa'=>$renspa])
    //     ->selectRaw("id,fechaEstado,protocolo,estado,(positivo + negativo + sospechoso) as total, saneamiento, positivo,negativo,sospechoso")
    //     ->orderby('fechaCarga','asc')
    //     ->get();

    //     $estados = array('brucelosis'=>array('DOES Total','DOES Muestreo','Tecnica PAL','MuVe','SAN','CSM','Control Interno','Remuestreo'),'tuberculosis'=>array('Libre','No Libre','Recertificacíon','En Saneamiento'));

    //     return view('/brutur/updateStatus',['dataEstablecimiento'=>$dataEstablecimiento,
    //                                         'registrosBrucelosis'=>$registrosBrucelosis,
    //                                         'registrosTuberculosis'=>$registrosTuberculosis,
    //                                         'estados'=>$estados]);

    // }
}
