<div id="modalRenspaActa" class="modal fade" role="dialog">
  
    <div class="modal-dialog modal-xs">
  
        <div class="modal-content">
  
            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->
    
            <div class="modal-header" style="background:#3c8dbc; color:white">
        
                <h4 class="modal-title">Cargar Acta</h4>
                
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

                                <label>Renspa</label>
                            
                                <div class="input-group-prepend">

                                    <div class="input-group">
                                    
                                        <span class="input-group-text"><i class="fa fa-barcode"></i></span> 

                                        <input type="text" class="form-control form-control-lg" id="renspaActa" value="{{ $preRenspa }}" size="17" minlength="17" maxlength="17" required>
                                        
                                    </div>
                                    
                                    
                                </div>

                            </div>
                        
                        </div>

                    </div>


                </div>

            </div>

            <!--=====================================
            PIE DEL MODAL
            ======================================-->

            <div class="modal-footer">

                <button type="button" id="btnBuscarActa" class="btn btn-primary">Cargar Acta</button>
            
            </div>

        </div>

    </div>

</div>
