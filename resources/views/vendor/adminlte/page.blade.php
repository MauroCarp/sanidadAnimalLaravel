@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Preloader Animation --}}
        @if($layoutHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>

    {{-- Modals --}}
    @include('modals/aftosa/producerSituation')
    @include('modals/brutur/dateRangePicker')
    @include('modals/brutur/updateStatusRenspa')
    
    @include('modals/aftosa/actasByProducer')
    @include('modals/aftosa/acta')
    @include('modals/aftosa/updateCampaign')

@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')

    <script>

        const getCookie = function(nombre) {

            let cookies = document.cookie.split(';');

            for (let i = 0; i < cookies.length; i++) {

                let cookie = cookies[i].trim();

                if (cookie.indexOf(nombre + '=') === 0) {
                    return cookie.substring(nombre.length + 1);
                }

            }

            return null; // La cookie no se encontró
        }

        $(".tablas").DataTable({

            "language": {

                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
                },
                "ordering":"false",

            }

        });

        $('#btnMenuAftosa').on('click',function(e){

            let campaign = getCookie('campaign')

            if(campaign == null || campaign == undefined || campaign == ''){

                e.stopPropagation();
                e.preventDefault()
                
                $('#modalCampaign').modal('show')

            }else{
                
                let arrowIcon = $('.icon-aftosa').next().find('i')
                $('.icon-aftosa ').next().text(`Aftosa Nº${campaign}`)
                $('.icon-aftosa').next().append(arrowIcon)

                $('#campaign_number').html(`Campaña Aftosa Nº${campaign}`)
            } 

        })

        $('#btnNuevaCampania').on('click',function(){
            $('#formNewCampaign').toggle(500);
        })

        $('#btnAssignCampaign').on('click',function(){
            
            let campaignSelected = $('#campaignSelected').val()

            var expiracion = new Date();

            expiracion.setDate(expiracion.getDate() + 1);
            
            document.cookie = `campaign=${campaignSelected}; expires=${expiracion.toUTCString()}; path=/`;

            let arrowIcon = $('.icon-aftosa').next().find('i')
            $('.icon-aftosa ').next().text(`Aftosa Nº${campaignSelected}`)
            $('.icon-aftosa').next().append(arrowIcon)

            $('#campaign_number').html(`Campaña Aftosa Nº${campaignSelected}`)

            $('#modalCampaign').modal('hide')

        })

        $('#btnBuscarActa').on('click',function(e){

            let renspa = $('#renspaActa').val()

            window.location = `/aftosa/acta/${renspa.replace('/','-')}`

        })

        let campaign = getCookie('campaign')

        if(campaign) {
            
            let arrowIcon = $('.icon-aftosa').next().find('i')
            $('.icon-aftosa').next().text(`Aftosa Nº${campaign}`)
            $('.icon-aftosa').next().append(arrowIcon)

            $('#campaign_number').html(`Campaña Aftosa Nº${campaign}`)
        }

        $('#btnStatusSanitario').on('click',function(e){

            e.preventDefault()

            let renspa = $('#renspaStatusSanitario').val().replace('/','-')

            $('.formRenspaStatusSanitario').attr('action',`/brutur/updateStatus/${renspa}`)
            $('.formRenspaStatusSanitario').submit()

        })


        $('#btnMenuCampaign').on('click',()=>{
            
            let campaign = getCookie('campaign')

            $.ajax({
                method:'get',
                url:`/campaign/${campaign}`,
                success:function(response){

                    let data = JSON.parse(response)

                    $('#campaignNumero').val(data.numero)
                    $('#fechaInicio').val(data.inicio)
                    $('#fechaCierre').val(data.final)
                    $('#precioAdmAftosa').val(data.admA)
                    $('#precioVacunaAftosa').val(data.vacunadorA)
                    $('#precioVeterinarioAftosa').val(data.vacunaA)
                    $('#precioAdmCarb').val(data.admC)
                    $('#precioVacunaCarb').val(data.vacunadorC)
                    $('#precioVeterinarioCarb').val(data.vacunaC)
                    $('#formUpdateCampaign').attr('action',`/campaign/${data.id}`)


                }
            })

        })

        $('#rangeDate').daterangepicker({
            opens: 'left'
        });
        
    </script>

    @if(session('error') == 'renspa')
        <script>
            $('#btnCargarActa a').trigger('click')

            Swal.fire(
            'RENSPA no encontrado',
            'El RENSPA ingresado no corresponde a ningun productor',
            'error'
            )
            

        </script>
    @endif

    @if(session('error') == 'noData')
        <script>

            Swal.fire(
            'RENSPA no encontrado',
            'El RENSPA ingresado no corresponde a ningun productor, o no tiene actas asociadas',
            'error'
            )
            

        </script>
    @endif

    @if(session('newCampaign') == 'ok')

        <script>

            
            
            let number = "{{session('campaign')}}"
            let expiracion = new Date();

            expiracion.setDate(expiracion.getDate() + 1);

            document.cookie = `campaign=${number}; expires=${expiracion.toUTCString()}; path=/`;

            let arrowIcon = $('.icon-aftosa').next().find('i')
            $('.icon-aftosa').next().text(`Aftosa Nº${number}`)
            $('.icon-aftosa').next().append(arrowIcon)

            $('#campaign_number').html(`Campaña Aftosa Nº${number}`)

            Swal.fire(
            'Campaña creada correctamente',
            'Puede continuar la configuración de la campaña en la seccion "Campaña"',
            'success'
            ).then(()=>{
                $('#btnMenuCampaign').trigger('click')
                $('#modalUpdateCampaign').modal('show')

            })



        </script>

    @endif

    @if(session('updateCampaign') == 'ok')

        <script>

            Swal.fire(
            'Campaña modificada correctamente',
            'Se ha modificado correctamente',
            'success'
            )

        </script>

    @endif

@stop

@section('css')

    <style>
        #btnMenuAftosa > .nav-link{
            pointer-events: none;
        }

    </style>
@stop