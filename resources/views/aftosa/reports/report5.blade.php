@extends('aftosa/reports/layout',[
    'title'=>'Relación Dosis entregadas y Vacuna Aplicada'
])

@section('content')

    <table align="center" class="table-sm" style="width:100%">
        <tr style="color:blue">
            <td colspan="4"></td>
            <td colspan="3" style="text-align:center" class="border-bottom border-primary">Totales</td>
        </tr>
        <thead class="border-bottom border-primary">
            <th>Vacunador</th>
            <th>Matricula</th>
            <th>Entrega</th>
            <th>Dosis</th>
            <th>Entregadas</th>
            <th>Aplicadas</th>
            <th>Sin Aplicar</th>
        </thead>

        <tbody>

            @foreach ($entregas as $entregaVet)

                @foreach ($entregaVet['entregas'] as $entrega)
                    @if($loop->first)
                        
                        <tr style="line-height:1em" class="border-top">

                            <td>{{ $entrega['veterinario']['nombre'] }}</td>    
                            <td>{{ $entrega['veterinario']['matricula'] }}</td>    
                            <td>{{ date('d-m-Y', strtotime($entrega['fechaEntrega'])) }}</td>    
                            <td>{{ $entrega['cantidad'] }}</td>    
                            <td colspan="3"></td>    

                        </tr>

                    @else

                        <tr style="line-height:1em">

                            <td colspan="2"></td>    
                            <td>{{ date('d-m-Y', strtotime($entrega['fechaEntrega'])) }}</td>    
                            <td>{{ $entrega['cantidad'] }}</td>    

                        </tr>

                    @endif

                    @if($loop->last)

                        <tr style="line-height:1em;">

                            <td colspan="4"></td>    
                            <td style="font-weight:bold">{{ $entregaVet['totalDosis'] }}</td>    
                            <td style="font-weight:bold">{{ $entregaVet['aplicadas'] }}</td>    
                            <td style="font-weight:bold">{{ $entregaVet['diff'] }}</td>    

                        </tr>
                        
                    @endif

                @endforeach
                
            @endforeach

            <tr style="font-weight:bold;color:blue" class="border-top border-primary">
                <td colspan="2"></td>
                <td colspan="2" style="text-align:right">Datos finales de la relacion:</td>
                <td>{{ $totalDosis }}</td>
                <td>{{ $totalAplicadas }}</td>
                <td>{{ $totalDiff }}</td>
            </tr>
      
        </tbody>

    </table>

@endsection