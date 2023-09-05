<?php

namespace App\Http\Controllers;

use App\Animals;
use App\Campaign;
use App\Imports\AnimalsImport;
use App\Producer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class CampaignController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $field = $request->validate([
            'numero'=>'required'
        ]);

        Campaign::create($field);

        $renspas = Producer::distinct('renspa')->get('renspa');

        foreach ($renspas as $value) {
            $value->campaign = $request->numero;
        }
        
        Animals::insert($renspas->toArray());

        return redirect()->route('home')->with(['newCampaign'=>'ok','campaign'=>$request->numero]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $campaignData = Cache::tags('campaign')->rememberForever('campaignData',function() use ($id) {

            $data = Campaign::where('numero',$id)->first();

            if(!is_null($data->inicio)) $data->inicio = Carbon::parse($data->inicio)->format('Y-m-d'); 
            if(!is_null($data->final))  $data->final = Carbon::parse($data->final)->format('Y-m-d'); 

            Cache::tags('campaign')->flush();

            return $data;

        });

        return json_encode($campaignData->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $fields = $request->validate([
            'campaignNumero' => 'required',
            'fechaInicio' => 'required',
            'fechaCierre' => 'required',
        ]);

        $campaign = Campaign::find($id);

        $campaign->inicio = $request->fechaInicio;
        $campaign->final = $request->fechaCierre;
        $campaign->admA = $request->precioAdmAftosa;
        $campaign->vacunadorA = $request->precioVeterinarioAftosa;
        $campaign->vacunaA = $request->precioVacunaAftosa;
        $campaign->admC = $request->precioAdmCarb;
        $campaign->vacunadorC = $request->precioVeterinarioCarb;
        $campaign->vacunaC = $request->precioVacunaCarb;

        $campaign->save();

        $productores = array();

        if (!is_null($request->file('existenciaAnimal'))){

            $rows = Excel::toArray(new AnimalsImport(),$request->file('existenciaAnimal'));
        
            foreach ($rows[0] as $key => $row) {
    
                if ($key != 0 && $key != count($rows[0]) - 1 ){

                    $data[] = ['vacas' => $row[3],
                               'toros' => $row[4],
                               'vaquillonas' => $row[5],
                               'novillos' => $row[6],
                               'novillitos' => $row[7],
                               'terneras' => $row[8],
                               'terneros' => $row[9],
                               'toritos' => $row[10]];

                    $animals = Animals::where(['renspa'=>$row[0],'campaign'=>$fields['campaignNumero']])->first();

                    if($animals){

                        $animals->vacas = $row[3];
                        $animals->toros = $row[4];
                        $animals->vaquillonas = $row[5];
                        $animals->novillos = $row[6];
                        $animals->novillitos = $row[7];
                        $animals->terneras = $row[8];
                        $animals->terneros = $row[9];
                        $animals->toritos = $row[10];
    
                        $animals->save();

                    } else { 
                        $productores[] = $row[0];
                    }

                }
    
            } 

        }

        Cache::tags('campaign')->flush();

        return redirect()->route('home')->with(['updateCampaign'=>'ok','checkProducers'=>implode(' | ',$productores)]);
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
}
