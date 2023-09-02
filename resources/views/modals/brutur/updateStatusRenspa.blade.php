<div id="modalRenspaStatusSanitario" class="modal fade" role="dialog">
  
    <div class="modal-dialog modal-xs">
  
        <div class="modal-content">
  
            <form 
            action=""
            method="get" 
            class="formRenspaStatusSanitario">
        
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
        
                <div class="modal-header" style="background:#3c8dbc; color:white">
            
                    <h4 class="modal-title">Actualizar Satus Sanitario Bru-Tur</h4>
                    
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

                                            <input type="text" class="form-control form-control-lg" id="renspaStatusSanitario" value="{{$preRenspa}}">

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

                    <button type="submit" id="btnStatusSanitario" class="btn btn-primary">Actualizar Status</button>
                
                </div>

            </form>

        </div>

    </div>

</div>
