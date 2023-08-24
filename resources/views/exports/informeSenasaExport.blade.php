<table>

    <thead>

        <tr>
    
            <th><b>RENSPA</b></th>

            <th><b>PRODUCTOR</b></th>

            <th><b>MOTIVO</b></th>
            
            <th><b>FECHA MUESTRA</b></th>
            
            <th><b>VETERINARIO</b></th>

        </tr>

    </thead>

    <tbody>

        @foreach($pending as $pend)

            <tr>

                <td>{{ $pend['renspa']}}</td>
                
                <td>{{ $pend['propietario'] }}</td>

                <td>{{ $pend['motivo'] }}</td>

                <td>{{ $pend['fechaMuestra'] }}</td>

                <td>{{ $pend['veterinario'] }}</td>

            </tr>

        @endforeach

    </tbody>

</table>