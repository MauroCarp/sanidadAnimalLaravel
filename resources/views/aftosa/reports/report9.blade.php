@extends('aftosa/reports/layout', [
    'title' => 'Evolución semanal de la Campaña de Vacunación Anti-Aftosa'
])

@section('content')
<h5>Campa&ntilde;a Nº{{$campaign}}</h5>

<table align="center" class="table-sm" style="width:100%">

    <thead class="border-bottom border-primary">
            <th>Mes</th>
            <th>Semana</th>
            <th>Cant. Actas</th>
            <th>Animales Vacunados</th>
    </thead>

    <tbody>

        @foreach ($data['meses'] as $month => $weeks)

            @foreach ($weeks as $week => $weekData)
         `       <tr @if($loop->last) class="border-bottom" @endif>
                    <td>@if($loop->first) {{ __($month) }}@endif</td>
                    <td>{{ $week }}</td>
                    <td>{{$weekData['actas']}}</td>
                    <td>{{$weekData['animales']}}</td>
                </tr>
            @endforeach
            
        @endforeach
        <tr></tr>
        <tr class="border-top border-primary" style="color:blue;font-weight:bold">
            <td colspan="2">TOTALES</td>
            <td>{{($data['totalActa'])}}</td>
            <td>{{($data['totalAnimales'])}}</td>
        </tr>
    </tbody>

</table>
@endsection
