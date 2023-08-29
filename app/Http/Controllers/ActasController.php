<?php

namespace App\Http\Controllers;

use App\Acta;
use App\Producer;
use App\Veterinarie;
use Illuminate\Http\Request;

class ActasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $campaign = $_COOKIE['campaign'];

        $renspa = Producer::with('veterinarioInfo')
        ->join('animals','producers.renspa','animals.renspa')
        ->where(['producers.renspa'=>$request->renspa,'animals.campaign'=>$campaign])->first();
        
        if(!is_null($renspa)){

            $vets = Veterinarie::orderby('nombre','asc')->get(['matricula','nombre']);

            $acta = Acta::where(['actas.renspa'=>$request->renspa,'actas.campaign'=>$campaign])
            ->first();
    
            if(!is_null($acta)){
                return view('aftosa/acta',['data'=>$renspa->toArray(),'acta'=>$acta,'vets'=>$vets,'action'=>'Modificar']);
            } else {
                return view('aftosa/acta',['data'=>$renspa->toArray(),'vets'=>$vets,'action'=>'Cargar']);
            }

        } else { 
            return redirect()->back()->with('error','renspa');
        }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($renspa)
    {
        
        $renspa = str_replace('-','/',$renspa);
        $campaign = $_COOKIE['campaign'];

        $establecimiento = Producer::with('veterinarioInfo')
        ->join('animals','producers.renspa','animals.renspa')
        ->where(['producers.renspa'=>$renspa,'animals.campaign'=>$campaign])->first();
        
        if(!is_null($renspa)){

            $vets = Veterinarie::orderby('nombre','asc')->get(['matricula','nombre']);

            $acta = Acta::where(['actas.renspa'=>$renspa,'actas.campaign'=>$campaign])
            ->first();
    
            if(!is_null($acta)){
                return view('aftosa/acta',['data'=>$establecimiento->toArray(),'acta'=>$acta,'vets'=>$vets,'action'=>'Modificar']);
            } else {
                return view('aftosa/acta',['data'=>$establecimiento->toArray(),'vets'=>$vets,'action'=>'Cargar']);
            }

        } else { 
            return redirect()->back()->with('error','renspa');
        }

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
}
