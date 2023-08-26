@extends('adminlte::page')

@section('title', 'Est. No Vacunados')


@section('content')

    <div class="box pt-3">

        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            
            <thead>
            
                <tr>

                    <th>Propietario</th>
                    
                    <th>R.E.N.S.P.A</th>

                    <th>Establecimiento</th>
                    
                    <th>Departamento</th>
                    
                    <th>Distrito</th>
                    
                    <th>Explotaci&oacute;n</th>

                </tr> 

            </thead>

            <tbody>

            @foreach($noVacunados as $registro)

                <tr>
                    <td>{{ $registro->propietario }}</td>
                    <td>{{ $registro->renspa }}</td>
                    <td>{{ $registro->establecimiento }}</td>
                    <td>{{ $departamento }}</td>
                    <td>{{ $registro->name }}</td>
                    <td>{{ html_entity_decode($registro->explotacion) }}</td>
                   
                </tr>
            @endforeach

            </tbody>

            </table>

        </div>

    </div>

@endsection
