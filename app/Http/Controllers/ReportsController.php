<?php

namespace App\Http\Controllers;

use App\Acta;
use App\Campaign;
use App\District;
use App\Producer;
use Carbon\Carbon;
use App\Veterinarie;
use App\Distribution;
use App\Mail\Schedule;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReportsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informes = array(
            'Animales Totales vacunados por vacunador',
            'Total de Bovinos Vacunados por localidad y total departamental',
            'Detalle Animales Vacunados por Vacunador',
            'Entrega de vacunas por vacunador',
            'Relacion Dosis entregada y Vacuna suministrada',
            'Cant. de Establecimientos por distrito con detalle de categorías',
            'Nomina de Vacunadores ordenada alfabeticamente',
            'Otras Especies',
            'Evolución semanal de la campaña',
            'Informe de Montos',
            'Informe Carbunclo y Brucelosis Vacunados',
            'Informe Carbunclo y Brucelosis NO Vacunados',
            'Cantidad de Establecimientos segun Sistema Productivo',
            'Cantidad de Animales segun Sistema Productivo',
            'Cronograma por Veterinario',
            // 'Cronograma Actual por Veterinario',
            // 'Exportar Base de Datos'
        );

        $vets = Veterinarie::orderby('nombre','asc')->get(['matricula','nombre']);

        return view('aftosa/reports/reports',['informes'=>$informes,'vets'=>$vets]);

    }

    public function reportPdf(Request $request,$key){
        set_time_limit(120);
        
        if($key == 8){
            set_time_limit(240);
        }

        $today = date('d-m-Y');

        $methodName = 'getReport' . $key;

        $campaign = $_COOKIE['campaign'];

        $vetsReports = [3,15,16];

        if (in_array($key,$vetsReports)){
            $data = ReportsController::$methodName($campaign,$request->selectVeterinario);
        } else {
            $data = ReportsController::$methodName($campaign);
        }
        
        $data['today'] = $today; 

        $route = 'aftosa.reports.report' . $key;

        $landscape = [3,4,5,6,8,15,16];
 
        $pdf = Pdf::loadView($route,$data)->setOption(['defaultFont' => 'sans-serif']);

        if (in_array($key,$landscape)){
            $pdf->setPaper('a4', 'landscape');            
        }

        if($key == 8){

            $pdf->save(storage_path('app/public/temp/pdf_generated.pdf'));
            return response()->json(['pdf_url' => asset('storage/temp/pdf_generated.pdf')]);
        } else {
            return $pdf->stream();
        }

    }

    public function schedule(Request $request){

        $campaign = $_COOKIE['campaign'];

        $data = ReportsController::actasByVet($campaign,$request->selectVeterinario);

        $data['informe'] = $request->type;

        return view('aftosa/reports/schedule',$data);
        
    }

    public function sendSchedule(Request $request){

        $campaign = $_COOKIE['campaign'];

        $today = date('d-m-Y');

        $data = ReportsController::getReport15($campaign,$request->matricula);

        $data['today'] = $today; 

        $route = 'aftosa.reports.report15';
        
        $pdf = Pdf::loadView($route,$data)->setOption(['defaultFont' => 'sans-serif']);
        
        $ruta_destino = public_path('pdf/schedule.pdf');
        
        $pdf->save($ruta_destino);

        $dataEmail = array('path'=>$ruta_destino,'vet'=>$data['vet']);

        Mail::to($data['vet']->email)->queue(new Schedule($dataEmail));

        return response('ok');
    }

    public function getReport1($campaign){

        $vets = Veterinarie::join('actas', 'veterinaries.matricula', '=', 'actas.matricula')
        ->where('actas.campaign', $campaign)
        ->orderby('nombre','desc')->get();

        $data = array('vets'=>array(),'total'=>0);
    
        foreach ($vets as $vet) {
            
            if(isset($data['vets'][$vet->matricula])){
                $data['vets'][$vet->matricula]['cantidad'] += $vet->cantidad;
            }else{
                $data['vets'][$vet->matricula] = array('nombre'=>$vet->nombre,'cantidad'=>$vet->cantidad);
            }
            
            $data['total'] += $vet->cantidad;

        }

        return $data;

    }

    public function getReport2($campaign){

        $distritosData = DB::select('SELECT producers.distrito_id, SUM(actas.cantidad) as totalVacunados, COUNT(actas.renspa) as totalEstablecimientos, SUM(animals.vacas + animals.vaquillonas + animals.toros + animals.toritos + animals.terneros + animals.terneras + animals.novillos + animals.novillitos) as totalAnimales, SUM(animals.vaquillonas + animals.toritos + animals.terneros + animals.terneras + animals.novillos + animals.novillitos) as totalParcial from producers  JOIN actas ON producers.renspa = actas.renspa JOIN animals ON actas.renspa = animals.renspa where actas.campaign = ? AND animals.campaign = ? GROUP BY producers.distrito_id ORDER BY producers.distrito_id', [$campaign,$campaign]);

        $data = array('totalEstablecimientos'=>0,'totalAnimales'=>0,'totalParcial'=>0,'totalVacunados'=>0);
        
        foreach ($distritosData as $distritoData) {

            $distrito = District::where('key',$distritoData->distrito_id)->get('name')->toArray(); 
            $distritoData->distrito = $distrito[0]['name'];

            $data['totalEstablecimientos'] += $distritoData->totalEstablecimientos;
            $data['totalAnimales']         += $distritoData->totalAnimales;
            $data['totalParcial']          += $distritoData->totalParcial;
            $data['totalVacunados']        += $distritoData->totalVacunados;

        }
        
        $data['distritosData'] = $distritosData;
        $data['promedioAnimales'] = $data['totalAnimales'] / $data['totalEstablecimientos'];

        return (array)$data;
    }

    public function getReport3($campaign,$matricula){

        $campaignData = Campaign::where('numero',$campaign)->first();

        $actasByVet = Producer::with('veterinarioInfo')
        ->join('actas','producers.renspa','=','actas.renspa')
        ->where(['actas.campaign'=>$campaign,'actas.matricula'=>$matricula])
        ->orderby('actas.acta','asc')
        ->get();

        $actasByVet = $actasByVet->toArray();

        if (empty($actasByVet)){
            $vet = Veterinarie::where('matricula',$matricula)->first('nombre');
            $vet = $vet->nombre;
        } else {
            $vet = $actasByVet[0]['veterinario_info']['nombre'];
        }

        return array('vet'=>$vet,'actasByVet'=>$actasByVet,'campaignData'=>$campaignData);
        
    }

    public function getReport4($campaign){

        $data = ReportsController::vacunasByVet($campaign);

        return (array)$data;

    }

    public function getReport5($campaign){

        $vacunasEntregadas = ReportsController::vacunasByVet($campaign);

        $aplicadas = Acta::where('campaign',$campaign)
        ->groupBy('matricula')
        ->selectRaw('matricula, SUM(cantidad) as aplicadas')
        ->get()->toArray();

        $totalAplicadas = 0;   
        $totalDiff = 0;

        foreach ($vacunasEntregadas['entregas'] as $matricula => $entregaVet) {
            
            $index = array_search($matricula, array_column($aplicadas, 'matricula'));
            $vacunasEntregadas['entregas'][$matricula]['aplicadas'] = $aplicadas[$index]['aplicadas'];
            $totalAplicadas += $aplicadas[$index]['aplicadas'];

            $diff = $vacunasEntregadas['entregas'][$matricula]['totalDosis'] - $aplicadas[$index]['aplicadas'];
            $vacunasEntregadas['entregas'][$matricula]['diff'] = $diff;
            $totalDiff += $diff;

        }

        $vacunasEntregadas['totalAplicadas'] = $totalAplicadas;
        $vacunasEntregadas['totalDiff'] = $totalDiff;
        
        return (array)$vacunasEntregadas;

    }

    public function getReport6($campaign){

        $distritosData = Producer::join('animals','producers.renspa','=','animals.renspa')
        ->join('districts','distrito_id','=','key')
        ->selectRaw('districts.name as localidad,
        COUNT(producers.renspa) as totalEstablecimientos,
        SUM(animals.vacas) as vacas,
        SUM(animals.vaquillonas) as vaquillonas,
        SUM(animals.toros) as toros,
        SUM(animals.toritos) as toritos,
        SUM(animals.terneros) as terneros,
        SUM(animals.terneras) as terneras,
        SUM(animals.novillos) as novillos,
        SUM(animals.novillitos) as novillitos,
        SUM(animals.vacas + animals.vaquillonas + animals.toros + animals.toritos + animals.terneros + animals.terneras + animals.novillos + animals.novillitos) as totalExistencia')
        ->where('animals.campaign',$campaign)
        ->groupBy('districts.name')
        ->get();

        $distritosData = $distritosData->toArray();
        
        $totalEstablecimientos = array_sum(array_column($distritosData, 'totalEstablecimientos'));  
        $totalVacas = array_sum(array_column($distritosData, 'vacas'));  
        $totalVaquillonas = array_sum(array_column($distritosData, 'vaquillonas'));  
        $totalTerneros = array_sum(array_column($distritosData, 'terneros'));  
        $totalTerneras = array_sum(array_column($distritosData, 'terneras'));  
        $totalNovillos = array_sum(array_column($distritosData, 'novillos'));  
        $totalNovillitos = array_sum(array_column($distritosData, 'novillitos'));  
        $totalToros = array_sum(array_column($distritosData, 'toros'));  
        $totalToritos = array_sum(array_column($distritosData, 'toritos'));  
        $totalExistencia = array_sum(array_column($distritosData, 'totalExistencia'));  
        
        return array('distritosData'=>$distritosData,
                     'totalEstablecimientos'=>$totalEstablecimientos,
                     'totalVacas'=>$totalVacas,
                     'totalVaquillonas'=>$totalVaquillonas,
                     'totalTerneros'=>$totalTerneros,
                     'totalTerneras'=>$totalTerneras,
                     'totalNovillos'=>$totalNovillos,
                     'totalNovillitos'=>$totalNovillitos,
                     'totalToros'=>$totalToros,
                     'totalToritos'=>$totalToritos,
                     'totalExistencia'=>$totalExistencia);
    }

    public function getReport7(){

        return array('vets'=>Veterinarie::orderby('nombre','asc')->get());

    }

    public function getReport8($campaign){

        $distritos = District::get();

        $data = array('distritosInfo'=>array());

        foreach ($distritos as $distrito) {

            if($distrito->key != 0){

                $distritoData = DB::select('SELECT producers.propietario,producers.renspa,producers.establecimiento,producers.explotacion,animals.caprinos,animals.ovinos,animals.porcinos,animals.equinos from producers JOIN animals ON producers.renspa = animals.renspa WHERE animals.campaign = ? AND producers.distrito_id = ?', [$campaign,$distrito->key]);
                
                if (count($distritoData) > 0){
                    $data['distritosInfo'][$distrito->name]['establecimientos'] = $distritoData;
                }

                foreach ($data['distritosInfo'] as $distrito => $distritoInfo) {

                        $data['distritosInfo'][$distrito]['totalEstablecimientos'] = count($distritoInfo['establecimientos']);
                        $data['distritosInfo'][$distrito]['totalCaprinos'] = array_sum(array_column($distritoInfo['establecimientos'], 'caprinos'));  
                        $data['distritosInfo'][$distrito]['totalOvinos'] = array_sum(array_column($distritoInfo['establecimientos'], 'ovinos'));  
                        $data['distritosInfo'][$distrito]['totalPorcinos'] = array_sum(array_column($distritoInfo['establecimientos'], 'porcinos'));  
                        $data['distritosInfo'][$distrito]['totalEquinos'] = array_sum(array_column($distritoInfo['establecimientos'], 'equinos'));  

                }

            }

        }

        return $data;
    }

    public function getReport9($campaign){

        $data = Acta::where('campaign',$campaign)->get(['fechaVacunacion','cantidad']);
         
        $output = array('totalActa'=>0,'totalAnimales'=>0);
        foreach ($data as $key => $acta) {

            $date = Carbon::createFromFormat('Y-m-d',$acta->fechaVacunacion->format('Y-m-d'));   
            $month = Carbon::createFromDate(null, $date->month, 1)->format('F');
            $week = $date->weekOfMonth;

            if(isset($data[$month][$week]['animales'])){

                $output['meses'][$month][$week]['animales'] += $acta->cantidad;
                
            } else {
                
                $output['meses'][$month][$week]['animales'] = $acta->cantidad;
                
            }

            if(isset($output['meses'][$month][$week]['actas'])){

                $output['meses'][$month][$week]['actas']++;

            } else {

                $output['meses'][$month][$week]['actas'] = 1;

            }

            ksort($output['meses'][$month]);

            $output['totalActa']++;
            $output['totalAnimales'] += $acta->cantidad;

        }

        return array('campaign'=>$campaign,'data'=>$output);


    }

    public function getReport10($campaign){

        $campaignData = Campaign::where('numero',$campaign)->get();

        $montosActas = Acta::where('campaign',$campaign)
        ->selectRaw('SUM(admAf) AS admAf, SUM(vacunadorAf) AS vacunadorAf, SUM(vacunaAf) AS vacunaAf, SUM(admCar) AS admCar, SUM(vacunadorCar) AS vacunadorCar, SUM(vacunaCar) AS vacunaCar, SUM(redondeoAf) AS redondeoAf, SUM(redondeoCar) AS redondeoCar')
        ->get();

        $data = array('campaignData'=>$campaignData->toArray(),'montosActas'=>$montosActas->toArray());

        return $data;
    }

    public function getReport11($campaign){
        
        $dataVacunados = Producer::with('veterinarioInfo')
        ->join('actas','producers.renspa','=','actas.renspa')
        ->where('actas.campaign',$campaign)
        ->orderby('producers.renspa','asc')
        ->get();

        $totalCar = 0;
        $totalBruce = 0;
        $totalEstCar= 0;
        $totalEstBruce = 0;

        $data = array();
        foreach ($dataVacunados as $registro) {

            if($registro->cantidadCar > 0 || $registro->cantidadBruce > 0){

                $data[] = $registro->toArray();
                $totalCar += $registro->cantidadCar;
                $totalBruce += $registro->cantidadBruce;
                if($registro->cantidadCar > 0) $totalEstCar++;
                if($registro->cantidadBruce > 0) $totalEstBruce++;

            }

        }

        return array('dataVacunados'=>$data,'totalCar'=>$totalCar,'totalBruce'=>$totalBruce,'totalEstCar'=>$totalEstCar,'totalEstBruce'=>$totalEstBruce);
    }

    public function getReport12($campaign){
        
        $dataVacunados = Producer::with('veterinarioInfo')
        ->join('actas','producers.renspa','=','actas.renspa')
        ->where('actas.campaign',$campaign)
        ->orderby('producers.renspa','asc')
        ->get();

        $totalEstCar= 0;
        $totalEstBruce = 0;

        $data = array();

        foreach ($dataVacunados as $registro) {

            $data[] = $registro->toArray();

            if($registro->cantidadCar == 0) $totalEstCar++;
            if($registro->cantidadBruce == 0) $totalEstBruce++;

        }

        return array('dataVacunados'=>$data,'totalEstCar'=>$totalEstCar,'totalEstBruce'=>$totalEstBruce);

    }

    public function getReport13($campaign){

        $sistemasProductivos = Producer::join('actas','producers.renspa','=','actas.renspa')
        ->where('actas.campaign',$campaign)
        ->selectRaw('producers.renspa,producers.establecimiento,producers.explotacion,actas.cantidad')
        ->orderBy('producers.explotacion')
        ->get();

        $data = array('sistemasProductivos'=>array());

        foreach ($sistemasProductivos as $registro) {
            
            $data['sistemasProductivos'][$registro->explotacion]['registros'][] = $registro;
        }
        

        foreach ($data['sistemasProductivos'] as $explotacion => $value) {
            $data['sistemasProductivos'][$explotacion]['totalEstablecimientos'] = count($data['sistemasProductivos'][$explotacion]['registros']);
        }
        
        return $data;

    }

    public function getReport14($campaign){

        $animalesByExplotacion = Producer::join('animals','producers.renspa','=','animals.renspa')
        ->selectRaw('producers.explotacion,
        SUM(animals.vacas + animals.vaquillonas + animals.toros + animals.toritos + animals.terneros + animals.terneras + animals.novillos + animals.novillitos) as total')
        ->where('animals.campaign',$campaign)
        ->orderby('producers.explotacion','asc')
        ->groupBy('producers.explotacion')
        ->get();
        return array('animalesByExplotacion'=>$animalesByExplotacion);

    }

    public function getReport15($campaign,$matricula){

        $data = ReportsController::actasByVet($campaign,$matricula);

        $data['totalParcial'] = array_sum(array_column($data['actasByVet']->toArray(), 'parcial'));
        $data['total']= array_sum(array_column($data['actasByVet']->toArray(), 'total'));

        return $data;

    }

    public function vacunasByVet($campaign){

        $vacunasEntregadas = Distribution::with('veterinario')->where('campaign',$campaign)->get();        

        $data = array('totalDosis'=>0);
        
        foreach ($vacunasEntregadas as $entrega) {


            if(isset($data['entregas'][$entrega->matricula])){

                $data['entregas'][$entrega->matricula]['totalDosis'] += $entrega->cantidad;
                
            } else {
                
                $data['entregas'][$entrega->matricula]['totalDosis'] = $entrega->cantidad;
                
            }

            $data['entregas'][$entrega->matricula]['entregas'][] = $entrega->toArray();
            
            $data['totalDosis'] += $entrega->cantidad;

        }

        return $data;

    }

    public function actasByVet($campaign,$matricula){

        $actasByVet = Producer::join('actas','producers.renspa','=','actas.renspa')
        ->join('animals','actas.renspa','=','animals.renspa')
        ->selectRaw("actas.fechaVacunacion,producers.renspa,producers.propietario,(animals.vaquillonas + animals.toritos + animals.terneros + animals.terneras + animals.novillos + animals.novillitos) as parcial,(animals.vacas + animals.vaquillonas + animals.toros + animals.toritos + animals.terneros + animals.terneras + animals.novillos + animals.novillitos) as total")
        ->where(['actas.campaign'=>$campaign,'animals.campaign'=>$campaign,'actas.matricula'=>$matricula])
        ->orderby('actas.fechaVacunacion','asc')
        ->get();

        $vet = Veterinarie::where('matricula',$matricula)->first(['nombre','matricula','email']);

        foreach ($actasByVet as $acta) {
                
            $fechaCarbon = Carbon::createFromFormat('Y-m-d H:i:s',$acta->fechaVacunacion);
            
            $fechaVacunacion = $fechaCarbon->format('d-m-Y');
            $fechaVencimiento = $fechaCarbon->addDays(180)->format('d-m-Y');

            $acta->fechaVacunacion = $fechaVacunacion;
            $acta->fechaVencimiento = $fechaVencimiento; 

        }

        return array('actasByVet'=>$actasByVet,'vet'=>$vet);
    }



}
