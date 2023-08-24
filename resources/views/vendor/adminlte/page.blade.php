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

        $('#btnMenuAftosa').on('click',function(){

            // let campaign = localStorage.getItem('campaign')
            let campaign = getCookie('campaign')

            if(campaign == null || campaign == undefined || campaign == ''){
                $('#modalCampaign').modal('show')
            }else{
                $('.icon-aftosa ').next().text(`Aftosa ${campaign}`)
            } 

        })

        $('#btnAssignCampaign').on('click',function(){

            let campaignSelected = $('#campaignSelected').val()

            // localStorage.setItem('campaign',campaignSelected)

            var expiracion = new Date();

            expiracion.setDate(expiracion.getDate() + 1);
            
            document.cookie = `campaign=${campaignSelected}; expires=${expiracion.toUTCString()}; path=/`;

            $('.icon-aftosa ').next().text(`Aftosa ${campaignSelected}`)

            $('#modalCampaign').modal('hide')

        })

        // let campaign = localStorage.getItem('campaign')
        let campaign = getCookie('campaign')
        console.log(campaign)
        if(campaign) $('.icon-aftosa ').next().text(`Aftosa ${campaign}`)

    </script>

@stop
