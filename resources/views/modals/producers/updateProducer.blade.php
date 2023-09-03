<div id="modalEditarProductor" class="modal fade" role="dialog">
    
    <div class="modal-dialog modal-lg">
        
        
        <form 
            role="form" 
            action="/producers"
            method="post" 
            id="formEditarProductor">

            @csrf

            @method('PATCH')

            <div class="modal-content">
            
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
            
                    <h4 class="modal-title">Modificar Productor</h4>
                    
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

                                    <label for="renspa">RENSPA</label>

                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-barcode"></i></span>

                                        </div>

                                        <input type="text" class="form-control form-control-lg" name="renspa" id="renspa" readonly required>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3">
                        
                                <div class="form-group">

                                    <label>Propietario</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-user"></i></span> 

                                        </div>

                                        <input type="text" class="form-control form-control-lg" name="propietario" id="propietario" placeholder="Propietario" required>

                                    </div>

                                </div>
                            
                            </div>

                            <div class="col-md-3">
                        
                                <div class="form-group">

                                    <label>Establecimiento</label>

                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-home"></i></span> 

                                        </div>

                                        <input type="text" class="form-control form-control-lg" name="establecimiento" id="establecimiento" placeholder="Establecimiento" required>

                                    </div>

                                </div>
                            
                            </div>

                            <div class="col-md-3">
                        
                                <div class="form-group">
                
                                    <label>Tipo Explotaci&oacute;n</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-list-ul"></i></span> 

                                        </div>
                
                                        <select name="explotacion" id="explotacion" id="explotacion" class="form-control form-control-lg" required>
                                        
                                            <option value="Cabaña">Cabaña</option>
                        
                                            <option value="CIA">CIA</option>
                                            
                                            <option value="Cria">Cria</option>
                                            
                                            <option value="Cria/Invernada">Cria / Invernada</option>
                                            
                                            <option value="Feedlot">Feedlot</option>
                                            
                                            <option value="U.P Feedlot">U.P Feedlot</option>

                                        </select>
                
                                    </div>
                
                                </div>
                            
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                        
                                <div class="form-group">

                                    <label>Regimen</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-list-ul"></i></span> 

                                        </div>

                                        <select name="regimen" id="regimen" id="regimen" class="form-control form-control-lg" required>

                                            <option value="Arrendatario">Arrendatario</option>
                        
                                            <option value="Capitalizacion">Capitalizacion</option>
                                            
                                            <option value="Pastajero">Pastajero</option>
                                                                            
                                            <option value="Propietario">Propietario</option>

                                        </select>

                                    </div>

                                </div>
                            
                            </div>

                            <div class="col-md-3">
                        
                                <div class="form-group">

                                    <label>Tipo Doc.</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-address-card"></i></span> 

                                        </div>

                                        <select name="tipoDoc" id="tipoDoc" id="tipoDoc" class="form-control form-control-lg" required>
                                        
                                            <option value="DNI">DNI</option>
                        
                                            <option value="CUIL">CUIL</option>
                                            
                                            <option value="CUIT">CUIT</option>

                                        </select>

                                    </div>

                                </div>
                            
                            </div>
                        
                            <div class="col-md-3">
                        
                                <div class="form-group">
                
                                    <label>N° Documento</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-user"></i></span> 

                                        </div>
                
                                        <input type="text" class="form-control form-control-lg" name="numDoc" id="numDoc" placeholder="N° Documento" required>
                
                                    </div>
                
                                </div>
                            
                            </div>

                            <div class="col-md-3">
                        
                                <div class="form-group">
                
                                    <label>IVA</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-list-ul"></i></span> 

                                        </div>
                
                                        <select name="iva" id="iva" id="iva" class="form-control form-control-lg" required>

                                            <option value="RI">Responsable Inscripto</option>
                            
                                            <option value="MT">Responsable Monotributo</option>
                                            
                                            <option value="EX">Exento</option>

                                            <option value="CF">Consumidor Final</option>

                                        </select>
                
                                    </div>
                
                                </div>
                            
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                        
                                <div class="form-group">

                                    <label>Telefono</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-phone"></i></span> 

                                        </div>

                                        <input type="text" class="form-control form-control-lg" name="telefono" id="telefono" placeholder="Telefono">

                                    </div>

                                </div>
                            
                            </div>

                            <div class="col-md-3">
                        
                                <div class="form-group">

                                    <label>E-mail</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-at"></i></span> 

                                        </div>

                                        <input type="text" class="form-control form-control-lg" name="email" id="email" placeholder="E-mail">

                                    </div>

                                </div>
                            
                            </div>
                            
                            <div class="col-md-3">
                        
                                <div class="form-group">
                
                                    <label>Domicilio</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span> 

                                        </div>
                
                                        <input type="text" class="form-control form-control-lg" name="domicilio" id="domicilio" placeholder="Domicilio" required>
                
                                    </div>
                
                                </div>
                            
                            </div>
                
                            <div class="col-md-3">
                        
                                <div class="form-group">
                
                                    <label>Localidad</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span> 

                                        </div>
                
                                        <input type="text" class="form-control form-control-lg" name="localidad" id="localidad" placeholder="Localidad" required>
                
                                    </div>
                
                                </div>
                            
                            </div>
                            
                        </div>
                        
                        <div class="row">

                            <div class="col-md-3">
                        
                                <div class="form-group">

                                    <label>Provincia</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span> 

                                        </div>
                                        
                                        <input type="text" class="form-control form-control-lg" name="provincia" id="provincia" placeholder="Provincia" required>

                                    </div>

                                </div>
                            
                            </div>

                            <div class="col-md-3">
                        
                                <div class="form-group">

                                    <label>Departamento</label>
                                
                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span> 

                                        </div>

                                        <input type="text" class="form-control form-control-lg" name="departamento" id="departamento" value="" readonly>

                                    </div>

                                </div>
                            
                            </div>

                            <div class="col-md-3">
                        
                                <div class="form-group">
                
                                    <label>Distrito</label>

                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span> 

                                        </div>
                                        
                                        <select name="distrito_id" id="distrito_id"  class="form-control form-control-lg" required>

                                            @foreach ($distritos as $distrito)
                            
                                            <option value="{{ $distrito->key }}">{{ $distrito->name }}</option>
                
                                            @endforeach

                                        </select>

                                    </div>

                                </div>
                            
                            </div>

                            <div class="col-md-3">
                        
                                <div class="form-group">
                
                                    <label>Veterinario</label>

                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span> 

                                        </div>
                                        
                                            <select name="veterinario" id="veterinario" class="form-control form-control-lg" required>

                                                @foreach ($vacunadores as $vacunador)
                        
                                                <option value="{{ $vacunador->matricula }}"> {{ $vacunador->nombre }} </option>
                    
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
                        
                    <button type="submit" class="btn btn-primary">Modificar Productor</button>
                
                </div>

            </div>

        </form>
       
    </div>

</div>

