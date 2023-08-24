<table>

    <thead>

        <tr>
    
            <th><b>NOMBRE</b></th>

            <th><b>MATRICULA</b></th>

            <th><b>DOMICILIO</b></th>
            
            <th><b>TELEFONO</b></th>
            
            <th><b>EMAIL</b></th>

            <th><b>CUIT</b></th>
        </tr>

    </thead>

    <tbody>

        @foreach($veterinaries as $vet)

            <tr>

                <td>{{ $vet->nombre}}</td>
                
                <td>{{ $vet->matricula }}</td>

                <td>{{ $vet->domicilio }}</td>

                <td>{{ $vet->telefono }}</td>

                <td>{{ $vet->email }}</td>
                
                <td>{{ $vet->cuit }}</td>

            </tr>

        @endforeach

    </tbody>

</table>