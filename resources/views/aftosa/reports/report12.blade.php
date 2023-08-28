@extends('aftosa/reports/layout',[
    'title'=>'Cantidad de Animales y establecimientos Vacunados'
])

@section('content')

    <table align="center" class="table-sm" style="width:100%">

        <thead class="border-bottom border-primary">
            <th>Vacunador</th>
            <th>Renspa</th>
            <th style="text-align:center;">Carbunclo</th>
            <th style="text-align:center;">Brucelosis</th>
        </thead>

        <tbody>

            @foreach ($dataVacunados as $registro)

                <tr style="line-height:1em">
                    <td>{{ $registro['veterinario_info']['nombre'] ?? ''}}</td>    
                    <td>{{ $registro['renspa']}}</td>    
                    <td style="text-align:center;">@if($registro['cantidadCar'] == 0) NO @else SI @endif</td>    
                    <td style="text-align:center;">@if($registro['cantidadBruce'] == 0) NO @else SI @endif</td>    
                </tr>
                
            @endforeach

            <tr style="color:blue;line-height:1em">
                <td colspan="2">Total Establecimientos NO Vacunados Carbunclo: {{$totalEstCar}}<td>
                <td colspan="2"></td>
            </tr>

            <tr style="color:blue;line-height:1em">
                <td colspan="2">Total Establecimientos NO Vacunados Brucelosis: {{$totalEstBruce}}<td>
                <td colspan="2"></td>
            </tr>

        </tbody>

    </table>

@endsection