<?php

namespace App\Http\Controllers;

use App\District;
use App\Producer;
use App\Veterinarie;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
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
            'Cronograma Actual por Veterinario',
            'Exportar Base de Datos'
        );

        return view('aftosa/reports/reports',['informes'=>$informes]);

    }

    public function reportPdf($key){
        
        $today = date('d-m-Y');


        $methodName = 'getReport' . $key;

        $campaign = $_COOKIE['campaign'];

        $data = ReportsController::$methodName($campaign);
  
        $data['today'] = $today; 

        $route = 'aftosa.reports.report' . $key;

        // return view($route,['distritosData'=>$data['distritosData'],
        // 'today'=>$today,
        // 'totalEstablecimientos'=>$data['totalEstablecimientos'],
        // 'totalAnimales'=>$data['totalAnimales'],
        // 'totalParcial'=>$data['totalParcial'],
        // 'totalVacunados'=>$data['totalVacunados'],
        // 'promedioAnimales'=>$data['promedioAnimales']]);

        $pdf = Pdf::loadView($route,$data);
        return $pdf->stream();

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



}
