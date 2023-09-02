@extends('adminlte::page')

@section('title', 'Pendientes')

@section('content')

    <div class="box pt-2">

        <div class="box-header with-border mb-2">

            <button class="btn btn-primary" id="btnEnviarSenasa">

                Enviar a Senasa

            </button>

        </div>

        <div class="box-body">
                
            <table class="table table-bordered table-striped dt-responsive tablas"  width="100%">
            
            <thead>
            
                <tr>

                    <th>Renspa</th>

                    <th>Establecimiento</th>

                    <th>Protocolo</th>

                    <th>Campa&ntilde;a</th>

                    <th>Estado</th>

                    <th>Fecha Cargado</th>

                    <th>Fecha Muestra</th>

                </tr> 

            </thead>

            <tbody>

            @foreach($pendientes as $pendiente)
                <tr>

                    <td>{{ $pendiente->renspa }}</td>
                    <td>{{ $pendiente->establecimiento->establecimiento }}</td>
                    <td>{{ $pendiente->protocolo }}</td>
                    <td>{{ $pendiente->campania }}</td>
                    <td>{{ $pendiente->estado }}</td>
                    <td>{{ $pendiente->fechaCarga->format('d-m-Y') }}</td>
                    <td>{{ $pendiente->fechaEstado->format('d-m-Y') }}</td>

                </tr>
            @endforeach

            </tbody>

            </table>

        </div>

    </div>

@endsection

@section('js')

    <script>
        const enviarPendientes = ()=>{
            
            let url = 'informeSenasa'

            window.open(url, '_blank');

            setTimeout(() => {
                window.location = `{{ route('brutur.pending',['status'=>'enviado']) }}`;
            }, 500);


        }

        $('#btnEnviarSenasa').on('click',()=>{

            enviarPendientes();

        })    
    </script>
    @if($status == 'enviado')
        <script>
            Swal.fire(
            'El estado cambio a "Enviados a SENASA"',
            '',
            'success',
            )
        </script>
    @endif

@endsection