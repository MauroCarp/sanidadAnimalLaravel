<div id="modalUpdateCampaign" class="modal fade" role="dialog">
    
    <div class="modal-dialog modal-lg">
        
            <div class="modal-content">
            
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
            
                    <h4 class="modal-title">Campa&ntilde;a</h4>
                    
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                
                <div class="modal-body">

                    <div class="box-body">

                        <form action="" method="post" enctype="multipart/form-data" id="formUpdateCampaign">

                            @csrf
                            @method('PATCH')

                            <div class="row">

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>N° Campa&ntilde;a</label>
                                    
                                        <div class="input-group">
                                        
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><b>N°</b></span> 
                                                
                                            </div>

                                            <input type="number" class="form-control input-lg" name="campaignNumero" id="campaignNumero" readOnly>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>Fecha Inicio</label>
                                    
                                        <div class="input-group">
                                        
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fa fa-date"></i></span> 
                                                
                                            </div>

                                            <input type="date" class="form-control input-lg" name="fechaInicio" id="fechaInicio" required>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>Fecha Cierre</label>

                                        <div class="input-group">
                                        
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fa fa-date"></i></span> 
                                                
                                            </div>

                                            <input type="date" class="form-control input-lg" name="fechaCierre" id="fechaCierre" required>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>Precio Adm. Aftosa</label>
                                    
                                        <div class="input-group">
                                        
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span> 
                                                
                                            </div>

                                            <input type="number" step="0.01" class="form-control input-lg" name="precioAdmAftosa" id="precioAdmAftosa" required>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                    <label>Precio Vacuna Aftosa</label>
                                    
                                        <div class="input-group">
                                        
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span> 
                                                
                                            </div>

                                            <input type="number" step="0.01" class="form-control input-lg" name="precioVacunaAftosa" id="precioVacunaAftosa" required>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                    <label>Precio Vet. Aftosa</label>

                                        <div class="input-group">
                                        
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span> 
                                                
                                            </div>

                                            <input type="number" step="0.01" class="form-control input-lg" name="precioVeterinarioAftosa" id="precioVeterinarioAftosa" required>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>Precio Adm. Carbunclo</label>
                                    
                                        <div class="input-group">
                                        
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span> 
                                                
                                            </div>

                                            <input type="number" step="0.01" class="form-control input-lg" name="precioAdmCarb" id="precioAdmCarb" required>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                    <label>Precio Vacuna Carbunclo</label>
                                    
                                        <div class="input-group">
                                        
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span> 
                                                
                                            </div>

                                            <input type="number" step="0.01" class="form-control input-lg" name="precioVacunaCarb" id="precioVacunaCarb" required>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                    <label>Precio Vet. Carbunclo</label>

                                        <div class="input-group">
                                        
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span> 
                                                
                                            </div>

                                            <input type="number" step="0.01" class="form-control input-lg" name="precioVeterinarioCarb" id="precioVeterinarioCarb" required>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-8">

                                    <div class="form-group">

                                        <label>Existencia Animal</label>

                                        <div class="input-group">
                                        
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="icon-COW"></i></span> 
                                                
                                            </div>

                                            <input type="file" class="form-control" name="existenciaAnimal" id="existenciaAnimal">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>


                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                
                <div class="modal-footer">
                        
                    <button class="btn btn-block btn-primary" type="submit" name="editarCampania" form="formUpdateCampaign"><b>Editar Campa&ntilde;a</b></button>
                
                </div>

            </div>
       
    </div>

</div>

