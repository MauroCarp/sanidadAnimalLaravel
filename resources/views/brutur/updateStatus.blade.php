@extends('adminlte::page')

@section('title', 'Status Sanitaro')


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

                    <p class="text-muted" id="fechaVencimientoBrucelosis" style="font-size: 1em;">@if($dataEstablecimiento->brucelosis->fechaEnviado != null){{ $dataEstablecimiento->brucelosis->fechaEnviado->addDays(365)->format('d-m-Y')}}@endif</p>

                    <hr>
                    
                    <strong>Animales</strong>
                    
                    <p class="text-muted" style="font-size: 1em;">
                    <b>Vacas: </b><span class="animalesBrucelosis" id="vacasBruce">{{$dataEstablecimiento->brucelosis->vacas}}&nbsp;</span>  
                    <b> Vaquillonas: </b><span class="animalesBrucelosis" id="vaquillonasBruce">{{$dataEstablecimiento->brucelosis->vaquillonas}}&nbsp;</span>
                    <b> Toros: </b><span class="animalesBrucelosis" id="torosBruce">{{$dataEstablecimiento->brucelosis->toros}}</span> <br>
                    <b> Total: </b><span id="totalBruce"></span>
                    </p>

                    <hr>
                    
                    <strong>Protocolo</strong>

                    <p class="text-muted" id="protocoloBrucelosis" style="font-size: 1em;">{{$dataEstablecimiento->brucelosis->protocolo}}</p>

                    <hr>
                    
                    <strong>Estado</strong>

                    <p class="text-muted" id="estadoBrucelosis" style="font-size: 1em;">{{$dataEstablecimiento->brucelosis->estado}}</p>

                    <hr>
                    
                                
                    <strong>Estado SENASA</strong>

                    <p class="text-muted" id="estadoSenasaBrucelosis" style="font-size: 1em;">{{$dataEstablecimiento->brucelosis->estadoSenasa}}</p>

                    <hr>

                    <div id="inputCertificadoBruce">

                        <strong>N° Certificado</strong>

                        <div class="row">

                            <div class="col-md-8">

                                <div class="input-group mb-3">          
        
                                    <input type="text" size="20" name="certificaBrucelosisisInput" id="certificadoBrucelosisInput" class="form-control">
        
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-primary aprobarSenasa" databutton="Brucelosis"><b>Aprobar</b></button>
                                    </div>
        
                                </div>

                            </div>

                        </div>

                        <hr>
                    
                    </div>

                    <div id="divEstadoBruce" style="display:none;">


                        <strong>N° Certificado</strong>

                        <p class="text-muted" id="certificadoBrucelosis" style="font-size: 1em;">{{$dataEstablecimiento->brucelosis->certificado}}</p>

                        <hr>
                        
                        
                    </div>

                    <strong>Fecha de Muestra</strong>

                    <p class="text-muted" id="fechaEstadoBrucelosis" style="font-size: 1em;">{{$dataEstablecimiento->brucelosis->fechaEstado->format('d-m-Y')}}</p>

                    <hr>

                    <strong>Fecha de Carga</strong>

                    <p class="text-muted" id="fechaCargaBrucelosis" style="font-size: 1em;">{{$dataEstablecimiento->brucelosis->fechaCarga->format('d-m-Y')}}</p>

                    <hr>
                                
                </div>

                {{-- TUBERCULOSIS --}}

                <div class="col-md-7">

                    <h3 class="box-title"><b>Tuberculosis</b></h3>
                            
                    <strong>Fecha de Vencimiento</strong>
                    <p class="text-muted" id="fechaVencimientoTuberculosis" style="font-size: 1em;">@if($dataEstablecimiento->tuberculosis->fechaEnviado != null){{$dataEstablecimiento->tuberculosis->fechaEnviado->addDays(365)->format('d-m-Y')}}@endif</p>

                    <hr>
                    
                    <strong>Animales</strong>
                    
                    <p class="text-muted" style="font-size: 1em;">

                        <b>Vacas:</b><span class="animalesTuberculosis" id="vacasTuber">{{$dataEstablecimiento->tuberculosis->vacas}}</span>&nbsp;
                        <b>Vaquillonas:</b><span class="animalesTuberculosis" id="vaquillonasTuber">{{$dataEstablecimiento->tuberculosis->vaquillonas}}</span>&nbsp;
                        <b>Terneros:</b><span class="animalesTuberculosis" id="ternerosTuber">{{$dataEstablecimiento->tuberculosis->terneros}}</span>&nbsp;
                        <b>Terneras:</b><span class="animalesTuberculosis" id="ternerasTuber">{{$dataEstablecimiento->tuberculosis->terneras}}</span>&nbsp;
                        <b>Novillos:</b><span class="animalesTuberculosis" id="novillosTuber">{{$dataEstablecimiento->tuberculosis->novillos}}</span>&nbsp;
                        <b>Novillitos:</b><span class="animalesTuberculosis" id="novillitosTuber">{{$dataEstablecimiento->tuberculosis->novillitos}}</span>&nbsp;
                        <b>Toros:</b><span class="animalesTuberculosis" id="torosTuber">{{$dataEstablecimiento->tuberculosis->toros}}</span><br>  
                        <b>Total:</b><span id="totalTuber">1</span>
                        
                    </p>

                    <hr>
                    
                    <strong>Protocolo</strong>

                    <p class="text-muted" id="protocoloTuberculosis" style="font-size: 1em;">27490</p>

                    <hr>
                    
                    <strong>Estado</strong>

                    <p class="text-muted" id="estadoTuberculosis" style="font-size: 1em;">MuVe</p>

                    <hr>
                    
                                
                    <strong>Estado SENASA</strong>

                    <p class="text-muted" id="estadoSenasaTuberculosis" style="font-size: 1em;">Enviado</p>

                    <hr>

                    <div id="inputCertificadoBruce">

                        <strong>N° Certificado</strong>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="input-group mb-3">          

                                    <input type="text" name="certificaTuberculosisisInput" id="certificadoTuberculosisInput" class="form-control">
        
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-primary aprobarSenasa" databutton="Tuberculosis"><b>Aprobar</b></button>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <hr>
                    
                    </div>

                    <div id="divEstadoBruce" style="display:none;">


                        <strong>N° Certificado</strong>

                        <p class="text-muted" id="certificadoTuberculosis" style="font-size: 1em;">
                        </p>

                        <hr>
                        
                        
                    </div>

                    <strong>Fecha de Muestra</strong>

                    <p class="text-muted" id="fechaEstadoTuberculosis" style="font-size: 1em;">14/03/2023</p>

                    <hr>

                    <strong>Fecha de Carga</strong>

                    <p class="text-muted" id="fechaCargaTuberculosis" style="font-size: 1em;">07/06/2023</p>

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

                    <button class="btn btn-primary btn-block">Actualizar Status</button>

                </div>

            </div>
        </div>

    </div>

@endsection

@include('modals/brutur/records')

@section('js')
    
    <script>

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
                            $('.formEliminarRegistro').attr('action',`/brutur/updateStatus/${id}`)
                            $('.formEliminarRegistro input[name="renspaRegistro"]').val(renspa)

                            $('.formEliminarRegistro').submit()

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

@stop 

@section('css')
    <style>

        .modal-records{
            max-width: 80%;
        }

    </style>
@endsection