<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AftosaController extends Controller
{
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

    public function reports(){

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

        return view('aftosa/reports',['informes'=>$informes]);
    }

}
