<div id="modalCampaign" class="modal fade" role="dialog">
    
    <div class="modal-dialog modal-xs">
        
            <div class="modal-content">
            
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
            
                    <h4 class="modal-title">Seleccionar Campa&ntilde;a</h4>
                    
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
                
                                    <label>Campa&ntilde;a Aftosa</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-list-ul"></i></span> 

                                        </div>
                
                                        <select name="campaignSelected" id="campaignSelected" class="form-control form-control-lg" required>

                                            @foreach ($campaigns as $campaign)
                                                <option value="{{ $campaign->numero }}">Campa&ntilde;a Nº{{ $campaign->numero }}</option>
                                            @endforeach
                                        </select>
                
                                    </div>
                
                                </div>
                            
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-block" type="button" id="btnNuevaCampania">Nueva Campa&ntilde;a</button>
                            </div>
                        </div>

                        <form action="/campaign" id="formNewCampaign" method="POST" style="display:none">
                            @csrf
                            <hr>
                            <div class="row">
    
                                <div class="col-md-6">
    
                                    <div class="form-group">
                                    
                                        <label>Campa&ntilde;a</label>

                                        <div class="input-group">

                                            <div class="input-group-prepend">
        
                                                <span class="input-group-text">N°</span> 

                                            </div>

                                            <input type="numero" name="numero" class="form-control" required>

                                        </div>
    
                                    </div>    
    
                                </div>
    
                                <div class="col-md-6">
                                    <br>
                                    <button type="submit" class="btn btn-success mt-2">Crear</button>
    
                                </div>
    
                            </div>

                        </form>

                    </div>

                </div>


                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                
                <div class="modal-footer">
                        
                    <button type="submit" id="btnAssignCampaign" class="btn btn-primary btn-block">Asignar Campa&ntilde;a</button>
                
                </div>

            </div>
       
    </div>

</div>

