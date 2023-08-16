<div id="modalNuevoVeterinario" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
    
            <h4 class="modal-title">Nuevo Veterinario</h4>
            
            <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        
        <div class="modal-body">

          <div class="box-body">

            <div class="row">

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Nombre</label>
                    
                        <div class="input-group-prepend">

                            <div class="input-group">
                            
                                <span class="input-group-text"><i class="fa fa-user"></i></span> 

                                <input type="text" class="form-control form-control-lg" name="nombre" placeholder="Nombre" required>

                            </div>


                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Matricula</label>
                    
                        <div class="input-group-prepend">

                            <div class="input-group">
                            
                                <span class="input-group-text"><i class="fa fa-id-card-alt"></i></span> 

                                <input type="text" class="form-control form-control-lg" name="matricula" placeholder="Matricula" required>

                            </div>


                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Domicilio</label>

                        <div class="input-group-prepend">

                            <div class="input-group">
                            
                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span> 

                                <input type="text" class="form-control form-control-lg" name="domicilio" placeholder="Domicilio" required>

                            </div>


                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Telefono</label>
                    
                        <div class="input-group-prepend">

                            <div class="input-group">
                            
                                <span class="input-group-text"><i class="fa fa-phone"></i></span> 

                                <input type="text" class="form-control form-control-lg" name="telefono" placeholder="Telefono" required>

                            </div>


                        </div>

                    </div>
                
                </div>
            
            </div>
            
            <div class="row">

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>E-mail</label>
                    
                        <div class="input-group-prepend">

                            <div class="input-group">
                            
                                <span class="input-group-text"><i class="fa fa-at"></i></span> 

                                <input type="text" class="form-control form-control-lg" name="email" placeholder="E-mail">

                            </div>


                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>CUIT</label>
                    
                        <div class="input-group-prepend">

                            <div class="input-group">
                            
                                <span class="input-group-text"><i class="fa fa-credit-card"></i></span> 

                                <input type="text" class="form-control form-control-lg" name="cuit" placeholder="CUIT">

                            </div>


                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Tipo</label>
                    
                        <div class="input-group-prepend">

                            <div class="input-group">
                            
                                <span class="input-group-text"><i class="fa fa-list-ul"></i></span> 

                                <select name="tipo" id="tipo" class="form-control form-control-lg" required>

                                    <option value="Veterinario">Veterinario</option>
                                    
                                    <option value="Idóneo">Id&oacute;neo</option>
                                    
                                </select>

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

          <button type="submit" class="btn btn-primary">Cargar Veterinario</button>

        </div>

      </form>

    </div>

  </div>

</div>