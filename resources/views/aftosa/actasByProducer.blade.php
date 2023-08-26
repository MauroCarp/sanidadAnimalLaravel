@extends('adminlte::page')

@section('title', 'Actas por Productor')

@section('content')

    <div class="box pt-3">

        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            
            <thead>
            
                <tr>

                    <th>Fecha Vacunaci&oacute;n</th>
                    
                    <th>Fecha Recepci&oacute;n</th>

                    <th>Vacunador</th>
                    
                    <th>Vacunas Suministradas</th>
                    
                    <th>Acta</th>
                    
                    <th>Pag&oacute;</th>

                </tr> 

            </thead>

            <tbody>


                @foreach($actas as $acta)

                <tr>
                    <td>{{ $acta->fechaVacunacion->format('d-m-Y') }}</td>
                    <td>{{ $acta->fechaRecepcion->format('d-m-Y') }}</td>
                    <td>{{ optional($acta->veterinario)->nombre ?? 'La matricula de este veterinario no se encuentra en nuestra base de datos'}}</td>
                    <td>{{ $acta->cantidad }}</td>
                    <td>{{ $acta->acta }}</td>                   
                    <td>

                        <div class='btn-group'>

                            @if($acta->pago)
                                <span class='btn btn-success'><i class='fas fa-check'></i></span>
                            @else
                                <span class='btn btn-danger'><i class='fas fa-times'></i></span>
                            @endif

                        </div>

                    </td>                   

                </tr>

                @endforeach

            </tbody>

            </table>

        </div>

    </div>
    
@endsection

