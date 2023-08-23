@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')

<div class="box pt-2">

    <div class="box-header with-border mb-3">

        <div class="input-group justify-content-between">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoUsuario">
                Nuevo Usuario
            </button>

        </div>

    </div>
    

    <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        
        <thead>
        
            <tr>

                <th>Nombre</th>

                <th>Email</th>
        
                <th>Fecha de creaci&oacute;n</th>
    
                <th>Acciones</th>

            </tr> 

        </thead>

        <tbody>

        @foreach($usuarios as $usuario)

            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->created_at }}</td>
                <td>
                    <div class="btn-group">
                        
                        <button type="button" class="btn btn-warning btnEditarUsuario" data-toggle="modal" data-target="#modalEditarUsuario" data="{{ $usuario }}"><i class="fas fa-pencil-alt"></i></button>
                        
                        <form style="all:unset" class="formEliminarUsuario" action="{{ route('users.destroy',$usuario->id) }}" method="POST">

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

@include('modals/users/newUser')
@include('modals/users/updateUser')

@section('js')
    
    @if(session('eliminar') == 'ok')
        <script>
            Swal.fire(
            'Usuario Eliminado',
            'Ha sido eliminado correctamente',
            'success'
            )
        </script>
    @endif

    @if(session('crear') == 'ok')
        <script>
            Swal.fire(
            'Usuario Creado',
            'Ha sido creado correctamente',
            'success'
            )
        </script>
    @endif

    @if(session('editar') == 'ok')
        <script>
            Swal.fire(
            'Usuario Modificado',
            'Ha sido modificado correctamente',
            'success'
            )
        </script>
    @endif

    <script>
        $('.formEliminarUsuario').each(function(){

            $(this).on('click',function(e){
    
                e.preventDefault()

                Swal.fire({
                    title: 'Eliminar Usuario?',
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


        
        $('.btnEditarUsuario').each(function(){

            $(this).on('click',function(e){

                let data = JSON.parse($(this).attr('data'))
                console.log(data)
                $('#formEditarUsuario input[name="name"]').val(data.name) 
                $('#formEditarUsuario input[name="email"]').val(data.email) 

                $('#formEditarUsuario').attr('action',`/users/${data.id}`)

            })
        })

    </script>

@endsection

@section('css')
@stop