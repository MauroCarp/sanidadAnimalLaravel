@extends('adminlte::page')

@section('title', 'Cargar Acta')

@section('content')

<div class="box pt-2">

    <div class="box-body">
        
        <div class="row border-bottom">

            <div class="col-md-3">

                <div class="form-group">
                    
                    <label for="renspa"><b>R.E.N.S.P.A: </b></label>
                    
                    <input type="text" class="form-control"  style="font-size:1.2em;" name="renspaProductor" id="renspaProductor" value="{{$data['renspa']}}" readOnly>
                        
                </div>
            
            </div>

            <div class="col-md-3">

                <div class="form-group">
                    
                    <label for="propietario"><b>Propietario: </b></label>
                    
                    <input type="text" class="form-control" style="font-size:1.2em;"  id="propietario" name="propietario" value="{{$data['propietario']}}" readOnly>
                  
                </div>
              
              </div>
        
              <div class="col-md-3">
              
                <div class="form-group">
                      
                      <label for="establecimiento"><b>Establecimiento: </b></label>
                      
                      <input type="text" class="form-control" style="font-size:1.2em;"  id="establecimiento" name="establecimiento"  value="{{$data['establecimiento']}}" readOnly>
                    
                </div>
                 
              </div>
      
              <div class="col-md-3">
              
                <div class="form-group">
                      
                      <label for="veterinario"><b>Veterinario: </b></label>
                      <input type="text" class="form-control" style="font-size:1.2em;"  id="veterinario"  name="veterinario"  value="{{$data['veterinario_info']['nombre']}}" readOnly>
                    
                </div>
                 
              </div>

        </div>
       
        <form action="/aftosa/acta" method="post" id="formActa">

            @if($action == 'Modificar')
                @method('PATCH')
            @else
                <input type="hidden" name="renspa" value="{{$data['renspa']}}">
            @endif

            @csrf

            <div class="row border-bottom">

                <div class="col-md-2">
    
                    <div class="form-group">
                        
                        <label for="fechaVacunacion"><b>Fecha de Vacunaci&oacute;n</b></label>
                        <input type="date" class="form-control" name="fechaVacunacion" value="@isset($acta){{$acta['fechaVacunacion']->format('Y-m-d')}}@endisset" required>
                            
                    </div>
                
                </div>
    
                <div class="col-md-2">

                    <div class="form-group">
                        
                        <label for="fechaRecepcion"><b>Fecha Recepci&oacute;n</b></label>
                        
                        <input type="date" class="form-control" id="fechaRecepcion" name="fechaRecepcion" value="@isset($acta){{ $acta->fechaRecepcion->format('Y-m-d')}}@endisset" required>
                        
                    </div>
                    
                </div>
        
                <div class="col-md-2">
                
                    <div class="form-group">
                            
                        <label for="cantidad"><b>Vacunador</b></label>

                        <select class="form-control" name="matricula" id="matricula">

                            @foreach ($vets as $vet)
                                <option value="{{$vet->matricula}}"
                                    @isset($acta['matricula'])
                                        @if($vet->matricula == $acta['matricula']) 
                                            selected 
                                        @endif 
                                    @else
                                        @if($vet->matricula == $data['veterinario']) 
                                            selected 
                                        @endif 
                                    @endisset >{{$vet->nombre}}</option>
                            @endforeach

                        </select>
                        
                    </div>
                        
                </div>
        
                <div class="col-md-2">
                
                    <div class="form-group">
                            
                        <label for="cantidad"><b>Vacunas Suministradas</b></label>
                        
                        <input type="number" class="form-control" id="cantidad" name="cantidad" value="@isset($acta){{$acta['cantidad']}}@endisset" required>
                        
                    </div>
                    
                </div>

                <div class="col-md-2">
                
                    <div class="form-group">
                            
                        <label for="cantidad"><b>Acta</b></label>
                        
                        <input type="text" class="form-control" id="acta" name="acta" value="@isset($acta) {{ $acta['acta'] }} @endisset" required>
                        
                    </div>
                    
                </div>
        
                <div class="col-md-1">
                    
                    <div class="form-group">
                            
                        <label for="cantidad"><b>Pag&oacute;</b></label>
                        
                        <input type="checkbox" class="form-control checkbox" id="pago" name="pago" @isset($acta['pago']) @if($acta['pago']) checked @endif @endisset>
                        
                    </div>
                        
                </div>
                
                <div class="col-md-1">
                
                    <div class="form-group">
                            
                        <label for="cantidad"><b>Monto</b></label>
                        <br>
                
                        <span id="monto" style="color:#00A00F;font-size: 30px;font-weight: bold;cursor: pointer;" class="fa fa-file" data-toggle="modal" data-target="#modalMonto">
                                            
                    </div>
                    
                </div>
    
            </div>
            
            @include('modals/aftosa/amounts')

            <div class="row">
    
                <div class="col-md-1"></div>

                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="vacas"><b>Vacas</b></label>
                        
                        <input type="number" class="form-control total" name="vacas" value="{{ $data['vacas'] ?? 0}}">
                            
                    </div>
                
                </div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="toros"><b>Toros</b></label>
                        
                        <input type="number" class="form-control total" name="toros" value="{{ $data['toros'] ?? 0}}">
                            
                    </div>
                
                </div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="toritos"><b>Toritos</b></label>
                        
                        <input type="number" class="form-control parcial total" name="toritos" value="{{ $data['toritos'] ?? 0}}">
                            
                    </div>
                
                </div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="novillos"><b>Novillos</b></label>
                        
                        <input type="number" class="form-control parcial total" name="novillos" value="{{ $data['novillos'] ?? 0}}">
                            
                    </div>
                
                </div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="novillitos"><b>Novillitos</b></label>
                        
                        <input type="number" class="form-control parcial total" name="novillitos" value="{{ $data['novillitos'] ?? 0}}">
                            
                    </div>
                
                </div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="vaquillonas"><b>Vaquillonas</b></label>
                        
                        <input type="number" class="form-control parcial total" name="vaquillonas" value="{{ $data['vaquillonas'] ?? 0}}">
                            
                    </div>
                
                </div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="terneras"><b>Terneras</b></label>
                        
                        <input type="number" class="form-control parcial total" name="terneras" value="{{ $data['terneras'] ?? 0}}">
                            
                    </div>
                
                </div>

                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="terneros"><b>Terneros</b></label>
                        
                        <input type="number" class="form-control parcial total" name="terneros" value="{{ $data['terneros'] ?? 0}}">
                            
                    </div>
                
                </div>

                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="parcial"><b>Parcial</b></label>
                        
                        <input type="number" class="form-control" name="parcial" readOnly>
                            
                    </div>
                
                </div>

                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="total"><b>Total</b></label>
                        
                        <input type="number" class="form-control" name="total" readOnly>
                            
                    </div>
                
                </div>

            </div>

            <div class="row border-bottom">

                <div class="col-md-3"></div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="bufMay"><b>B&uacute;f May:</b></label>
                        
                        <input type="number" class="form-control" name="bufMay" value="{{ $data['bufMay'] ?? 0}}">
                            
                    </div>
                
                </div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="bufMen"><b>B&uacute;f Men:</b></label>
                        
                        <input type="number" class="form-control" name="bufMen" value="{{ $data['bufMen'] ?? 0}}">
                            
                    </div>
                
                </div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="caprinos"><b>Caprinos:</b></label>
                        
                        <input type="number" class="form-control" name="caprinos" value="{{ $data['caprinos'] ?? 0}}">
                            
                    </div>
                
                </div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="ovinos"><b>Ovinos:</b></label>
                        
                        <input type="number" class="form-control" name="ovinos" value="{{ $data['ovinos'] ?? 0}}">
                            
                    </div>
                
                </div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="porcinos"><b>Porcinos:</b></label>
                        
                        <input type="number" class="form-control" name="porcinos" value="{{ $data['porcinos'] ?? 0}}">
                            
                    </div>
                
                </div>
    
                <div class="col-md-1">
    
                    <div class="form-group">
                        
                        <label for="equinos"><b>Equinos:</b></label>
                        
                        <input type="number" class="form-control" name="equinos" value="{{ $data['equinos'] ?? 0}}">
                            
                    </div>
                
                </div>

            </div>

            <div class="row">

                <div class="col-md-4"></div>

                <div class="col-md-2">
                    
                    <label><b>Carbunclo</b></label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                            <div class="input-group-text">

                                <input type="checkbox" class="checkbox" name="vacunoCar" @isset($acta['vacunoCar']) @if($acta['vacunoCar']) checked @endif @endisset>

                            </div>

                        </div>

                        <input type="number" class="form-control" name="cantidadCar" value="{{ $acta['cantidadCar'] ?? 0}}" required>

                    </div>

                </div>
       
                <div class="col-md-2">

                    <label><b>Brucelosis</b></label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                            <div class="input-group-text">

                                <input type="checkbox" class="checkbox" name="vacunoBruce" @isset($acta['vacunoBruce']) @if($acta['vacunoBruce']) checked @endif @endisset>

                            </div>

                        </div>

                        <input type="number" class="form-control" name="cantidadBruce" value="{{ $acta['cantidadBruce'] ?? 0}}" required>

                    </div>

                </div>

                <div class="col-md-3"></div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 border-top border-bottom border-primary py-2"><button class="btn btn-primary btn-block" id="btnCargarActa" type="submit">{{$action}} Acta</button></div>
                <div class="col-md-4"></div>
            </div>
        </form>

    </div>

