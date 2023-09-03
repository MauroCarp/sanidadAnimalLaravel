<?php

namespace App\Http\Controllers;

use App\Reception;
use Illuminate\Http\Request;

class ReceptionsController extends Controller
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
    public function index(Request $request)
    {

        $campaign = $_COOKIE['campaign'];
        
        $recepciones = Reception::orderby('fechaEntrega','desc')->where('campaign',$campaign)->get();

        $marcasVacunas = Reception::distinct()->pluck('marca');

        return view('aftosa/receptions',['recepciones'=>$recepciones,'marcasVacunas'=>implode(',',$marcasVacunas->toArray())]);

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

        $fields = $request->validate([

            'fechaEntrega'=>'required',
            'uel'=>'required',
            'cantidad'=>'required',
            'marca'=>'required',
            'serie'=>'required',
            'fechaVencimiento'=>'required'
        ]);

                
        $fields['campaign'] = $_COOKIE['campaign'];

        Reception::create($fields);

        return redirect()->route('receptions.index')->with('carga','ok');

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
        $recepcion = Reception::find($id);
        $recepcion->delete();

        return redirect()->route('receptions.index')->with('eliminar','ok');

    }
}
