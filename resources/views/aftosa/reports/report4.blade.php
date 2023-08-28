@extends('aftosa/reports/layout',[
    'title'=>'Entrega de Vacunas por Vacunador incluida la de Búfalos/as'
])

@section('content')

    <table align="center" class="table-sm" style="width:100%">

        <thead class="border-bottom border-primary">
            <th>Vacunador</th>
            <th>Matricula</th>
            <th>UEL</th>
            <th>Marca</th>
            <th>Fecha Entrega</th>
            <th>Dosis</th>
        </thead>

        <tbody>

            @foreach ($entregas as $entregaVet)

                @foreach ($entregaVet['entregas'] as $entrega)

                    @if($loop->first)
                        
                        <tr style="line-height:1em" class="border-top">

                            <td>{{ $entrega['veterinario']['nombre'] }}</td>    
                            <td>{{ $entrega['veterinario']['matricula'] }}</td>    
                            <td>{{ $entrega['uel'] }}</td>    
                            <td>{{ $entrega['marca'] }}</td>    
                            <td>{{ date('d-m-Y', strtotime($entrega['fechaEntrega'])) }}</td>    
                            <td>{{ $entrega['cantidad'] }}</td>    

                        </tr>

                    @else

                        <tr style="line-height:1em">

                            <td colspan="4"></td>    
                            <td>{{ date('d-m-Y', strtotime($entrega['fechaEntrega'])) }}</td>    
                            <td>{{ $entrega['cantidad'] }}</td>    

                        </tr>

                    @endif

                    @if($loop->last)

                        <tr style="line-height:1em;">

                            <td colspan="5"></td>    
                            <td class="border-top border-primary" style="font-weight:bold">{{ $entregaVet['totalDosis'] }}</td>    

                        </tr>
                        
                    @endif

                @endforeach
                
            @endforeach

            <tr style="font-weight:bold;color:blue" class="border-top border-primary">
                <td colspan="3"></td>
                <td colspan="2" style="text-align:right">Total Dosis Entregadas</td>
                <td>{{ $totalDosis }}</td>
            </tr>
      
        </tbody>

    </table>

@endsection