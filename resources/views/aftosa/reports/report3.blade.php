@extends('aftosa/reports/layout',[
    'title'=>'Detalle de Animales Vacunados por Vacunador con Bufalos/as'
])

@section('content')

    <table align="center" class="table-sm" style="width:100%">

        <tr style="font-size:1.5em">
            <td colspan="2"><b>Vacunador:</b></td>
            <td><b>{{ $vet }}</b></td>
        </tr>

        <thead style="font-weight:bold">

            <th>Acta</th>
            <th>Fecha Vac.</th>
            <th>Propietario</th>
            <th>Establecimiento</th>
            <th>R.E.N.S.P.A</th>
            <th style="text-align:center">Cantidad</th>
            <th>Estado</th>
            <th>Debe</th>

        </thead>

        <tbody>

            @if(count($actasByVet) > 0)

                @foreach ($actasByVet as $actas)

                    <tr class="border-top">

                        <td>{{ $actas['acta'] }}</td>    
                        <td>{{ date('d-m-Y', strtotime($actas['fechaVacunacion']))}}</td>    
                        <td>{{ $actas['propietario'] }}</td>       
                        <td>{{ $actas['establecimiento'] }}</td>       
                        <td>{{ $actas['renspa'] }}</td>       
                        <td style="text-align:center">{{ $actas['cantidad'] }}</td>       
                        <td><span @if($actas['pago']) style="color:green">Pagó @else style="color:red">No Pagó @endif </span></td>        
                        <td>@if(!$actas['pago'])${{ number_format($actas['cantidad'] * $campaignData->vacunadorA,2,',','.') }}@endif</td>       

                    </tr>
                                    
                @endforeach

            @else
                <tr class="border-top border-primary">
                    <td colspan="8">No hay registros asociados a este veterinario</td>
                </tr>
            @endif

        </tbody>

    </table>

@endsection