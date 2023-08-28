<div id="modalVeterinario" class="modal fade" role="dialog">
    
    <div class="modal-dialog modal-xs">
        
            <div class="modal-content">
            
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
            
                    <h4 class="modal-title">Detalle Animales vacunados por vacunador</h4>
                    
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <form id="formVeterinario" action="" method="post" target="_blank">
                    @csrf
                    <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                    <div class="modal-body">
    
                        <div class="box-body">
    
                            <div class="row">
    
                                <div class="col-md-12">
                            
                                    <div class="form-group">
                    
                                        <label>Veterinario</label>
                                    
                                        <div class="input-group">
    
                                            <div class="input-group-prepend">
    
                                                <span class="input-group-text"><i class="fa fa-list-ul"></i></span> 
    
                                            </div>
                                            <input type="hidden" name="type" id="type">
                                            <select name="selectVeterinario" id="selectVeterinario" class="form-control form-control-lg" required>
    
                                                @foreach ($vets as $vet)
                                                    <option value="{{ $vet->matricula }}">{{ $vet->nombre }}</option>
                                                @endforeach

                                            </select>
                    
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
                            
                        <button type="submit" class="btn btn-primary btn-block">Informe</button>
                    
                    </div>

                </form>

            </div>
       
    </div>

</div>

