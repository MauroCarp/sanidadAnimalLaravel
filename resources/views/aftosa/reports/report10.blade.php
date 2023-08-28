@extends('aftosa/reports/layout',[
    'title'=>'Montos de Campaña N°' . $campaignData[0]['numero']
])

@section('content')

    <ul class="list-unstyled">
        <li>Administración F.I.S.S.A Aftosa: ${{ number_format($montosActas[0]['admAf'] ,2,',','.') }}</li>
        <li>Vacunadores Aftosa: ${{ number_format($montosActas[0]['vacunadorAf'] ,2,',','.') }}</li>
        <li>Vacunas Aftosa: ${{ number_format($montosActas[0]['vacunaAf'] ,2,',','.') }}</li>
        <li>Redondeo Aftosa: ${{ number_format($montosActas[0]['redondeoAf'] * $campaignData[0]['vacunaA'],2,',','.') }}</li>
        <li>Administración F.I.S.S.A Carbunclo: ${{ number_format($montosActas[0]['admCar'] ,2,',','.') }}</li>
        <li>Vacunadores Carbunclo: ${{ number_format($montosActas[0]['vacunadorCar'] ,2,',','.') }}</li>
        <li>Vacunas Carbunclo: ${{ number_format($montosActas[0]['vacunaCar'] ,2,',','.') }}</li>
        <li>Redondeo Carbunclo: ${{ number_format($montosActas[0]['redondeoCar'] * $campaignData[0]['vacunaA'],2,',','.') }}</li>
    </ul>

@endsection