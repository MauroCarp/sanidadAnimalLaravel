@extends('aftosa/reports/layout',[
    'title'=>'Cant. de Establecimientos por distrito con detalle de categorías del rodeo y total de hacienda'
])

@section('content')

    <table align="center" class="table-sm" style="width:100%">

        <thead class="border-bottom border-primary" style="font-weight:bold">
            <th>Localidad</th>
            <th>Cant. Est.</th>
            <th>Vacas</th>
            <th>Vaquillonas</th>
            <th>Terneros</th>
            <th>Terneras</th>
            <th>Novillos</th>
            <th>Novillitos</th>
            <th>Toros</th>
            <th>Toritos</th>
            <th>Total</th>
        </thead>

        <tbody>

            @foreach ($distritosData as $distritoData)

                <tr class="border-top">

                    <td>{{ $distritoData['localidad'] }}</td>    
                    <td>{{ $distritoData['totalEstablecimientos'] }}</td>    
                    <td>{{ $distritoData['vacas'] }}</td>       
                    <td>{{ $distritoData['vaquillonas'] }}</td>       
                    <td>{{ $distritoData['terneros'] }}</td>       
                    <td>{{ $distritoData['terneras'] }}</td>       
                    <td>{{ $distritoData['novillos'] }}</td>       
                    <td>{{ $distritoData['novillitos'] }}</td>       
                    <td>{{ $distritoData['toros'] }}</td>       
                    <td>{{ $distritoData['toritos'] }}</td>       
                    <td style="font-weight:bold">{{ $distritoData['totalExistencia'] }}</td>       

                </tr>
                                
            @endforeach

            <tr style="font-weight:bold;color:blue" class="border-top border-primary">
                <td>TOTALES</td>
                <td>{{ $totalEstablecimientos}}</td>
                <td>{{ $totalVacas}}</td>
                <td>{{ $totalVaquillonas}}</td>
                <td>{{ $totalTerneros}}</td>
                <td>{{ $totalTerneras}}</td>
                <td>{{ $totalNovillos}}</td>
                <td>{{ $totalNovillitos}}</td>
                <td>{{ $totalToros}}</td>
                <td>{{ $totalToritos}}</td>
                <td>{{ $totalExistencia}}</td>
            </tr>
      
        </tbody>

    </table>

@endsection