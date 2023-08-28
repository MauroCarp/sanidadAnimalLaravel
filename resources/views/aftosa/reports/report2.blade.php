@extends('aftosa/reports/layout',[
    'title'=>'Animales Totales Vacunados por Vacunador'
])

@section('content')

    <table align="center" class="table-sm" style="width:100%">

        <thead class="border-bottom">
            <th>IRIONDO</th>
            <th>DISTRITO</th>
            <th>TOTAL ANIMALES</th>
            <th style="text-align:center">Cant. Est.</th>
        </thead>

        <tbody>
            @foreach ($distritosData as $distritoData)
                <tr style="line-height:1em">
                    <td></td>    
                    <td>{{ $distritoData->distrito }}</td>    
                    <td>
                        <table>

                            <tr>
                                <td style="width:150px">
                                    Total Vacunado: 
                                </td>
                                <td>
    
                                    {{ number_format($distritoData->totalVacunados, 0, ',', '.') }}
                                </td>
                            </tr>

                        </table>
                    </td>    
                    <td style="text-align:center">{{ number_format($distritoData->totalEstablecimientos, 0, ',', '.') }}</td>    
                </tr>
                <tr style="line-height:1em">
                    <td></td>    
                    <td></td>    
                    <td>
                        <table>

                            <tr>
                                <td style="width:150px">
                                    Total Animales: 
                                </td>
                                <td>
                                    {{ number_format($distritoData->totalAnimales, 0, ',', '.') }}        
                                </td>
                            </tr>

                        </table>
                    </td>    
                    <td></td>    
                </tr>
                <tr style="line-height:1em">
                    <td  @if($loop->last) class="border-bottom"@endif></td>    
                    <td class="border-bottom"></td>    
                    <td class="border-bottom">
                        <table>
                            <tr>
                                <td style="width:150px">
                                    <b>Parcial:</b> 
                                </td>
                                <td>
                                    {{ $distritoData->totalParcial }}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="border-bottom"></td>    
                </tr>
            @endforeach

            <tr style="color:blue;line-height:1em">
                <td colspan="2">Promedio Animales: {{ number_format($promedioAnimales, 2, ',', '.') }}</td>
                <td>
                    <table>
                        <tr>
                            <td style="width:150px">Total Vacunado:</td>
                            <td>{{ number_format($totalVacunados, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </td>
                <td style="text-align:center">{{ number_format($totalEstablecimientos, 0, ',', '.') }}</td>
            </tr>
            <tr style="color:blue;font-weight:bold;line-height:1em">
                <td colspan="2"></td>
                <td>
                    <table>
                        <tr>
                            <td style="width:150px">Total Animales:</td>
                            <td>{{ number_format($totalAnimales, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </td>
                <td></td>
            </tr>
            <tr style="color:blue;font-weight:bold;line-height:1em">
                <td colspan="2"></td>
                <td>
                    <table>
                        <tr>
                            <td style="width:150px">Parcial:</td>
                            <td>{{ number_format($totalParcial, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </td>
                <td></td>
            </tr>
        </tbody>

    </table>

@endsection