@extends('adminlte::page')

@section('title', 'Cronograma')

@section('content')

<div class="box pt-2">

    <div class="box-header with-border mb-3">

        <div class="input-group justify-content-between">

            <h5>Vacunador: <b>{{ $vet->nombre }}</b></h5>
            <div class="btn-group">

                <form action="{{ $informe}}" method="post" target="_blank">
                    @csrf
                    <input type="hidden" name="selectVeterinario" value="{{ $vet->matricula}}">
                    <button type="submit" class="btn btn-primary" id="btnImprimirCronograma" style="margin-right:5px">
                        Imprimir Cronograma
                    </a>
                </form>

                <button class="btn btn-primary" id="btnEnviarEmail">
                    Enviar por E-mail
                </button>

            </div>



        </div>

    </div>
    

    <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas"  width="100%">
        
        <thead>
        
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

        </tbody>

        </table>

    </div>

</div>
    

@endsection
