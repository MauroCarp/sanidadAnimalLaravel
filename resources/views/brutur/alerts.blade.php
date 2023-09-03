@extends('adminlte::page')

@section('title', 'Alertas Bru-Tur')


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
                                data-type='{{ strtolower($alert->campaign) }}'><i class='fa fa-bell'></i></button>
                                
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


    <script>

        $('.btnNotificar').on('click',function(){
            let token = $('input[name="_token"]').val()
            let renspa = $(this).attr('data-renspa');
            let type = $(this).attr('data-type');
            let data = `_token=${token}&renspa=${renspa}&type=${type}&emailType=alert`
            let btn = $(this)

            $.ajax({
                method:'POST',
                url:'{{route("brutur.notificar")}}',
                data,
                beforeSend:function(){
                    btn.find('i').removeClass('fa-bell')
                    btn.find('i').addClass('fa-sync-alt')
                    btn.find('i').addClass('rotating')
                },
                success:function(response){

                    if(response == 'ok'){

                        Swal.fire({
                            toast:true,
                            type: 'success',
                            title: 'Alerta enviada',
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        btn.parent().parent().hide(1000)
                        
                    }
                }

            })

        })
        
    </script>

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

@section('css')

    <style>
        .rotating {
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>

@endsection