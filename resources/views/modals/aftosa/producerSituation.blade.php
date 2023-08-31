<div id="modalRenspaSituacionProductor" class="modal fade" role="dialog">
  
    <div class="modal-dialog modal-xs">
  
        <div class="modal-content">
  
            <form 
            role="form" 
            action="{{ route('aftosa.situacionProductor') }}"
            method="post" 
            class="formSituacionProductor"
            target="_blank">
    
                @csrf
    
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
        
                <div class="modal-header" style="background:#3c8dbc; color:white">
            
                    <h4 class="modal-title">Situación Productor</h4>
                    
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

                                            <input type="text" class="form-control form-control-lg @error('renspa') is-invalid @enderror" name="renspa" value="{{ $preRenspa }}" size="17" required>
                                            
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

                    <button type="submit" class="btn btn-primary">Generar Certificado</button>
                
                </div>

            </form>

        </div>

    </div>

</div>
