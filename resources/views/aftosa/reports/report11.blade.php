@extends('aftosa/reports/layout',[
    'title'=>'Cantidad de Animales y establecimientos Vacunados'
])

@section('content')

    <table align="center" class="table-sm" style="width:100%">

        <thead class="border-bottom border-primary">
            <th>Vacunador</th>
            <th>Renspa</th>
            <th style="text-align:center;">Animales Carbunclo</th>
            <th style="text-align:center;">Animales Brucelosis</th>
        </thead>

        <tbody>

            @foreach ($dataVacunados as $registro)

                <tr style="line-height:1em">
                    <td>{{ $registro['veterinario_info']['nombre'] ?? ''}}</td>    
                    <td>{{ $registro['renspa']}}</td>    
                    <td style="text-align:center;">{{ $registro['cantidadCar']}}</td>    
                    <td style="text-align:center;">{{ $registro['cantidadBruce']}}</td>    
                </tr>

                @if($loop->last)
                    <tr>
                        <td></td>
                        <td class="border-top border-primary" style="text-align:right;">Totales:</td>
                        <td class="border-top border-primary" style="text-align:center;">{{$totalCar}}</td>
                        <td class="border-top border-primary" style="text-align:center;">{{$totalBruce}}</td>
                    </tr>
                @endif

            @endforeach

            <tr style="color:blue;line-height:1em">
                <td colspan="2">Total Establecimientos Vacunados Carbunclo: {{$totalEstCar}}<td>
                <td colspan="2"></td>
            </tr>

            <tr style="color:blue;line-height:1em">
                <td colspan="2">Total Establecimientos Vacunados Brucelosis: {{$totalEstBruce}}<td>
                <td colspan="2"></td>
            </tr>

        </tbody>

    </table>

@endsection