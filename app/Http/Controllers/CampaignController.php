<?php

namespace App\Http\Controllers;

use App\Animals;
use App\Campaign;
use App\Producer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $renspas = Producer::distinct('renspa')->get('renspa');
        $campaign = 150;
        foreach ($renspas as $key => $value) {
            $value->campaign = $campaign;
        }

        Animals::insert($renspas->toArray());

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
        
        $campaignData = Campaign::where('numero',$id)->first();

        if(!is_null($campaignData->inicio)) $campaignData->inicio = Carbon::parse($campaignData->inicio)->format('Y-m-d'); 
        if(!is_null($campaignData->final))  $campaignData->final = Carbon::parse($campaignData->final)->format('Y-m-d'); 

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

        return redirect()->route('home')->with('updateCampaign','ok');
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
