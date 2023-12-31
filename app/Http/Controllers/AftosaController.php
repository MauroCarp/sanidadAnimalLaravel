<?php

namespace App\Http\Controllers;

use App\Acta;
use App\Producer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class AftosaController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function notVaccinated(){
        $campaign = $_COOKIE['campaign'];

        $noVacunados = DB::select("SELECT * FROM producers INNER JOIN districts ON producers.distrito_id = districts.key WHERE producers.renspa NOT IN (SELECT renspa FROM actas WHERE campaign = $campaign)");

        return view('aftosa/notVaccinated',['noVacunados'=>$noVacunados]);
    }

    public function diffSearch(){

        $campaign = $_COOKIE['campaign'];

        $diferencias = DB::select("SELECT producers.propietario, actas.cantidad, actas.renspa, (animals.vacas + animals.vaquillonas + animals.toros + animals.toritos + animals.terneros + animals.terneras + animals.novillos + animals.novillitos) as total 
        FROM actas 
        JOIN producers ON actas.renspa = producers.renspa 
        JOIN animals ON producers.renspa = animals.renspa 
        WHERE animals.campaign = $campaign AND actas.campaign = $campaign AND actas.cantidad != (animals.vacas + animals.vaquillonas + animals.toros + animals.toritos + animals.terneros + animals.terneras + animals.novillos + animals.novillitos)");

        foreach ($diferencias as $registro) {
            $registro->diferencia = $registro->cantidad - $registro->total;
        }

        return view('aftosa/diffSearch',['diferencias'=>$diferencias]);
    }

    public function parcialDiffSearch(){

        $campaign = $_COOKIE['campaign'];

        $diferencias = DB::select("SELECT producers.propietario, actas.cantidad, actas.renspa, (animals.vaquillonas + animals.toritos + animals.terneros + animals.terneras + animals.novillos + animals.novillitos) as total FROM actas 
        JOIN producers ON actas.renspa = producers.renspa 
        JOIN animals ON producers.renspa = animals.renspa 
        WHERE animals.campaign = $campaign AND actas.campaign = $campaign AND actas.cantidad != (animals.vaquillonas + animals.toritos + animals.terneros + animals.terneras + animals.novillos + animals.novillitos)");

        foreach ($diferencias as $registro) {
            $registro->diferencia = $registro->cantidad - $registro->total;
        }

        return view('aftosa/diffSearch',['diferencias'=>$diferencias]);

    }

    public function actasByProducer(Request $request){

        $field = $request->validate([
            'renspa'=>'required|size:17'
        ]);

        $actas = Acta::with('veterinario')
        ->orderby('fechaVacunacion','desc')
        ->where('renspa',$field['renspa'])
        ->get();

        if(count($actas) == 0){

            return redirect()->route('home')->with('actasProductor','error');

        };

        return view('aftosa/actasByProducer',['actas'=>$actas]);

    }

    public function producerSituation(Request $request){

        $field = $request->validate([
            'renspa'=>'required|size:17'
        ]);
        
        $campaign = $_COOKIE['campaign'];

        $datosEstablecimiento = Producer::with('distrito')
        ->join('animals','producers.renspa','=','animals.renspa')
        ->join('actas','producers.renspa','=','actas.renspa')
        ->where(['actas.campaign'=>$campaign,'producers.renspa'=>$request->renspa])
        ->first();

        if(is_null($datosEstablecimiento)){
            return redirect()->back()->with('error','noData');
        }

        $today = date('d-m-Y');

        $pdf = Pdf::loadView('aftosa.producerSituation',array('datosEstablecimiento'=>$datosEstablecimiento,'today'=>$today))->setOption(['defaultFont' => 'sans-serif']);
        $pdf->setPaper('a4', 'landscape');            
        
        return $pdf->stream();
    }

}
