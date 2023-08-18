@extends('adminlte::page')

@section('title', 'Vacunadores')

@section('content')


<div class="box pt-2">

    <div class="box-header with-border mb-3">

        <div class="input-group justify-content-between">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoVeterinario">
                Nuevo Vacunador
            </button>

            <a href="{{ route('veterinaries.export') }}">
                <button class="btn btn-success" style="margin-top: 5px;">Descargar Nómina en Excel</button>
            </a>

        </div>

    </div>
    

    <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas"  width="100%">
        
        <thead>
        
            <tr>

                <th>Nombre</th>

                <th>Matricula</th>
    
                <th>Domicilio</th>
    
                <th>Telefono</th>
    
                <th>E-Mail</th>
    
                <th>Tipo</th>
    
                <th>Acciones</th>

            </tr> 

        </thead>

        <tbody>

        @foreach($veterinarios as $veterinario)
            <tr>
                <td>{{ $veterinario->nombre }}</td>
                <td>{{ $veterinario->matricula }}</td>
                <td>{{ $veterinario->domicilio }}</td>
                <td>{{ $veterinario->telefono }}</td>
                <td>{{ $veterinario->email }}</td>
                <td>{{ $veterinario->tipo }}</td>
                <td>
                     
                    <div class="btn-group">
   
                        <button type="button" class="btn btn-warning btnEditarVeterinario" data-toggle="modal" data-target="#modalEditarVeterinario" data="{{ $veterinario }}"><i class="fas fa-pencil-alt"></i></button>
                        
                        <form style="all:unset" class="formEliminarVeterinario" action="{{ route('veterinaries.destroy',$veterinario->id) }}" method="POST">

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

@include('modals/veterinaries/newVeterinary')
@include('modals/veterinaries/updateVeterinary')

@section('css')
@stop

@section('js')
    
    @if(session('eliminar') == 'ok')
        <script>
            Swal.fire(
            'Vacunador Eliminado',
            'Ha sido eliminado correctamente',
            'success'
            )
        </script>
    @endif

    @if(session('crear') == 'ok')
        <script>
            Swal.fire(
            'Vacunador Creado',
            'Ha sido creado correctamente',
            'success'
            )
        </script>
    @endif

    @if(session('editar') == 'ok')
        <script>
            Swal.fire(
            'Vacunador Modificado',
            'Ha sido modificado correctamente',
            'success'
            )
        </script>
    @endif

    <script>
        $('.formEliminarVeterinario').each(function(){

            $(this).on('click',function(e){
    
                e.preventDefault()

                Swal.fire({
                    title: 'Eliminar Vacunador?',
                    text: "Si no estas seguro, puedes cancerlar esta accion!",
                    showCancelButton: true,
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


        
        $('.btnEditarVeterinario').each(function(){

            $(this).on('click',function(e){

                let data = JSON.parse($(this).attr('data'))

                $('#formEditarVeterinario input[name="nombre"]').val(data.nombre) 
                $('#formEditarVeterinario input[name="matricula"]').val(data.matricula) 
                $('#formEditarVeterinario input[name="domicilio"]').val(data.domicilio) 
                $('#formEditarVeterinario input[name="telefono"]').val(data.telefono) 
                $('#formEditarVeterinario input[name="email"]').val(data.email) 
                $('#formEditarVeterinario input[name="cuit"]').val(data.cuit) 
                $('#formEditarVeterinario input[name="tipo"]').val(data.tipo) 

                $('#formEditarVeterinario').attr('action',`/veterinaries/${data.id}`)

            })
        })

    </script>

@endsection