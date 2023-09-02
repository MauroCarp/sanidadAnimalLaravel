@extends('adminlte::page')

@section('title', 'Status Sanitaro')

@php
$brucelosis = $dataEstablecimiento->brucelosis;    
$tuberculosis = $dataEstablecimiento->tuberculosis;    
@endphp

@section('content')

    <div class="box pt-3">

        <div class="box-header with-border mb-2">

            <h5><b>Status Sanitario</b></h5>

            <div class="row border-top border-bottom py-2" style="font-size:1.2em">

                <div class="col-md-2 pl-3">
  
                    <strong><i class="fa fa-barcode margin-r-5"></i> R.E.N.S.P.A:</strong>
                    <p class="text-muted" id="renspaProductor" style="font-size: 1em;">{{$dataEstablecimiento->renspa}}</p>
                                            
                </div>

                <div class="col-md-3 border-left pl-3">
  
                    <strong><i class="fa fa-home margin-r-5"></i> Establecimiento:</strong>
                    <p class="text-muted" style="font-size: 1em;">{{$dataEstablecimiento->establecimiento}}</p>
                                            
                </div>

                <div class="col-md-2 border-left pl-3">
  
                    <strong><i class="icon-tractor margin-r-5"></i> Productor:</strong>
                    <p class="text-muted" style="font-size: 1em;">{{$dataEstablecimiento->propietario}}</p>
                                            
                </div>

                <div class="col-md-2 border-left pl-3">
  
                    <strong><i class="icon-jeringa margin-r-5" style="font-size:.7em"></i> Veterinario:</strong>
                    <p class="text-muted" style="font-size: 1em;">{{$dataEstablecimiento->toArray()['veterinario_info']['nombre']}}</p>
                                            
                </div>

                <div class="col-md-3 border-left pl-3">
  
                    <strong><i class="icon-corral margin-r-5"></i> Tipo Explotaci&oacute;n:</strong>
                    <p class="text-muted" id="renspaProductor" style="font-size: 1em;">{{$dataEstablecimiento->explotacion}}</p>
                                            
                </div>

            </div>

        </div>

        <div class="box-body p-3 bg-white" style="border-radius:3px">
            
            <div class="row">
                {{-- BRUCELOSIS --}}

                <div class="col-md-5 border-right">

                    <h3 class="box-title"><b>Brucelosis</b></h3>
                                
                    <strong>Fecha de Vencimiento</strong>

                    <p class="text-muted" id="fechaVencimientoBrucelosis" style="font-size: 1em;">{{ $brucelosis->fechaEstado->addDays(365)->format('d-m-Y')}}</p>

                    <hr>
                    
                    <strong>Animales</strong>

                    <p class="text-muted" style="font-size: 1em;">
                        <b>Vacas: </b><span id="vacasBruce">{{$brucelosis->vacas}}&nbsp;</span>  
                        <b> Vaquillonas: </b><span id="vaquillonasBruce">{{$brucelosis->vaquillonas}}&nbsp;</span>
                        <b> Toros: </b><span id="torosBruce">{{$brucelosis->toros}}</span> <br>
                        <b> Total: </b><span class="totalBrucelosis"></span>
                    </p>

                    <hr>
                    
                    <strong>Protocolo</strong>

                    <p class="text-muted" id="protocoloBrucelosis" style="font-size: 1em;">{{$brucelosis->protocolo}}</p>

                    <hr>
                    
                    <strong>Estado</strong>

                    <p class="text-muted" id="estadoBrucelosis" style="font-size: 1em;">{{$brucelosis->estado}}</p>

                    <hr>

                    @if($brucelosis->estado == 'DOES Total' || $brucelosis->estado == 'MuVe')                
                        <strong>Estado SENASA</strong>

                        <p class="text-muted" id="estadoSenasaBrucelosis" style="font-size: 1em;">{{$brucelosis->estadoSenasa}}</p>

                        <hr>
                    @endif
               
                    <div id="inputCertificadoBrucelosis" @if(($brucelosis->estado == 'DOES Total' || $brucelosis->estado == 'MuVe') && $brucelosis->estadoSenasa == 'Enviado') style="display:block" @else style="display:none" @endif>

                        <strong>N° Certificado</strong>

                        <form action="{{route('brutur.asignarCertificado')}}" method="post" id="formCertBrucelosis">
                            @csrf
                            <div class="row">

                                <div class="col-md-8">

                                    <div class="input-group mb-3">          

                                        <input type="text" name="certificado" id="certificadoBrucelosisInput" class="form-control" required>
                                        
                                        <input type="hidden" name="type" value="brucelosis">
                                        <input type="hidden" name="renspa" value="{{$dataEstablecimiento->renspa}}">
                                        
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-primary aprobarSenasa" data-type="Brucelosis"><b>Aprobar</b></button>
                                        </div>
            
                                    </div>
                                    
                                </div>
                                
                            </div>

                        </form>

                        <hr>
                    
                    </div>

                    <div id="certificadoBrucelosis" @if($brucelosis->certificado == '' || $brucelosis->estadoSenasa != 'Aprobado') style="display:none;" @endif>


                        <strong>N° Certificado</strong>

                        <p class="text-muted" id="certificadoBrucelosis" style="font-size: 1em;">{{$brucelosis->certificado}}</p>

                        <hr>
                        
                        
                    </div>

                    <strong>Fecha de Muestra</strong>

                    <p class="text-muted" id="fechaEstadoBrucelosis" style="font-size: 1em;">{{$brucelosis->fechaEstado->format('d-m-Y')}}</p>

                    <hr>

                    <strong>Fecha de Carga</strong>

                    <p class="text-muted" id="fechaCargaBrucelosis" style="font-size: 1em;">{{$brucelosis->updated_at->format('d-m-Y')}}</p>

                    <hr>
                                
                </div>

                {{-- TUBERCULOSIS --}}

                <div class="col-md-7">

                    <h3 class="box-title"><b>Tuberculosis</b></h3>
                            
                    <strong>Fecha de Vencimiento</strong>
                    <p class="text-muted" id="fechaVencimientoTuberculosis" style="font-size: 1em;">@if($tuberculosis->fechaEstado != null){{$tuberculosis->fechaEstado->addDays(365)->format('d-m-Y')}}@endif</p>

                    <hr>
                    
                    <strong>Animales</strong>
                    
                    <p class="text-muted" style="font-size: 1em;">

                        <b>Vacas: </b><span id="vacasTuber">{{$tuberculosis->vacas}}</span>&nbsp;
                        <b>Vaquillonas: </b><span id="vaquillonasTuber">{{$tuberculosis->vaquillonas}}</span>&nbsp;
                        <b>Terneros: </b><span id="ternerosTuber">{{$tuberculosis->terneros}}</span>&nbsp;
                        <b>Terneras: </b><span id="ternerasTuber">{{$tuberculosis->terneras}}</span>&nbsp;
                        <b>Novillos: </b><span id="novillosTuber">{{$tuberculosis->novillos}}</span>&nbsp;
                        <b>Novillitos: </b><span id="novillitosTuber">{{$tuberculosis->novillitos}}</span>&nbsp;
                        <b>Toros: </b><span id="torosTuber">{{$tuberculosis->toros}}</span><br>  
                        <b>Total: </b><span class="totalTuberculosis">1</span>
                        
                    </p>

                    <hr>
                    
                    <strong>Protocolo</strong>

                    <p class="text-muted" id="protocoloTuberculosis" style="font-size: 1em;">{{$tuberculosis->protocolo}}</p>

                    <hr>
                    
                    <strong>Estado</strong>

                    <p class="text-muted" id="estadoTuberculosis" style="font-size: 1em;">{{$tuberculosis->estado}}</p>

                    <hr>
                    
                    @if($tuberculosis->estado == 'Libre' || $tuberculosis->estado == 'Recertificación')       
                        <strong>Estado SENASA</strong>

                        <p class="text-muted" id="estadoSenasaTuberculosis" style="font-size: 1em;">{{$tuberculosis->estadoSenasa}}</p>

                        <hr>
                    @endif

                    <div id="inputCertificadoTuberculosis" @if(($tuberculosis->estado == 'Libre' || $tuberculosis->estado == 'Recertificación') && $tuberculosis->estadoSenasa == 'Enviado') style="display:block" @else style="display:none" @endif>

                        <strong>N° Certificado</strong>

                        <form style="all:unset" action="{{route('brutur.asignarCertificado')}}" method="post" id="formCertTuberculosis">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="input-group mb-3">          

                                        <input type="text" name="certificado" id="certificadoTuberculosisInput" class="form-control" required>
                                        
                                        <input type="hidden" name="type" value="tuberculosis">
                                        <input type="hidden" name="renspa" value="{{$dataEstablecimiento->renspa}}">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-primary aprobarSenasa" data-type="Tuberculosis"><b>Aprobar</b></button>
                                        </div>

                                        
                                    </div>
                                    
                                </div>

                            </div>
                                
                        </form>

                        <hr>
                    
                    </div>

                    <div id="certificadoTuberculosis" @if($tuberculosis->certificado == '' || $tuberculosis->estadoSenasa != 'Aprobado') style="display:none;" @endif>


                        <strong>N° Certificado</strong>

                        <p class="text-muted" id="certificadoTuberculosis" style="font-size: 1em;">{{$tuberculosis->certificado}}</p>

                        <hr>
                        
                        
                    </div>

                    <strong>Fecha de Muestra</strong>

                    <p class="text-muted" id="fechaEstadoTuberculosis" style="font-size: 1em;">{{$tuberculosis->fechaEstado->format('d-m-Y')}}</p>

                    <hr>

                    <strong>Fecha de Carga</strong>

                    <p class="text-muted" id="fechaCargaTuberculosis" style="font-size: 1em;">{{$tuberculosis->updated_at->format('d-m-Y')}}</p>

                    <hr>
                    
                </div>
                
            </div>

            <div class="row">

                <div class="col-md-5">

                    <button class="btn btn-secondary btnHistorial" data-toggle="modal" data-target="#modalHistorial" data-type="Brucelosis" ><b>Historial de Registros Brucelosis</b></button>

                </div>

                <div class="col-md-6">

                    <button href="#" class="btn btn-secondary btnHistorial" data-toggle="modal" data-target="#modalHistorial" data-type="Tuberculosis"><b>Historial de Registros Tuberculosis</b></button>

                </div>

            </div>

            <br>

            <div class="row">

                <div class="col-md-12">

                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalStatusSanitario">Actualizar Status</button>

                </div>

            </div>
        </div>

    </div>

