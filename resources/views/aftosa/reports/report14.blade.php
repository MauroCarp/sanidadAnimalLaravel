@extends('aftosa/reports/layout',[
    'title'=>'Cantidad de Animales según Sistema Productivo'
])

@section('content')

    <table align="center" class="table table-striped" style="width:400px">

        <thead>
            <th>Sistema Productivo</th>
            <th style="text-align:center;">Cantidad de Animales</th>
        </thead>

        <tbody>

            @foreach ($animalesByExplotacion as $explotacion)
                <tr>
                    <td>{{ $explotacion['explotacion']}}</td>
                    <td style="text-align:center">{{ $explotacion['total']}}</td>
                </tr>
            @endforeach

        </tbody>

    </table>

@endsection
