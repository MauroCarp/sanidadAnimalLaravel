<?php

namespace App\Http\Controllers;

use App\Acta;
use App\Animals;
use App\Campaign;
use App\Producer;
use App\Veterinarie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $fieldsActa = $request->validate([
            'fechaVacunacion' => 'required',
            'fechaRecepcion' => 'required',
            'matricula' => 'required',
            'cantidad' => 'required',
            'acta' => 'required'
        ]);

        $campaign = $_COOKIE['campaign'];

        $campaignData = Campaign::where('numero',$campaign)->first();

        $fieldsActa['campaign'] = $campaign;
        $fieldsActa['renspa'] = $request->renspa;
        $fieldsActa['pago'] = isset($request->pago) ? 1 : 0;
        $fieldsActa['redondeoAf'] = $request->redondeoAf;
        $fieldsActa['redondeoCar'] = $request->redondeoCar;
        $fieldsActa['cantidadCar'] = $request->cantidadCar;
        $fieldsActa['cantidadBruce'] = $request->cantidadBruce;
        $fieldsActa['vacunoBruce'] = isset($request->vacunoBruce) ? 1 : 0;
        $fieldsActa['vacunoCar'] = isset($request->vacunoCar) ? 1 : 0;

        $admAf = $campaignData->admA * $fieldsActa['cantidad'];
        $vacunadorAf = $campaignData->vacunadorA * $fieldsActa['cantidad'];
        $vacunaAf = $campaignData->vacunaA * $fieldsActa['cantidad'];
        $admCar = $campaignData->admC * $fieldsActa['cantidad'];
        $vacunadorCar = $campaignData->vacunadorC * $fieldsActa['cantidad'];
        $vacunaCar = $campaignData->vacunaC * $fieldsActa['cantidad'];

        $fieldsActa['admAf'] = $admAf;
        $fieldsActa['vacunadorAf'] = $vacunadorAf;
        $fieldsActa['vacunaAf'] = $vacunaAf;
        $fieldsActa['admCar'] = $admCar;
        $fieldsActa['vacunadorCar'] = $vacunadorCar;
        $fieldsActa['vacunaCar'] = $vacunaCar;

        Acta::create($fieldsActa);

        $animals = Animals::where(['renspa'=>$request->renspa,'campaign'=>$campaign])->first();
        $animals->vacas = $request->vacas;
        $animals->toros = $request->toros;
        $animals->toritos = $request->toritos;
        $animals->novillos = $request->novillos;
        $animals->novillitos = $request->novillitos;
        $animals->vaquillonas = $request->vaquillonas;
        $animals->terneras = $request->terneras;
        $animals->terneros = $request->terneros;
        $animals->bufaloMay = $request->bufMay;
        $animals->bufaloMen = $request->bufMen;
        $animals->caprinos = $request->caprinos;
        $animals->ovinos = $request->ovinos;
        $animals->porcinos = $request->porcinos;
        $animals->equinos = $request->equinos;

        $animals->save();

        return redirect()->route('home')->with('actaCreated','ok'); // REVISAR REDIRECCION CREATED

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

        if(!is_null($establecimiento)){

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
    public function update(Request $request, $renspa)
    {
        $fieldsActa = $request->validate([
            'fechaVacunacion' => 'required',
            'fechaRecepcion' => 'required',
            'matricula' => 'required',
            'cantidad' => 'required',
            'acta' => 'required'
        ]);

        $campaign = $_COOKIE['campaign'];

        $renspaUrl = $renspa;
        $renspa = str_replace('-','/',$renspa);

        $campaignData = Campaign::where('numero',$campaign)->first();

        $acta = Acta::where(['renspa'=>$renspa,'campaign'=>$campaign])->first();
        $acta->fechaVacunacion = $fieldsActa['fechaVacunacion'];
        $acta->fechaRecepcion  = $fieldsActa['fechaRecepcion'];
        $acta->matricula = $fieldsActa['matricula'];
        $acta->cantidad  = $fieldsActa['cantidad'];
        $acta->acta = $fieldsActa['acta'];
        $acta->pago = isset($request->pago) ? 1 : 0;
        $acta->redondeoAf    = $request->redondeoAf;
        $acta->redondeoCar   = $request->redondeoCar;
        $acta->cantidadCar   = $request->cantidadCar;
        $acta->cantidadBruce = $request->cantidadBruce;
        $acta->vacunoBruce   = isset($request->vacunoBruce) ? 1 : 0;
        $acta->vacunoCar     = isset($request->vacunoCar) ? 1 : 0;
        
        $admAf        = $campaignData->admA * $acta->cantidad;
        $vacunadorAf  = $campaignData->vacunadorAf * $acta->cantidad;
        $vacunaAf    = $campaignData->vacunaAf * $acta->cantidad;
        $admCar       = $campaignData->admCar * $acta->cantidad;
        $vacunadorCar = $campaignData->vacunadorCar * $acta->cantidad;
        $vacunaCar    = $campaignData->vacunaCar * $acta->cantidad;
        
        $acta->admAf       = $admAf;
        $acta->vacunadorAf = $vacunadorAf;
        $acta->vacunaAf   = $vacunaAf;
        $acta->admCar      = $admCar;
        $acta->vacunadorCar = $vacunadorCar;
        $acta->vacunaCar   = $vacunaCar;

        $acta->save();

        $animals = Animals::where(['renspa'=>$renspa,'campaign'=>$campaign])->first();
        $animals->vacas    = $request->vacas;
        $animals->toros    = $request->toros;
        $animals->toritos  = $request->toritos;
        $animals->novillos = $request->novillos;
        $animals->novillitos  = $request->novillitos;
        $animals->vaquillonas = $request->vaquillonas;
        $animals->terneras  = $request->terneras;
        $animals->terneros  = $request->terneros;
        $animals->bufaloMay = $request->bufMay;
        $animals->bufaloMen = $request->bufMen;
        $animals->caprinos  = $request->caprinos;
        $animals->ovinos    = $request->ovinos;
        $animals->porcinos  = $request->porcinos;
        $animals->equinos   = $request->equinos;

        $animals->save();

        return redirect('aftosa/acta/'.$renspaUrl)->with('updated','ok');
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