@endsection

@include('modals/brutur/records')
@include('modals/brutur/updateStatus')

@section('js')
    
    <script>

        // RECORDS
        $('.btnHistorial').on('click',function(){

            let type = $(this).attr('data-type')
            
            if(type == 'Brucelosis'){
                $('#brucelosisRecords').show()
                $('#tuberculosisRecords').hide()    
            }else{
                $('#brucelosisRecords').hide()
                $('#tuberculosisRecords').show()
            }

            $('#titleCampaign').html(type)

        })

        $('.btnEliminarRegistro').on('click',function(){

            let id = $(this).attr('data-destroy')

            let renspa = $('#renspaProductor').text().replace('/','-')

            Swal.fire({
                    title: 'Eliminar Registro?',
                    text: "Si no estas seguro, puedes cancerlar esta accion!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar',
                    }).then((result) => {
    
                        if (result.value) {
                            console.log(id)
                            $('.formEliminarRegistro').attr('action',`/brutur/updateStatus/record/${id}`)
                            $('.formEliminarRegistro input[name="renspaRegistro"]').val(renspa)

                            $('.formEliminarRegistro').submit()

                        }
    
                    })
        })

        // COUNT ANIMALS
        const sumAnimalsInputs = (type)=>{

            let total = 0

            $(`.animales${type}`).each((i,e)=>total += parseFloat(e.value))

            return total

        }

        let totalBrucelosis = sumAnimalsInputs('Brucelosis')
        
        $('.totalBrucelosis').each((i,e)=>(e.localName == 'input') ? e.value = totalBrucelosis : e.innerText = totalBrucelosis)

        let totalTuberculosis = sumAnimalsInputs('Tuberculosis')

        console.log(totalTuberculosis)

        $('.totalTuberculosis').each((i,e)=>(e.localName == 'input') ? e.value = totalTuberculosis : e.innerText = totalTuberculosis)
        
        $('.animalesBrucelosis').on('change',()=>$('#totalBrucelosis').val(sumAnimalsInputs('Brucelosis')))

        $('.animalesTuberculosis').on('change',()=>$('#totalTuberculosis').val(sumAnimalsInputs('Tuberculosis')))

        $('#estadoTuberculosis').on('change',(e)=>(e.target.value == 'En Saneamiento') ? $('#saneamientoInfoTuberculosis').show() : $('#saneamientoInfoTuberculosis').hide())


        // APROBAR CERTIFICADO SENASA
        $('.aprobarSenasa').on('click',function(e){

            e.preventDefault()

            let type = $(this).attr('data-type')

            let certificado

            if($(`#certificado${type}Input`).val() != ''){ 

                certificado = $(`#certificado${type}Input`).val()

            }else{

                return Swal.fire(
                    'El numero de certificado no puede estar vacio',
                    '',
                    'error'
                )

            } 

            Swal.fire({
                    title: 'Desea aprobar el Estado?',
                    text: "Si no estas seguro, puedes cancerlar esta accion!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si, Aprobar',
            }).then((result) => {

                if (result.value) {
                    $(`#formCert${type}`).submit()
                }

            })

        })

    </script>
    
    @if(session('eliminarRegistro') == 'ok')
        <script>

            Swal.fire(
                'Registro eliminado',
                'Ha sido eliminado correctamente',
                'success'
            )

        </script>
    @endif
    
    @if(session('certificado') == 'ok')
        <script>

            Swal.fire(
                'Certificado asignado',
                'Ha sido asignado correctamente',
                'success'
            )

        </script>
    @endif
    
    @if(session('update') == 'ok')
        <script>

            Swal.fire(
                'Status Sanitario actualizado',
                'Ha sido actualizado correctamente',
                'success'
            ).then(()=>{

                Swal.fire({
                        title: '¿Notificar a Vacunador?',
                        text: "Si no estas seguro, puedes cancerlar esta accion!",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Notificar',
                }).then((result) => {
    
                    if (result.value) {
                        console.log('Enviar mail a veterinario')
                    }
    
                })
                
            })



        </script>
    @endif

@stop 

@section('css')
    <style>

        .modal-records{
            max-width: 80%;
        }

    </style>
@endsection