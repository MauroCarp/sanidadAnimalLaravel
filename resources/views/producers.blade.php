@extends('adminlte::page')

@section('title', 'Productores')


@section('content')

    <div class="box pt-3">

        <div class="box-header with-border mb-2">

            <button class="btn btn-primary" id="btnNuevoProductor" data-toggle="modal" data-target="#modalNuevoProductor">
            
            Nuevo Productor / Establecimiento

            </button>

        </div>

        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            
            <thead>
            
                <tr>

                    <th>R.E.N.S.P.A</th>

                    <th>Propietario</th>

                    <th>Establecimiento</th>

                    <th>Tipo Expl.</th>

                    <th>Regimen</th>

                    <th>Distrito</th>

                    <th>Acciones</th>

                </tr> 

            </thead>

            <tbody>

            @foreach($productores as $productor)
                <tr>
                    <td>{{ $productor->renspa }}</td>
                    <td>{{ $productor->propietario }}</td>
                    <td>{{ $productor->establecimiento }}</td>
                    <td>{{ html_entity_decode($productor->explotacion) }}</td>
                    <td>{{ $productor->regimen }}</td>
                    <td>{{ $productor->distrito->name }}</td>
                    <td>
                        <div class="btn-group">
                            
                            <button class="btn btn-warning btnEditarProductor" data-toggle="modal" data-target="#modalEditarProductor" data="{{ $productor }}"><i class="fas fa-pencil-alt"></i></button>
                            
                            <form style="all:unset" class="formEliminarProductor" action="{{ route('producers.destroy',$productor->id) }}" method="POST">

                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><i class="fa fa-times"></i></button>
    
                            </form>                            
                        </div>  
                    </td>
                </tr>
            @endforeach

            </tbody>

            </table>

        </div>

    </div>

@endsection

@include('modals/producers/newProducer')
@include('modals/producers/updateProducer')

@section('js')

    @if(session('eliminar') == 'ok')
        <script>
            Swal.fire(
            'Productor Eliminado',
            'Ha sido eliminado correctamente',
            'success'
            )
        </script>
    @endif

    @if(session('crear') == 'ok')
        <script>
            Swal.fire(
            'Productor Creado',
            'Ha sido creado correctamente',
            'success'
            )
        </script>
    @endif

    @if(session('editar') == 'ok')
        <script>
            Swal.fire(
            'Productor Modificado',
            'Ha sido modificado correctamente',
            'success'
            )
        </script>
    @endif


    @if ($errors->has('renspa'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("email")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('propietario'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("email")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('establecimiento'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("email")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('explotacion'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("explotacion")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('regimen'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("regimen")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('tipoDoc'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("tipoDoc")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('numDoc'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("numDoc")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('iva'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("iva")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('telefono'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("telefono")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('email'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("email")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('domicilio'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("domicilio")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('localidad'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("localidad")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('provincia'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("provincia")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('departamento'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("departamento")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('distrito_id'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("distrito_id")) }} ',
            'error'
            )
        </script>
        
    @endif
    @if ($errors->has('veterinario'))

        <script>
            Swal.fire(
            'Error de Validación',
            ' {{ __($errors->first("veterinario")) }} ',
            'error'
            )
        </script>
        
    @endif

    
    <script>

        $('.formEliminarProductor').each(function(){
    
            $(this).on('click',function(e){
    
                e.preventDefault()
    
                Swal.fire({
                    title: 'Eliminar Productor?',
                    text: "Al eliminar el productor, se eliminaran toda su informacion asociada (Bru-Tur, Actas, Existencia Animal)",
                    showCancelButton: true,
                    type:'error',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar',
                    }).then((result) => {
    
                        if (result.value) {
                            $(this).submit()
                        }
    
                    })
    
            })
    
        })

          
        $('.btnEditarProductor').each(function(){

            $(this).on('click',function(e){

                let data = JSON.parse($(this).attr('data'))
                console.log(data)
                $('#formEditarProductor input[name="renspa"]').val(data.renspa) 
                $('#formEditarProductor input[name="propietario"]').val(data.propietario) 
                $('#formEditarProductor input[name="establecimiento"]').val(data.establecimiento) 

                let explotacion = data.explotacion

                switch (encodeURIComponent(data.explotacion)) {

                    case 'Invernada':
                        explotacion = 'Cria/Invernada'
                        break;
                    
                    case 'Cr%C3%83%C2%ADa%2FInvernada':
                        explotacion = 'Cria/Invernada'
                        break;
                
                    case 'Cr%C3%83%C2%ADa%20':
                        explotacion = 'Cria'
                        break;
                
                    default:
                        break;
                }
                
                $('#formEditarProductor #explotacion').val(explotacion) 
                $('#formEditarProductor #regimen').val(data.regimen) 
                $('#formEditarProductor #tipoDoc').val(data.tipoDoc) 
                $('#formEditarProductor input[name="numDoc"]').val(data.numDoc) 
                $('#formEditarProductor #iva').val(data.iva) 
                $('#formEditarProductor input[name="telefono"]').val(data.telefono) 
                $('#formEditarProductor input[name="email"]').val(data.email) 
                $('#formEditarProductor input[name="domicilio"]').val(data.domicilio) 
                $('#formEditarProductor input[name="localidad"]').val(data.localidad) 
                $('#formEditarProductor input[name="provincia"]').val(data.provincia) 
                $('#formEditarProductor input[name="departamento"]').val('{{ $departamento }}')
                $('#formEditarProductor #distrito_id').val(data.distrito.key) 
                $('#formEditarProductor #veterinario').val(data.veterinario) 

                $('#formEditarProductor').attr('action',`/producers/${data.id}`)

            })

        })

    </script>

@stop

@section('css')
    <style>
        .modal-lg{
            max-width: 80%!important;
        }

    </style>

@stop