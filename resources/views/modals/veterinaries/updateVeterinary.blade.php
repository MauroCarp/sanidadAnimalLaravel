<div id="modalEditarVeterinario" class="modal fade" role="dialog">
    
    <div class="modal-dialog modal-lg">
        
        
        <form 
            role="form" 
            action="/veterinaries"
            method="post" 
            id="formEditarVeterinario"
            class="formEditarVeterinario">

            @csrf

            @method('PATCH')

            <div class="modal-content">
            
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
            
                    <h4 class="modal-title">Modificar Veterinario</h4>
                    
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                
                <div class="modal-body">

                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Nombre</label>
                                
                                    <div class="input-group-prepend">

                                        <div class="input-group">
                                        
                                            <span class="input-group-text"><i class="fa fa-user"></i></span> 

                                            <input type="text" class="form-control form-control-lg  @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" name="nombre" placeholder="Nombre" required>

                                            <input type="hidden" name="formType" value="updateVet">
                                            <input type="hidden" name="id" value="{{ old('id') }}">

                                        </div>


                                    </div>

                                    <small class="errors" id="errorNombre"></small>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Matricula</label>
                                
                                    <div class="input-group-prepend">

                                        <div class="input-group">
                                        
                                            <span class="input-group-text"><i class="fa fa-id-card-alt"></i></span> 

                                            <input type="text" class="form-control form-control-lg  @error('matricula') is-invalid @enderror" value="{{ old('matricula') }}" name="matricula" placeholder="Matricula" required>

                                        </div>


                                    </div>

                                    <small class="errors" id="errorMatricula"></small>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Domicilio</label>

                                    <div class="input-group-prepend">

                                        <div class="input-group">
                                        
                                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span> 

                                            <input type="text" class="form-control form-control-lg  @error('domicilio') is-invalid @enderror" value="{{ old('domicilio') }}" name="domicilio" placeholder="Domicilio" required>

                                        </div>


                                    </div>

                                    <small class="errors" id="errorDomicilio"></small>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Telefono</label>
                                
                                    <div class="input-group-prepend">

                                        <div class="input-group">
                                        
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span> 

                                            <input type="text" class="form-control form-control-lg  @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" name="telefono" placeholder="Telefono" required>

                                        </div>


                                    </div>

                                    <small class="errors" id="errorTelefono"></small>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>E-mail</label>
                                
                                    <div class="input-group-prepend">

                                        <div class="input-group">
                                        
                                            <span class="input-group-text"><i class="fa fa-at"></i></span> 

                                            <input type="text" class="form-control form-control-lg  @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="E-mail" required>

                                        </div>


                                    </div>

                                    <small class="errors" id="errorE"></small>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>CUIT</label>
                                
                                    <div class="input-group-prepend">

                                        <div class="input-group">
                                        
                                            <span class="input-group-text"><i class="fa fa-credit-card"></i></span> 

                                            <input type="text" class="form-control form-control-lg  @error('cuit') is-invalid @enderror" value="{{ old('cuit') }}" name="cuit" placeholder="CUIT" required>

                                        </div>


                                    </div>

                                    <small class="errors" id="errorCuit"></small>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Tipo</label>
                                
                                    <div class="input-group-prepend">

                                        <div class="input-group">
                                        
                                            <span class="input-group-text"><i class="fa fa-list-ul"></i></span> 

                                            <select name="tipo" id="tipo" class="form-control form-control-lg  @error('tipo') is-invalid @enderror" value="{{ old('tipo') }}" required>

                                                <option value="Veterinario">Veterinario</option>
                                                
                                                <option value="Idóneo">Id&oacute;neo</option>
                                                
                                            </select>

                                        </div>


                                    </div>

                                    <small class="errors" id="errorTipo"></small>

                                </div>

                            </div>

                        </div>

                    </div>


                </div>


                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                
                <div class="modal-footer">
                        
                    <button type="submit" class="btn btn-primary">Modificar Vacunador</button>
                
                </div>

            </div>

        </form>
       
    </div>

</div>
