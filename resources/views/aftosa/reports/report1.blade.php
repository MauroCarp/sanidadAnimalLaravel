@extends('aftosa/reports/layout',[
    'title'=>'Animales Totales Vacunados por Vacunador'
])

@section('content')

    <table align="center" class="table table-striped" style="width:400px">

        <tr>
            <td colspan="2"><center><small><b>(Incluyendo establecimientos de distintos Distritos)</b></small></center></td>
        </tr>

        <thead>
            <th>VACUNADOR</th>
            <th style="text-align:center;">TOTAL</th>
        </thead>

        <tbody>
            @foreach ($vets as $vet)
                <tr>
                    <td>{{ $vet['nombre']}}</td>
                    <td style="text-align:center">{{ $vet['cantidad']}}</td>
                </tr>
            @endforeach

            <tr style="font-style:bold">
                <td>Total:</td>
                <td style="text-align:center;">{{ $total }}</td>
            </tr>
        </tbody>

    </table>

@endsection
