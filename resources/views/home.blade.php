@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
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

@endsection
