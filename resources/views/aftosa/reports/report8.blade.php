@extends('aftosa/reports/layout', [
    'title' => 'Detalle por Distrito de los Propietarios y Categorización de su Rodeo-Otras Especies'
])

@section('content')
<table align="center" class="table-sm" style="width:100%">
    <thead class="border-bottom border-primary">
        <tr>
            <th>Distrito</th>
            <th>Propietario</th>
            <th>Establecimiento</th>
            <th>Explotaci&oacute;n</th>
            <th class="text-center">Caprinos</th>
            <th class="text-center">Ovinos</th>
            <th class="text-center">Porcinos</th>
            <th class="text-center">Equinos</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($distritosInfo as $distrito => $distritoData)
        @foreach ($distritoData['establecimientos'] as $establecimiento)
        <tr style="line-height: 1em;">
            <td>@if($loop->first){{ $distrito }}@endif</td>
            <td>{{ $establecimiento->propietario }} {{ $establecimiento->renspa}}</td>
            <td>{{ $establecimiento->establecimiento}}</td>
            <td>{{ $establecimiento->explotacion}}</td>
            <td class="text-center">{{ $establecimiento->caprinos}}</td>
            <td class="text-center">{{ $establecimiento->ovinos}}</td>
            <td class="text-center">{{ $establecimiento->porcinos}}</td>
            <td class="text-center">{{ $establecimiento->equinos}}</td>
        </tr>
        @endforeach
        <tr style="line-height: 1em; color: blue; font-weight: bold;">
            <td></td>
            <td style="text-align: right;" class="border-top border-primary">Total por Localidad:</td>
            <td class="border-top border-primary">{{ $distritoData['totalEstablecimientos']}}</td>
            <td style="text-align: center;" class="border-top border-primary"></td>
            <td style="text-align: center;" class="border-top border-primary">{{ $distritoData['totalCaprinos']}}</td>
            <td style="text-align: center;" class="border-top border-primary">{{ $distritoData['totalOvinos']}}</td>
            <td style="text-align: center;" class="border-top border-primary">{{ $distritoData['totalPorcinos']}}</td>
            <td style="text-align: center;" class="border-top border-primary">{{ $distritoData['totalEquinos']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
