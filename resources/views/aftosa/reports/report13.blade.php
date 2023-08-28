@extends('aftosa/reports/layout',[
    'title'=>'Cantidad de Establecimientos según Sistema Productivo'
])

@section('content')

    <table align="center" class="table-sm" style="width:100%">

        <thead>
            <th style="width:150px">Sist. Productivo</th>
            <th>Establecimiento</th>
            <th>R.E.N.S.P.A</th>
            <th>Animales</th>
        </thead>

        <tbody>

            @foreach ($sistemasProductivos as $sistemaProductivo => $registros)

                @foreach ($registros['registros'] as $registro)

                    <tr @if($loop->first) class="border-top border-primary" @endif style="line-height:1em;">
                        <td><b> @if($loop->first){{ Str::upper($sistemaProductivo) }}@endif</b></td>
                        <td class="border-bottom">{{$registro->establecimiento}}</td>
                        <td class="border-bottom">{{$registro->renspa}}</td>
                        <td class="border-bottom">{{$registro->cantidad}}</td>
                    </tr>

                @endforeach

                <tr>
                    <td colspan="2" style="color:blue;font-weight:bold">Total Establecimientos ({{ $sistemaProductivo }}): {{ $registros['totalEstablecimientos']}}</td>
                </tr>
            @endforeach


        </tbody>

    </table>

@endsection
