@extends('modals/layout',[
    'idModal'=>'modalNuevoProductor',
    'title'=>'Nuevo Productor',
    'action'=>'producers.store',
])


@section('modal')

    <div class="row">

        <div class="col-md-3">
    
            <div class="form-group">

                <label>RENSPA</label>
            
                <div class="input-group">
                
                    <div class="input-group-prepend">

                        <span class="input-group-text"><i class="fa fa-barcode"></i></span> 

                    </div>

                    <input type="text" class="form-control form-control-lg" name="renspa" value="{{ old('renspa') ?? $preRenspa }}" required>

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

                    <input type="text" class="form-control form-control-lg" name="propietario" placeholder="Propietario" value="{{ old('propietario') }}" required>

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

                    <input type="text" class="form-control form-control-lg" name="establecimiento" placeholder="Establecimiento" value="{{ old('establecimiento') }}" required>

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

                    <select name="explotacion" class="form-control form-control-lg" value="{{ old('explotacion') }}" required>

                        
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

                    <select name="regimen" class="form-control form-control-lg" value="{{ old('regimen') }}" required>

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

                    <select name="tipoDoc" class="form-control form-control-lg" value="{{ old('tipoDoc') }}" required>

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

                    <input type="text" class="form-control form-control-lg" name="numDoc" placeholder="N° Documento" value="{{ old('numDoc') }}" required>

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

                    <select name="iva" class="form-control form-control-lg" value="{{ old('iva') }}" required>

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

                    <input type="text" class="form-control form-control-lg" name="telefono" placeholder="Telefono" value="{{ old('telefono') }}" required>

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

                    <input type="text" class="form-control form-control-lg" name="email" placeholder="E-mail" required>

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

                    <input type="text" class="form-control form-control-lg" name="domicilio" placeholder="Domicilio" value="{{ old('domicilio') }}" required>

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

                    <input type="text" class="form-control form-control-lg" name="localidad" placeholder="Localidad" value="{{ old('localidad') }}" required>

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

                    <input type="text" class="form-control form-control-lg" name="provincia" placeholder="Provincia" value="{{ old('provincia') }}" required>


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

                    <input type="text" class="form-control form-control-lg" name="departamento" value="{{ $departamento }}" readonly>

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
                    
                    <select name="distrito_id" class="form-control form-control-lg" value="{{ old('distrito_id') }}" required>

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

                        <span class="input-group-text"> <i class="fa fa-map-marker"></i></span> 
             
                    </div>
           
                    <select name="veterinario" class="form-control form-control-lg" value="{{ old('veterinario') }}" required>
                        
                        <option value="">Seleccione Veterinario</option>
                        
                        @foreach ($vacunadores as $vacunador)
                        
                            <option value="{{ $vacunador->matricula }}"> {{ $vacunador->nombre }} </option>

                        @endforeach

                    </select>


                </div>

            </div>

        </div>

    </div>

@endsection

@section('submit')
    <button type="submit" class="btn btn-primary">Cargar Productor</button>
@endsection