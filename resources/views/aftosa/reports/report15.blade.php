@extends('aftosa/reports/layout',[
    'title'=>'Cronograma por Veterinario'
])

@section('content')

    <table class="table-sm"  width="100%">
        
        <tr class="border-bottom border-primary">
            <td colspan="2">
                <h5>Vacunador: <b>{{ $vet->nombre }}</b></h5>
            </td> 
            <td colspan="4"></td>
        </tr>

        <thead class="border-bottom border-primary">
        
            <tr>

                <th>Fecha de Vacunaci&oacute;n</th>

                <th>R.E.N.S.P.A</th>

                <th>Nombre/Apellido</th>

                <th>Parcial</th>

                <th>Total</th>

                <th>Fecha Vencimiento</th>

            </tr> 

        </thead>

        <tbody>

            @foreach($actasByVet as $acta)
                <tr>
                    <td>{{ $acta->fechaVacunacion }}</td>
                    <td>{{ $acta->renspa }}</td>
                    <td>{{ $acta->propietario }}</td>
                    <td>{{ $acta->parcial}}</td>
                    <td>{{ $acta->total }}</td>
                    <td>{{ $acta->fechaVencimiento }}</td>
            
                </tr>
            @endforeach

            <tr class="border-top border-primary" style="color:blue;font-weight:bold">
                <td colspan="2"></td>
                <td style="text-align:right">Totales:</td>
                <td>{{$totalParcial}}</td>
                <td>{{$total}}</td>
                <td></td>
            </tr>

        </tbody>

    </table>

@endsection
