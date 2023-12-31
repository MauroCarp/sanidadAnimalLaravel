<?php

namespace App\Http\Controllers;

use App\Veterinarie;
use Illuminate\Http\Request;
use App\Exports\VeterinariesExport;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;


class VeterinariesController extends Controller
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

        $veterinaries = Cache::tags('veterinaries')->rememberForever('veterinaries',function(){

            return Veterinarie::all();

        });

        return view('veterinaries',['veterinarios'=> $veterinaries]);

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
    public function store(Request $request){

        $fields = $request->validate([
            'nombre' => 'required',
            'matricula' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',
            'email' => 'required|email',
            'cuit' => 'required',
            'tipo' => 'required',
        ]);

        Veterinarie::create($fields);

        Cache::tags('veterinaries')->flush();

        return redirect()->route('veterinaries.index')->with('crear','ok');
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
    public function update(Request $request,$id)
    {
        
        $validator = $request->validate([
            'nombre' => 'required',
            'matricula' => 'required',
            'domicilio' => 'required',
            'telefono' => 'required',
            'email' => 'required|email',
            'cuit' => 'required',
            'tipo' => 'required',
        ]);
        
        $vet = Veterinarie::find($id);

        $vet->nombre = $request->nombre;
        $vet->matricula = $request->matricula;
        $vet->domicilio = $request->domicilio;
        $vet->telefono = $request->telefono;
        $vet->email = $request->email;
        $vet->cuit = $request->cuit;
        $vet->tipo = $request->tipo;
        $vet->save();

        Cache::tags('veterinaries')->flush();

        return redirect()->route('veterinaries.index')->with('editar','ok')->withErrors($validator);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        $vet = Veterinarie::find($id);

        $vet->delete();
        
        Cache::tags('veterinaries')->flush();

        return redirect()->route('veterinaries.index')->with('eliminar','ok');

    }

    public function export(){   
        return Excel::download(new VeterinariesExport, 'Lista veterinarios.xls');
    }
}
