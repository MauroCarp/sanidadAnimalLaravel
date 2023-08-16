@extends('modals/layout',['idModal'=>'modalNuevoProductor','seccion'=>'Productor'])

@section('modal')

    <div class="row">

        <div class="col-md-3">
    
            <div class="form-group">

                <label>RENSPA</label>
            
                <div class="input-group">
                
                    <div class="input-group-prepend">

                        <span class="input-group-text"><i class="fa fa-barcode"></i></span> 

                    </div>

                    <input type="text" class="form-control form-control-lg" name="renspa" value="{{ $preRenspa }}" required>

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

                    <input type="text" class="form-control form-control-lg" name="propietario" placeholder="Propietario" required>

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

                    <input type="text" class="form-control form-control-lg" name="establecimiento" placeholder="Establecimiento" required>

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

                    <select name="tipoExplotacion" id="tipoExplotacion" class="form-control form-control-lg" required>

                        
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

                    <select name="regimen" id="regimen" class="form-control form-control-lg" required>

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

                    <select name="tipoDoc" id="tipoDoc" class="form-control form-control-lg" required>

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

                    <input type="text" class="form-control form-control-lg" name="numDoc" placeholder="N° Documento" required>

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

                    <select name="iva" id="iva" class="form-control form-control-lg" required>

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

                    <input type="text" class="form-control form-control-lg" name="telefono" placeholder="Telefono" required>

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

                    <input type="text" class="form-control form-control-lg" name="mail" placeholder="E-mail">

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

                    <input type="text" class="form-control form-control-lg" name="domicilio" placeholder="Domicilio" required>

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

                    <input type="text" class="form-control form-control-lg" name="localidad" placeholder="Localidad" required>

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

                    <span class="input-group-text"> <i class="fa fa-map-marker"></i></span> 

                                                </div>

                    <input type="text" class="form-control form-control-lg" name="provincia" placeholder="Provincia" required>


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

                    <input type="text" class="form-control form-control-lg" name="departamento" value="" readonly>

                </div>

            </div>
        
        </div>

        <div class="col-md-3">
    
            <div class="form-group">

                <label>Distrito</label>

                <div class="input-group">
                
                    <div class="input-group-prepend">

                    <span class="input-group-text"> <i class="fa fa-map-marker"></i></span> 

                                                </div>

                    <select name="distrito" id="distrito" class="form-control form-control-lg" required>

                    </select>

                </div>

            </div>
        
        </div>
        
        <div class="col-md-3">

            <div class="form-group">

                <label>Veterinario</label>

                <div class="input-group">
                
                    <div class="input-group-prepend">

                    <span class="input-group-text"> <i class="fa fa-map-marker"></i></span> 

                                                </div>

                        <select name="veterinario" id="veterinario" class="form-control form-control-lg" required>
                    
                    </select>

                </div>

            </div>

        </div>

    </div>

@endsection