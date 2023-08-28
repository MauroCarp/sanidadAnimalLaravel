@extends('aftosa/reports/layout',[
    'title'=>'Nómina de Vacunadores ordenada Alfabéticamente'
])

@section('content')

    <table align="center" class="table table-striped table-sm" style="width:100%">

        <thead class="border-bottom border-primary">
            <th>Nombre</th>
            <th>Matricula</th>
            <th>Tipo</th>
            <th>Domicilio</th>
            <th>Telefono</th>
        </thead>

        <tbody>

            @foreach ($vets as $vet)
                
                <tr class="border-top">

                    <td>{{ $vet->nombre  }}</td>    
                    <td>{{ $vet->matricula  }}</td>    
                    <td>{{ $vet->tipo  }}</td>    
                    <td>{{ $vet->domicilio  }}</td>    
                    <td>{{ $vet->telefono  }}</td>    

                </tr>
                
            @endforeach
      
        </tbody>

    </table>

@endsection