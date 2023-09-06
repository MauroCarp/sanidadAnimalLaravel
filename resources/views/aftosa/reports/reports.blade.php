@extends('adminlte::page')

@section('title', 'Informes')

@section('content')

    <div class="box pt-3">
       
        <div class="box-body table-responsive no-padding">

            <div class="list-group" style="font-size:1.5em;">

                @foreach($informes as $key => $informe)
                
                    @if($informe != 'Detalle Animales Vacunados por Vacunador' && $informe != 'Cronograma por Veterinario' && $informe != 'Cronograma Actual por Veterinario' && ($key + 1) != 8)
                        
                        <a href="{{ $key + 1 }}" class='list-group-item list-group-item-action' target='_blank'>
                            {{ $key + 1 }}- {{$informe}}
                        </a>

                    @elseif($key + 1 == 8)

                        <button class='list-group-item list-group-item-action' id="informe8" data-key="{{$key + 1}}">
                            {{ $key + 1 }}- {{$informe}}
                        </button>

                    @else

                        <a href='#' class='list-group-item list-group-item-action informeVeterinario' data-report="{{$key + 1}}" data-toggle='modal' data-target='#modalVeterinario'> {{ $key+1 }}- {{ $informe }} </a>

                    @endif

                @endforeach
                
            </div>

        </div>
    
    </div>
    
@endsection

@include('modals/aftosa/veterinario')

@section('js')
    <script>

        $('#selectVeterinario').select2({
            theme: 'bootstrap',
            width: '80%',
        })

        $('.informeVeterinario').on('click',function(){

            let key = $(this).attr('data-report')
            
            let report = key

            if(report != 3){
                report = 'schedule'
            }

            $('#formVeterinario').attr('action',report)
            $('#type').val(key)


        })

        $('#informe8').on('click',function(){

            let key = $(this).attr('data-key')

            let swalGenerating = Swal.mixin({
                            toast:true,
                            type: 'info',
                            title: 'Generando informe',
                            position: 'top-end',
                            showConfirmButton: false,
            })

            $.ajax({
                method:'GET',
                url:`${key}`,
                beforeSend:function(){
                    swalGenerating.fire()
                },
                success:function(data){

                    swalGenerating.close()
                    window.open(data.pdf_url, '_blank');

                },
                error:function(er){
                    console.log(er)
                }

            })
        })


    </script>
@endsection

@section('css')
    <style>
        .select2-container--bootstrap .select2-selection--single {
            border: solid 1px rgba(100,100,100,.5);
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
            vertical-align: middle;
            height: 100%;
        }

        .select2-results__options {
            max-height: 200px; /* Establece la altura máxima */
            overflow-y: auto; /* Hace que aparezca el scroll si se supera la altura */
        }
    </style>

@endsection