@extends('adminlte::page')

@section('title', 'Informes')

@section('content')

    <div class="box pt-3">
       
        <div class="box-body table-responsive no-padding">

            <div class="list-group" style="font-size:1.5em;">

                @foreach($informes as $key => $informe)
                
                    @if($informe != 'Detalle Animales Vacunados por Vacunador' AND $informe != 'Cronograma por Veterinario' AND $informe != 'Cronograma Actual por Veterinario')
                        
                        <a href='extensiones/fpdf/informesPdf.php?informe=informe{{ $key + 1}}' class='list-group-item list-group-item-action' target='_blank'>
                            {{ $key + 1 }}- {{$informe}}
                        </a>

                    @else

                        <a href='#' class='list-group-item list-group-item-action' data-toggle='modal' data-target='@if($informe == 'Cronograma por Veterinario' OR $informe == 'Cronograma Actual por Veterinario')#matricula-cronograma{{ $key + 1 }}@else#matricula-informe{{ $key + 1 }}@endif'> {{ $key+1 }}- {{ $informe }} </a>

                    @endif

                @endforeach
                
            </div>

        </div>
    
    </div>
    
@endsection