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
                        
                        <button class="btn btn-warning btnEditarUsuario" data-toggle="modal" data-target="#modalEditarUsuario" idUsuario="{{ $usuario->id }}"><i class="fas fa-pencil-alt"></i></button>
                        
                        <button class="btn btn-danger btnEliminarUsuario" idUsuario="{{ $usuario->id }}"><i class="fa fa-times"></i></button>

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
{{-- @include('modals/producers/updateProducer') --}}

@section('css')
@stop