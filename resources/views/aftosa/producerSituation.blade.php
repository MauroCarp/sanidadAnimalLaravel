@extends('aftosa/reports/layout',[
    'title'=>'Informe de Situación de Productor'
])

@section('content')

    <small>(Para presentar a quien corresponda)</small>

    <h3><span class="text-primary">Renspa: </span>{{$datosEstablecimiento->renspa}} &nbsp;&nbsp;&nbsp;<span class="text-primary">DOC: </span>{{$datosEstablecimiento->tipoDoc }} {{$datosEstablecimiento->numDoc}}</h3>

    <table class="table-sm" style="width:100%">
        <thead class="border-top border-bottom border-primary">
            <th>Productor</th>
            <th>Departamento/Localidad</th>
            <th>Establecimiento</th>
            <th>Explotaci&oacute;n</th>
        </thead>

        <tbody>
            <tr>
                <td>{{$datosEstablecimiento->propietario}}</td>
                <td>{{$datosEstablecimiento->distrito->name}}</td>
                <td>{{$datosEstablecimiento->establecimiento}}</td>
                <td>{{$datosEstablecimiento->explotacion}}</td>
            </tr>
            <tr>
                <td></td>
                <td>{{$departamento}}</td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>

    <strong>Composici&oacute;n del rodeo</strong>
    <table class="table-sm" style="font-weight:bold">
        <tr>
            <td style="color:brown">Vacas:</td>
            <td>{{$datosEstablecimiento->vacas}}</td>
            <td></td>
            <td style="color:brown">Toros:</td>
            <td>{{$datosEstablecimiento->toros}}</td>
            <td></td>
            <td style="color:brown">Toritos:</td>
            <td>{{$datosEstablecimiento->toritos}}</td>
        </tr>
        <tr>
            <td style="color:brown">Vaquillonas:</td>
            <td>{{$datosEstablecimiento->vaquillonas}}</td>
            <td></td>
            <td style="color:brown">Novillos:</td>
            <td>{{$datosEstablecimiento->novillos}}</td>
            <td></td>
            <td style="color:brown">Novillitos:</td>
            <td>{{$datosEstablecimiento->novillitos}}</td>
        </tr>
        <tr>
            <td style="color:brown">Terneros:</td>
            <td>{{$datosEstablecimiento->terneros}}</td>
            <td></td>
            <td style="color:brown">Terneras:</td>
            <td>{{$datosEstablecimiento->terneras}}</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td style="color:brown">B&uacute;falos Mayores:</td>
            <td>{{$datosEstablecimiento->bufaloMay}}</td>
            <td></td>
            <td style="color:brown">B&uacute;falos Menores:</td>
            <td>{{$datosEstablecimiento->bufaloMen}}</td>
            <td colspan=""></td>
        </tr>

    </table>

    <table class="table-sm" style="font-weight:bold">
        <tr>
            <td style="color:brown">Fecha Vacunaci&oacute;n:</td>
            <td>{{date('d-m-Y', strtotime($datosEstablecimiento->fechaVacunacion))}}</td>
            <td></td>
            <td style="color:brown">Regimen de Tenencia:</td>
            <td>{{$datosEstablecimiento->regimen}}</td>
        </tr>
    </table>
@endsection