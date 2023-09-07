@extends('adminlte::page')

@section('title', 'Backups')

@section('content')

<div class="box pt-2" style="width:50%">

    <div class="box-header with-border mb-3">

        <div class="input-group justify-content-between">

            <form action="/backups" method="post">

                @csrf
                <button class="btn btn-primary" type="submit">
                    Nuevo Backup
                </button>

            </form>

        </div>

    </div>
    

    <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas">
        
        <thead>
        
            <tr>

                <th>Estado</th>

                <th>Creado</th>
        
                <th></th>
    
            </tr> 

        </thead>

        <tbody>

        @foreach($backups as $backup)

            <tr>
                <td style="text-align:center"><span @if($backup->status == 'Done') class="p-2 badge-success" @else class="p-2 badge-warning" @endif>{{ $backup->status }}</span></td>
                <td>{{ $backup->created_at->format('d-m-Y H:m:i') }}</td>
                <td>
                    <div class="btn-group">
                                                
                        <form style="all:unset" class="formEliminarBackup" action="/backups/{{$backup->id}}" method="POST">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="fa fa-times"></i></button>
                            
                        </form>
                        
                        <a href="{{asset($backup->url)}}" class="btn btn-warning"><span class="fa fa-download"></span></a>
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
            'Backup Eliminado',
            'Ha sido eliminado correctamente',
            'success'
            )
        </script>
    @endif

    @if(session('backup') == 'ok')
        <script>
            Swal.fire(
            'Procesando',
            'El backup se esta procesando',
            'success'
            )
        </script>
    @endif

    <script>
        $('.formEliminarBackup').each(function(){

            $(this).on('click',function(e){
    
                e.preventDefault()

                Swal.fire({
                    title: 'Eliminar Backup?',
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

    </script>

@endsection

@section('css')
@stop