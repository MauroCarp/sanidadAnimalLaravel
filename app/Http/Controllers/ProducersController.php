<?php

namespace App\Http\Controllers;

use App\Animals;
use App\Brucelosi;
use App\Campaign;
use App\District;
use App\Producer;
use App\Tuberculosi;
use App\Veterinarie;
use Illuminate\Http\Request;

class ProducersController extends Controller
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

        return view('producers',[
            'distritos'=>District::get(['key','name']),
            'vacunadores'=>Veterinarie::orderby('nombre','asc')->get(['nombre','matricula']),
            'productores'=> Producer::all()
        ]);

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
            'renspa' => 'required',
            'propietario' => 'required',
            'establecimiento' => 'required',
            'explotacion' => 'required',
            'regimen' => 'required',
            'tipoDoc' => 'required',
            'numDoc' => 'required',
            'iva' => 'nullable',
            'telefono' => 'nullable',
            'email' => 'required|email',
            'domicilio' => 'required',
            'localidad' => 'required',
            'provincia' => 'required',
            'departamento' => 'required',
            'distrito_id' => 'required',
            'veterinario' => 'required',
        ]);

        $departamento = ProducersController::getDepartmentId($fields['departamento']);

        $fields['departamento'] = $departamento;
        
        Producer::create($fields);

        $campaign = Campaign::max('numero');

        Brucelosi::create(['renspa'=>$fields['renspa']]);
        Tuberculosi::create(['renspa'=>$fields['renspa']]);
        Animals::create(['renspa'=>$fields['renspa'],'campaign'=>$campaign]);

        return redirect()->route('producers.index')->with('crear','ok');
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

        $request->validate([
            'renspa' => 'required',
            'propietario' => 'required',
            'establecimiento' => 'required',
            'explotacion' => 'required',
            'regimen' => 'required',
            'tipoDoc' => 'required',
            'numDoc' => 'required',
            'iva' => 'nullable',
            'telefono' => 'nullable',
            'email' => 'required|email',
            'domicilio' => 'required',
            'localidad' => 'required',
            'provincia' => 'required',
            'departamento' => 'required',
            'distrito_id' => 'required',
            'veterinario' => 'required',
        ]);
        
        $productor = Producer::find($id);

        $productor->renspa = $request->renspa;
        $productor->propietario = $request->propietario;
        $productor->establecimiento = $request->establecimiento;
        $productor->explotacion = $request->explotacion;
        $productor->regimen = $request->regimen;
        $productor->tipoDoc = $request->tipoDoc;
        $productor->numDoc = $request->numDoc;
        $productor->iva = $request->iva;
        $productor->telefono = $request->telefono;
        $productor->email = $request->email;
        $productor->domicilio = $request->domicilio;
        $productor->localidad = $request->localidad;
        $productor->provincia = $request->provincia;
        $productor->departamento = ProducersController::getDepartmentId($request->departamento);
        $productor->distrito_id = $request->distrito_id;
        $productor->veterinario = $request->veterinario;

        $productor->save();

        return redirect()->route('producers.index')->with('editar','ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productor = Producer::find($id);

        $productor->delete();

        return redirect()->route('producers.index')->with('eliminar','ok');
    
    }

    public function getDepartmentId($name){

        $departamentos = array(8 => 'IRIONDO',6 => 'BELGRANO');

        return array_search($name,$departamentos);

    }

}
