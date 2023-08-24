@extends('adminlte::page')

@section('title', 'Notificados')

@section('content')

    <div class="box pt-2">

        <div class="box-body">
                
            <table class="table table-bordered table-striped dt-responsive tablas"  width="100%">
            
            <thead>
            
                <tr>

                    <th>Renspa</th>

                    <th>Establecimiento</th>

                    <th>Propietario</th>

                    <th>Campaña</th>

                    <th>Fecha Notificado</th>

                </tr> 

            </thead>

            <tbody>

            @foreach($notificados as $notificado)
                <tr>

                    <td>{{ $notificado->renspa }}</td>
                    <td>{{ $notificado->establecimiento->establecimiento }}</td>
                    <td>{{ $notificado->establecimiento->propietario }}</td>
                    <td>{{ $notificado->campania }}</td>
                    <td>{{ $notificado->fechaNotificado->format('d-m-Y') }}</td>

                </tr>
            @endforeach

            </tbody>

            </table>

        </div>

    </div>

@endsection
