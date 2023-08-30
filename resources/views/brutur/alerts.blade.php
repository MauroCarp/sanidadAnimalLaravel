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

@section('js')

    @if(session('actasProductor') == 'error')
        
        <script>
            
            Swal.fire(
                'Actas no encontradas',
                'El R.E.N.S.P.A que se esta buscando, puede no existir en nuestra base de datos, o no tiene actas asociadas.',
                'error'
                )

        </script>

    @endif

    @if(session('actaCreated') == 'ok')

        <script>
            
            Swal.fire(
                'Acta cargada',
                'Ha sido cargada correctamente',
                'success'
            )

        </script>

    @endif
    
@endsection