@extends('adminlte::page')

@section('title', 'Vacunadores')

@section('content')


<div class="box pt-2">

    <div class="box-header with-border mb-3">

        <div class="input-group justify-content-between">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoVeterinario">
                Nuevo Vacunador
            </button>

            <a href="{{ route('exportarExcel') }}">
                <button class="btn btn-success" style="margin-top: 5px;">Descargar Nómina en Excel</button>
            </a>

        </div>

    </div>
    

    <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas"  id="tablaProductores"  width="100%">
        
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
                        
                        <button class="btn btn-warning btnEditarVeterinario" data-toggle="modal" data-target="#modalEditarVeterinario" idVeterinario="{{ $veterinario->id }}"><i class="fas fa-pencil-alt"></i></button>
                        
                        
                        <button class="btn btn-danger btnEliminarVeterinario" idVeterinario="{{ $veterinario->id }}"><i class="fa fa-times"></i></button>
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
{{-- @include('modals/producers/updateProducer') --}}

@section('css')
@stop