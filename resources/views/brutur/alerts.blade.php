@extends('adminlte::page')

@section('title', 'Productores')


@section('content')
<div class="box pt-3">

    <div class="box-header with-border">
      
        <h3 class="box-title"><i class="fa fa-bullhorn"></i> Tablero de Alertas</h3>

    </div>
    
    <div class="box-body">

        <table class="table tablas">
        
            <thead>
                
                <th>Renspa</th>
                
                <th>Establecimiento</th>
                
                <th>Propietario</th>
                
                <th>Veterinario</th>
                
                <th>Campaña</th>
                
                <th>Estado</th>
                
                <th>Explotaci&oacute;n</th>
                
                <th>Fecha Vencimiento</th>
                
                <th>Notificar</th>
                
            </thead>

            <tbody>

                @foreach ($alerts as $key_tipo => $ar_tipo )
                    
                    @foreach ($ar_tipo as $alert)

                        <tr class="alert @if($key_tipo == 'vencidos') alert-danger @else alert-warning @endif">
                            <td>{{ $alert->renspa}}</td>
                            <td>{{ $alert->establecimiento}}</td>
                            <td>{{ $alert->propietario}}</td>
                            <td>{{ $alert->veterinario}}</td>
                            <td>{{ $alert->campaign}}</td>
                            <td>{{ $alert->estado}}</td>
                            <td>{{ $alert->explotacion}}</td>
                            <td>{{ $alert->fechaVencimiento}}</td>
                            <td class="align-center">
            
                                <button 
                                class='btn btn-secondary btnNotificar' 
                                data-renspa='{{$alert->renspa}}' 
                                data-campaign='{{$alert->campaign}}' 
                                data-alert='{{$key_tipo}}'
                                data-estado='{{$alert->estado}}'><i class='fa fa-bell'></i></button>
                                
                            </td>
                        </tr>
                    @endforeach

                @endforeach

            </tbody>

        </table>

    </div>
</div>
@endsection