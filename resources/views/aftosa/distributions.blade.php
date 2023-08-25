@extends('adminlte::page')

@section('title', 'Distribución')


@section('content')

    <div class="box pt-3">

        <div class="box">

            <div class="box-header with-border">
              
              <div class="row">
    
                <div class="col-lg-3">
      
                  <div class="form-group">
          
                      <label>Seleccionar Vacunador</label>
                      
                      <div class="input-group">
                                    
                          <select id="vacunador" class="form-control">
          
                            <option value="">Seleccionar Vacunador</option>

                            @foreach ($vacunadores as $vacunador)
                            
                                <option value="{{ $vacunador->matricula }}">{{$vacunador->nombre}}</option>
                                
                            @endforeach
                            
                          </select>
          
                          <span class="input-group-btn">
                          
                            <button type="button" class="btn btn-success btn-flat" id="cargarDistribuciones"><i class="fa fa-check"></i></button>
                            
                          </span>
          
                      </div>
          
                  </div>
    
                </div>
              
            </div>
    
        </div>

        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            
            <thead>
            
                <tr>

                    <th>Matricula</th>

                    <th>U.E.L</th>

                    <th>Cantidad</th>

                    <th>Marca</th>

                    <th>Serie</th>

                    <th>Fecha Vencimiento</th>

                    <th></th>

                </tr> 

            </thead>

            <tbody>

            </tbody>

            </table>

        </div>

    </div>

@endsection