@extends('adminlte::page')

@section('title', 'Recepción')


@section('content')

    <div class="box pt-3">

        <div class="box-body">

            <form action="{{ 'receptions' }}" method="POST">

                @csrf

                <table class="table table-bordered table-striped dt-responsive tablas tableReceptions" width="100%">
                
                    <thead>
                    
                        <tr>

                            <th>Fecha Ingreso</th>

                            <th>U.E.L</th>

                            <th>Cantidad</th>

                            <th>Marca</th>

                            <th>Serie</th>

                            <th>Fecha Vencimiento</th>

                            <th></th>

                        </tr> 

                    </thead>

                    <tbody id="tbodyReceptions">
                        
                        @foreach($recepciones as $key => $recepcion)

                            <tr>
                                <td>{{ $recepcion->fechaEntrega->format('d-m-Y') }}</td>
                                <td>{{ $recepcion->uel }}</td>
                                <td>{{ $recepcion->cantidad }}</td>
                                <td>{{ $recepcion->marca }}</td>
                                <td>{{ $recepcion->serie }}</td>
                                <td>{{ $recepcion->fechaVencimiento->format('d-m-Y') }}</td>
                                <td>
                                    <div class="btn-group">

                                        <button class="btn btn-danger btnEliminarRecepcion" data="{{ $recepcion->id }}" type="button"><i class="fa fa-times"></i></button>
                
                                    </div>  
                                </td>
                            
                            </tr>
                        
                        @endforeach
                
                    </tbody>

                </table>

            </form>

            
            <form style="display:none" id="formEliminarRecepcion" 
            action=""
            method="POST">

                @csrf
                @method('DELETE')
            </form>                            

        </div>

    </div>

@endsection

@section('js')

    @if(session('carga') == 'ok')

        <script>
            Swal.fire(
            'Recepción Cargadda',
            'Ha sido cargada correctamente',
            'success'
            )
        </script>

    @endif

    @if(session('eliminar') == 'ok')

        <script>
            Swal.fire(
            'Recepción Eliminada',
            'Ha sido eliminada correctamente',
            'success'
            )
        </script>

    @endif


    <script>

        const inputReception = ()=>{

            let tr = document.createElement('TR')

            let td1 = document.createElement('TD')
            let td2 = document.createElement('TD')
            let td3 = document.createElement('TD')
            let td4 = document.createElement('TD')
            let td5 = document.createElement('TD')
            let td6 = document.createElement('TD')
            let td7 = document.createElement('TD')

            let inputFechaEntrega = document.createElement('INPUT')
            inputFechaEntrega.setAttribute('required','required')
            inputFechaEntrega.setAttribute('class','form-control')

            let inputUel = inputFechaEntrega.cloneNode(true)

            let inputCantidad =  inputFechaEntrega.cloneNode(true) 
                
            let inputMarca =  document.createElement('SELECT') 
            inputMarca.setAttribute('required','required')
            inputMarca.setAttribute('class','form-control')
            inputMarca.setAttribute('name','marca')

            let opt = document.createElement('OPTION')

            opt.setAttribute('value','')
            opt.innerText = 'Seleccionar Marca'

            inputMarca.appendChild(opt)

            let marcas = '{{ $marcasVacunas }}'
            marcas = marcas.trim().split(',') 

            marcas.forEach(marca => {

                let optMarca = opt.cloneNode(true)
                optMarca.setAttribute('value',marca)
                optMarca.innerText = marca
                inputMarca.appendChild(optMarca)

            });


            inputFechaEntrega.setAttribute('type','date')
            let inputFechaVencimiento = inputFechaEntrega.cloneNode(true)

            inputFechaEntrega.setAttribute('name','fechaEntrega')
            td1.appendChild(inputFechaEntrega)
            inputFechaVencimiento.setAttribute('name','fechaVencimiento')

            td6.appendChild(inputFechaVencimiento)


            inputUel.setAttribute('type','text')
            let inputSerie = inputUel.cloneNode(true)

            inputUel.setAttribute('name','uel')
            inputUel.setAttribute('value','{{ $uel }}')
            inputUel.setAttribute('readOnly','readOnly')
            td2.appendChild(inputUel)

            inputSerie.setAttribute('type','text')
            inputSerie.setAttribute('name','serie')
            td5.appendChild(inputSerie)

            inputCantidad.setAttribute('type','number')
            inputCantidad.setAttribute('name','cantidad')
            td3.appendChild(inputCantidad)

            inputMarca.setAttribute('name','marca')
            td4.appendChild(inputMarca)
  
            tr.appendChild(td1)
            tr.appendChild(td2)
            tr.appendChild(td3)
            tr.appendChild(td4)
            tr.appendChild(td5)
            tr.appendChild(td6)

            let btnAgregar = document.createElement('BUTTON')
            btnAgregar.setAttribute('class','btn btn-primary')
            btnAgregar.setAttribute('type','submit')
            btnAgregar.textContent = 'Cargar'
            td7.appendChild(btnAgregar)
            tr.appendChild(td7)

            return tr

        }

        let inputCarga = inputReception()

        $('#tbodyReceptions').prepend(inputCarga)

        $('.btnEliminarRecepcion').on('click',function(){


            Swal.fire({
                title: 'Eliminar Recepción?',
                text: "Si no estas seguro, puedes cancerlar esta accion!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                }).then((result) => {

                    if (result.value) {
                        let id = $(this).attr('data')
                        $('#formEliminarRecepcion').attr('action',`receptions/${id}`)
                        $('#formEliminarRecepcion').submit()
                    }

                })

        })

    </script>

@endsection