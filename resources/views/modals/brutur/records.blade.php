<div id="modalHistorial" class="modal fade" role="dialog">
  
    <div class="modal-dialog modal-lg modal-records">
  
        <div class="modal-content">
        
            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->
    
            <div class="modal-header" style="background:#3c8dbc; color:white">
        
                <h4 class="modal-title">Historial de Registros <span id="titleCampaign"></span></h4>
                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
    
            </div>
    
            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->
            
            <div class="modal-body">
    
                <div class="box-body">

                    <table class="table-sm table-striped" id="brucelosisRecords" style="width:100%;display:none">
                        <thead>
                            <th>Fecha de Muestra</th>
                            <th>Protocolo</th>
                            <th>Estado</th>
                            <th>Cant. Muestras</th>
                            <th>Saneamiento Nº</th>
                            <th><i class="fa fa-plus-square"></i></th>
                            <th><i class="fa fa-minus-square"></i></th>
                            <th>Sospechosos</th>
                            <th></th>
                        </thead>
                        <tbody>

                            @foreach ($registrosBrucelosis as $registro)
                                
                                <tr>

                                    <td>{{date('d-m-Y',strtotime($registro->fechaEstado))}}</td>
                                    <td>{{$registro->protocolo}}</td>
                                    <td>{{$registro->estado}}</td>
                                    <td>{{$registro->total}}</td>
                                    <td>{{$registro->saneamiento}}</td>
                                    <td>{{$registro->positivo}}</td>
                                    <td>{{$registro->negativo}}</td>
                                    <td>{{$registro->sospechoso}}</td>
                                    <td>
                                        <button class="btn btn-danger btnEliminarRegistro" type="submit" data-destroy="{{$registro->id}}"><i class="fa fa-times"></i></button>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>
                    </table>

                    <table class="table-sm table-striped" id="tuberculosisRecords" style="width:100%;">
                        <thead>
                            <th>Fecha de Muestra</th>
                            <th>Protocolo</th>
                            <th>Estado</th>
                            <th>Cant. Muestras</th>
                            <th>Saneamiento Nº</th>
                            <th><i class="fa fa-plus-square"></i></th>
                            <th><i class="fa fa-minus-square"></i></th>
                            <th>Sospechosos</th>
                            <th></th>
                        </thead>
                        <tbody>

                            @foreach ($registrosTuberculosis as $registro)
                                
                                <tr>

                                    <td>{{date('d-m-Y',strtotime($registro->fechaEstado))}}</td>
                                    <td>{{$registro->protocolo}}</td>
                                    <td>{{$registro->estado}}</td>
                                    <td>{{$registro->total}}</td>
                                    <td>{{$registro->saneamiento}}</td>
                                    <td>{{$registro->positivo}}</td>
                                    <td>{{$registro->negativo}}</td>
                                    <td>{{$registro->sospechoso}}</td>
                                    <td>
                                        <button class="btn btn-danger btnEliminarRegistro" type="submit" data-destroy="{{$registro->id}}"><i class="fa fa-times"></i></button>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- <!-- <form class="formEliminarRegistro" action="" method="POST">

    @csrf
    @method('DELETE')
    <input type="hidden" name="renspaRegistro">
</form>  --> --}}