
@extends('modals/layout',[
    'idModal'=>'modalEditarProductor',
    'title'=>'Nuevo Productor/Establecimiento',
    'action'=>'producers.update',
])

@section('modal')

            <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                        <label for="renspaEdit">RENSPA</label>

                        <div class="input-group">

                            <div class="input-group-prepend">

                                <span class="input-group-text"><i class="fa fa-barcode"></i></span>

                            </div>

                            <input type="hidden" name="idEdit" id="idEdit">

                            <input type="text" class="form-control form-control-lg" name="renspaEdit" id="renspaEdit" required>

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

                            <input type="text" class="form-control form-control-lg" name="propietarioEdit" id="propietarioEdit" placeholder="Propietario" required>

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

                            <input type="text" class="form-control form-control-lg" name="establecimientoEdit" id="establecimientoEdit" placeholder="Establecimiento" required>

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
    
                            <select name="tipoExplotacionEdit" id="tipoExplotacionEdit" id="tipoExplotacion" class="form-control form-control-lg" required>
                            
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

                            <select name="regimenEdit" id="regimenEdit" id="regimen" class="form-control form-control-lg" required>
                            
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

                            <select name="tipoDocEdit" id="tipoDocEdit" id="tipoDoc" class="form-control form-control-lg" required>
                            
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
    
                            <input type="text" class="form-control form-control-lg" name="numDocEdit" id="numDocEdit" placeholder="N° Documento" required>
    
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
    
                            <select name="ivaEdit" id="ivaEdit" id="iva" class="form-control form-control-lg" required>
                            
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

                            <input type="text" class="form-control form-control-lg" name="telefonoEdit" id="telefonoEdit" placeholder="Telefono">

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

                            <input type="text" class="form-control form-control-lg" name="mailEdit" id="mailEdit" placeholder="E-mail">

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
    
                            <input type="text" class="form-control form-control-lg" name="domicilioEdit" id="domicilioEdit" placeholder="Domicilio" required>
    
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
    
                            <input type="text" class="form-control form-control-lg" name="localidadEdit" id="localidadEdit" placeholder="Localidad" required>
    
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
                            
                            <input type="text" class="form-control form-control-lg" name="provinciaEdit" id="provinciaEdit" placeholder="Provincia" required>

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

                            <input type="text" class="form-control form-control-lg" name="departamentoEdit" id="departamentoEdit" value="" readonly>

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
                            
                            <select name="distritoEdit" id="distritoEdit"  class="form-control form-control-lg" required>
                            
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
                            
                                <select name="veterinarioEdit" id="veterinarioEdit" class="form-control form-control-lg" required>
                            
                            </select>

                        </div>

                    </div>
                
                </div>
            
            </div>

@endsection

@section('submit')
    <button type="submit" class="btn btn-primary">Modificar Productor</button>
@endsection