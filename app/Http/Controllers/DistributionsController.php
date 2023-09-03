<?php

namespace App\Http\Controllers;
use App\Distribution;
use App\Reception;
use App\Veterinarie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DistributionsController extends Controller
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
        $vacunadores = Veterinarie::orderby('nombre','asc')->get(['nombre','matricula']);

        $campaign = $_COOKIE['campaign'];
        
        $marcasVacunas = Reception::where('campaign',$campaign)->distinct()->pluck('marca');
        
        return View('aftosa/distributions',['vacunadores'=>$vacunadores,'marcasVacunas'=>implode(',',$marcasVacunas->toArray())]);
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
            'matricula'=>'required',
            'uel'=>'required',
            'marca'=>'required',
            'cantidad'=>'required',
            'fechaEntrega'=>'required'
        ]);

        $fields['campaign'] = $_COOKIE['campaign'];
        
        Distribution::create($fields);

        return redirect()->route('distributions.index')->with(['carga'=>'ok','matricula'=>$fields['matricula']]);
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
        $distribucion = Distribution::find($id);
        $matricula = $distribucion->matricula;
        $distribucion->delete();

        return redirect()->route('distributions.index')->with(['eliminar'=>'ok','matricula'=>$matricula]);
    }

    public function showDistributions(Request $request){

        
        $campaign = $_COOKIE['campaign'];

        $distribuciones = Distribution::where(['matricula'=>$request->vacunador,'campaign'=>$campaign])->get(['id','matricula','uel','cantidad','marca','fechaEntrega'])->toArray();

        return response($distribuciones,200);

    }
}
