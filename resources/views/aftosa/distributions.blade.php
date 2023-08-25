@extends('adminlte::page')

@section('title', 'Distribución')

@section('content')

    <div class="box pt-3">

        <div class="box">

            <div class="box-header with-border">
              
              <div class="row">
    
                <div class="col-lg-3">
      
                    <div class="form-group">

                        <form action="{{ route('distributions.showDistributions') }}" method="post" id="formVacunador">
                            @csrf
                            <label>Seleccionar Vacunador</label>
                            
                            <div class="input-group">
                                    
                                <select name="vacunador" id="vacunador" class="form-control">
                
                                    <option value="">Seleccionar Vacunador</option>

                                    @foreach ($vacunadores as $vacunador)
                                    
                                        <option value="{{ $vacunador->matricula }}">{{$vacunador->nombre}}</option>
                                        
                                    @endforeach

                                </select>
                        </form>

                        <span class="input-group-btn">
                        
                        <button type="button" class="btn btn-success btn-flat" id="cargarDistribuciones"><i class="fa fa-check"></i></button>
                        
                        </span>
            
                        </div>
          
                    </div>
    
                </div>
              
            </div>
    
        </div>

        <div class="box-body">
            
            <form action="{{ route('distributions.store') }}" method="post">
                @csrf
                <table class="table table-bordered table-striped dt-responsive tablas" id="tableDistributions" width="100%">
                    
                    <thead>
                    
                        <tr>

                            <th>Matricula</th>

                            <th>U.E.L</th>

                            <th>Marca</th>
                            
                            <th>Cantidad</th>

                            <th>Fecha Entrega</th>

                            <th></th>

                        </tr> 

                    </thead>

                    <tbody>
                    </tbody>

                </table>

            </form>

            <form style="display:none" id="formEliminarDistribucion" 
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
            'Distribución Cargadda',
            'Ha sido cargada correctamente',
            'success'
            )

            $('#vacunador').val("{{ session('matricula') }}")
            setTimeout(() => {
                $('#cargarDistribuciones').trigger('click')
            }, 500);
        </script>

    @endif

    @if(session('eliminar') == 'ok')

        <script>
            Swal.fire(
            'Distribución Eliminada',
            'Ha sido eliminada correctamente',
            'success'
            )

            $('#vacunador').val("{{ session('matricula') }}")
            setTimeout(() => {
                
                $('#cargarDistribuciones').trigger('click')
            }, 500);
        </script>

    @endif

    <script>

        $('#cargarDistribuciones').on('click',()=>{
            
            $.ajax({
                url:"{{ route('distributions.showDistributions') }}",
                method:'POST',
                data:$('#formVacunador').serialize()
            })
            .done(function(resp){

                let datosArrays = resp.map(function(distribucion) {

                    let btnEliminar = `<button class="btn btn-danger btnEliminarDistribucion" data="${distribucion.id}" type="button"><i class="fa fa-times"></i></button>`
                    
                    let fechaEntrega = new Date(distribucion.fechaEntrega);
                    fechaEntrega = `${fechaEntrega.getDate().toString().padStart(2, '0')}-${(fechaEntrega.getMonth() + 1).toString().padStart(2, '0')}-${fechaEntrega.getFullYear()}`

                    return [distribucion.matricula, distribucion.uel, distribucion.marca,distribucion.cantidad,fechaEntrega,btnEliminar];
                });

                let inputMatricula = `<input type="text" class="form-control" name="matricula" value="${$('#vacunador').val()}" readOnly />`
                let inputUel = `<input type="text" class="form-control" name="uel" value="{{ $uel }}" readOnly />`
                let selectMarca = `<select name="marca" class="form-control" required>`
                
                let marcas = '{{ $marcasVacunas }}'

                marcas = marcas.trim().split(',') 
                marcas.forEach(marca => {

                    selectMarca += `<option value="${marca}">${marca}</option>`

                });

                selectMarca += '</select>'

                let inputCantidad = `<input type="number" class="form-control" name="cantidad" required />`
                let inputFechaEntrega = `<input type="date" class="form-control" name="fechaEntrega" required />`
                let btnCargar = `<button type="submit" class="btn btn-primary" name="btnCargarDistribucion">Cargar</button>`

                datosArrays.push([
                    inputMatricula,
                    inputUel,
                    selectMarca,
                    inputCantidad,
                    inputFechaEntrega,
                    btnCargar
                ])

                $('#tableDistributions').DataTable().clear().rows.add(datosArrays).draw();

            })

        })

        $('.tablas').on('click','.btnEliminarDistribucion',function(){

            let id = $(this).attr('data')

            Swal.fire({
                title: 'Eliminar Distribución?',
                text: "Si no estas seguro, puedes cancerlar esta accion!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                }).then((result) => {

                    if (result.value) {
                        let id = $(this).attr('data')
                        $('#formEliminarDistribucion').attr('action',`distributions/${id}`)
                        $('#formEliminarDistribucion').submit()
                    }

                })

        })

    </script>

@endsection