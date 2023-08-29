@extends('aftosa/reports/layout',[
    'title'=>'Informe Entes Brucelosis-Tuberculosis'
])

@section('content')

    <small>Periodo: {{$periodo}}</small>


    <table class="table-sm table-striped" style="width:85%">
        <thead class="border-top border-bottom border-primary bg-info">
            <th colspan="2" style="text-align:center;color:white">BRUCELOSIS</th>
        </thead>

        <tbody>
            <tr>
                <td>Cantidad de Establecimientos DOES Total:</td>
                <td>{{ $dataBrucelosis['cantEstablecimientosDOESTotal']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Establecimientos DOES Parcial:</td>
                <td>{{ $dataBrucelosis['cantEstablecimientosDOESParcial']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Establecimientos MuVe:</td>
                <td>{{ $dataBrucelosis['cantEstablecimientosMuVe']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Establecimientos SAN:</td>
                <td>{{ $dataBrucelosis['cantEstablecimientosSAN']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Establecimientos CSM:</td>
                <td>{{ $dataBrucelosis['cantEstablecimientosCSM']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Establecimientos Control Interno:</td>
                <td>{{ $dataBrucelosis['cantEstablecimientosCtrlInt']}}</td>
            </tr>
                
            <tr>
                <td>Cantidad de Establecimientos Remuestreo:</td>
                <td>{{ $dataBrucelosis['cantEstablecimientosRemuestreo']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Establecimientos con A. Positivos:</td>
                <td>{{ $dataBrucelosis['cantEstablecimientosPositivos']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Establecimientos con A. Negativos:</td>
                <td>{{ $dataBrucelosis['cantEstablecimientosNegativos']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Establecimientos con A. Sospechosos:</td>
                <td>{{ $dataBrucelosis['cantEstablecimientosSospechosos']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Animales SAN:</td>
                <td>{{ $dataBrucelosis['cantAnimalesSAN']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Animales CSM:</td>
                <td>{{ $dataBrucelosis['cantAnimalesCSM']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Animales en Control Interno:</td>
                <td>{{ $dataBrucelosis['cantAnimalesCtrlInt']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Animales en Remuestreo:</td>
                <td>{{ $dataBrucelosis['cantAnimalesRemuestreo']}}</td>
            </tr>

            <tr>
                <td>Cantidad de Animales Positivos:</td>
                <td>{{ $dataBrucelosis['cantAnimalesPositivos']}}</td>
            </tr>
                
            <tr>
                <td>Cantidad de Animales Negativos:</td>
                <td>{{ $dataBrucelosis['cantAnimalesNegativos']}}</td>
            </tr>
                
            <tr>
                <td>Cantidad de Animales Sospechosos:</td>
                <td>{{ $dataBrucelosis['cantAnimalesSospechosos']}}</td>
            </tr>
                
            <tr>
                <td>Cantidad de U.P Libres Certificadas en el Mes:</td>
                <td>{{ $dataBrucelosis['cantUPLibresCert']}}</td>
            </tr>
                
            <tr>
                <td>Cantidad de U.P Libres Certificadas CARGADAS en el Mes:</td>
                <td>{{ $dataBrucelosis['cantUPLibresCertCargadas']}}</td>
            </tr>
                
            <tr>
                <td>Cantidad de Animales Libres Total:</td>
                <td>{{ $dataBrucelosis['cantAnimalesLibresTotal']}}</td> 
            </tr>
                
            </tr>
        </tbody>
    </table>
    <div style="page-break-after: always;"></div>
    <table class="table-sm table-striped" style="width:85%">
        <thead class="border-top border-bottom border-primary bg-info">
            <th colspan="2" style="text-align:center;color:white">TUBERCULOSIS</th>
        </thead>

        <tbody>

            <tr>
                <td>Cantidad de Animales Tuberculinizados</td>
                <td>{{ $dataTuberculosis['cantAnimalesTuberculinizados']}}</td>
            </tr>
            <tr>
                <td>Cantidad de Animales Libres Tuberculinizados</td>
                <td>{{ $dataTuberculosis['cantAnimalesLibresTuberculinizados']}}</td>
            </tr>
            <tr>
                <td>Cantidad de Establecimientos Libres Certificados</td>
                <td>{{ $dataTuberculosis['cantEstablecimientosLibres']}}</td>
            </tr>
            <tr>
                <td>Cantidad de Establecimientos Libres Certificados CARGADOS</td>
                <td>{{ $dataTuberculosis['cantEstablecimientosLibresCargados']}}</td>
            </tr>


        </tbody>
    </table>

@endsection