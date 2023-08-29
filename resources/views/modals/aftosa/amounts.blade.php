<div id="modalMonto" class="modal fade" role="dialog">
  
    <div class="modal-dialog modal-xs">
  
        <div class="modal-content">
  
            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->
    
            <div class="modal-header" style="background:#3c8dbc; color:white">
        
                <h4 class="modal-title">Montos</h4>
                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
    
            </div>
    
            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->
            
            <div class="modal-body">
    
                <div class="box-body">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Redondeo Aftosa</label>
                            
                                <input type="number" class="form-control" step="0.01" name="redondeoAf" value="{{$acta['redondeoAf'] ?? 0}}" >

                            </div>
                        
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Redondeo Carbunclo</label>
                            
                                <input type="number" class="form-control" step="0.01" name="redondeoCar" value="{{$acta['redondeoCar'] ?? 0}}" >

                            </div>
                        
                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>