</div>
    

@endsection


@section('js')

    @if($action == 'Modificar')

        <script>

            let renspa = $('#renspaProductor').val().replace('/','-')
        
            $('#formActa').attr('action',`/aftosa/acta/${renspa}`)

        </script>

        @if(session('updated') == 'ok')

            <script>

                Swal.fire(
                    'Acta Modificada',
                    'Ha sido modificada correctamente',
                    'success'
                )

            </script>

        @else

            <script>

                Swal.fire(
                    'Modificar Acta',
                    'El acta asociada a este RENSPA, ya se encuentra cargada.',
                    'info'
                )

            </script>

        @endif

    @endif

    <script>
        let total = 0
        let parcial = 0
        $('.total').each(function(){total += parseFloat($(this).val())});
        $('.parcial').each(function(){parcial += parseFloat($(this).val())});

        $('input[name="total"]').val(total)
        $('input[name="parcial"]').val(parcial)
        
        $('.parcial').on('change',function(){
            let total = 0
            let parcial = 0

            $('.total').each(function(){total += parseFloat($(this).val())});
            $('.parcial').each(function(){parcial += parseFloat($(this).val())});
            $('input[name="total"]').val(total)
            $('input[name="parcial"]').val(parcial)
            
        })
        
        $('.total').on('change',function(){
            let total = 0
            $('.total').each(function(){total += parseFloat($(this).val())});
            $('input[name="total"]').val(total)

        })

        </script>
    

{{--

    @if ($errors->any())


        <script>
            let formClass,errorDivId;
        </script>

        @if(old('formType') == 'newVet')

            <script>

                $('#modalNuevoVeterinario').modal('show')
                formClass = 'formNuevoVeterinario'
            </script>

        @elseif(old('formType') == 'updateVet')

            <script>

                $('#modalEditarVeterinario').modal('show')
                $('#formEditarVeterinario').attr('action',`/veterinaries/{{ old('id')}}`)
                formClass = 'formEditarVeterinario'

            </script>

        @endif

        @foreach ($errors->messages() as $key => $fieldErrors)

            <script>

                errorDivId = `.errors#error{{ ucwords($key) }}`

                $(`.${formClass}`).find(errorDivId).html('{{ $fieldErrors[0] }}')

            </script>

        @endforeach


    @endif
--}}
    @if(session('eliminar') == 'ok')
        <script>
            Swal.fire(
            'Vacunador Eliminado',
            'Ha sido eliminado correctamente',
            'success'
            )
        </script>
    @endif

@endsection