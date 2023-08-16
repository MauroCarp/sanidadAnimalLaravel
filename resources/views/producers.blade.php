@extends('adminlte::page')

@section('title', 'Productores')

@section('content_header')

    <h4>Productores / Establecimientos</h4>

@stop

@section('content')

<div class="container-fluid">

    <div class="box">

        <div class="box-header with-border mb-2">

            <button class="btn btn-primary" id="btnNuevoProductor" data-toggle="modal" data-target="#modalAgregarProductor">
            
            Nuevo Productor/Establecimiento

            </button>

        </div>

        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas"  id="tablaProductores"  width="100%">
            
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
                          
                            <button class="btn btn-warning btnEditarProductor" data-toggle="modal" data-target="#modalEditarProductor" idProductor="{{ $productor->id }}"><i class="fas fa-pencil-alt"></i></button>
                            
                            
                            <button class="btn btn-danger btnEliminarProductor" idProductor="{{ $productor->id }}"><i class="fa fa-times"></i></button>
                          </div>  
                    </td>
                </tr>
            @endforeach

            </tbody>

            </table>

        </div>

    </div>
      
</div>

@endsection

@include('modals/producers/newProducer')
@include('modals/producers/updateProducer')

@section('css')
@stop