@extends('adminlte::page')

@section('title', 'Busqueda Diferencia')

@section('content')

    <div class="box pt-3">

        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            
            <thead>
            
                <tr>

                    <th>Propietario</th>
                    
                    <th>R.E.N.S.P.A</th>

                    <th>Total Rodeo</th>
                    
                    <th>Total Vacunado</th>
                    
                    <th>Diferencia</th>
                    
                    <th></th>

                </tr> 

            </thead>

            <tbody>


                @foreach($diferencias as $diferencia)

                <tr>
                    <td>{{ $diferencia->propietario }}</td>
                    <td>{{ $diferencia->renspa }}</td>
                    <td>{{ $diferencia->total }}</td>
                    <td>{{ $diferencia->cantidad }}</td>
                    <td>{{ $diferencia->diferencia }}</td>                   
                    <td>
                        <div class='btn-group'>

                            <button class='btn btn-warning btnModificarActa' renspa="{{ $diferencia->renspa }}"><i class='fas fa-pencil-alt'></i></button>
                        
                        </div>
                    </td>                   
                </tr>

                @endforeach

            </tbody>

            </table>

        </div>

    </div>

@endsection
