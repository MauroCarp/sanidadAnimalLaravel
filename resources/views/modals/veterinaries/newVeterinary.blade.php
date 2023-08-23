@extends('modals/layout',[
    'idModal'=>'modalNuevoVeterinario',
    'title'=>'Nuevo Vacunador',
    'action'=>'veterinaries.store',
    'formClass'=>'formNuevoVeterinario'
])

@section('modal')

    <div class="row">

        <div class="col-md-6">

            <div class="form-group">

                <label>Nombre</label>
            
                <div class="input-group-prepend">

                    <div class="input-group">
                    
                        <span class="input-group-text"><i class="fa fa-user"></i></span> 

                        <input type="text" class="form-control form-control-lg @error('nombre') is-invalid @enderror" name="nombre" placeholder="Nombre" value="@if(old('formType') == 'newVet') {{ old('nombre') }}  @endif" required>
                        <input type="hidden" name="formType" value="newVet">
                        
                        
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

                        <input type="text" class="form-control form-control-lg @error('matricula') is-invalid @enderror" name="matricula" placeholder="Matricula" value="@if(old('formType') == 'newVet') {{ old('matricula') }}  @endif" required>

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

                        <input type="text" class="form-control form-control-lg @error('domicilio') is-invalid @enderror" name="domicilio" placeholder="Domicilio" value="@if(old('formType') == 'newVet') {{ old('domicilio') }}  @endif" required>

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

                        <input type="text" class="form-control form-control-lg @error('telefono') is-invalid @enderror" name="telefono" placeholder="Telefono" value="@if(old('formType') == 'newVet') {{ old('telefono') }}  @endif" required>

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

                        <input type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" placeholder="E-mail" value="@if(old('formType') == 'newVet') {{ old('email') }}  @endif" required>

                    </div>


                </div>

                <small class="errors" id="errorEmail"></small>

            </div>
        
        </div>

        <div class="col-md-6">

            <div class="form-group">

                <label>CUIT</label>
            
                <div class="input-group-prepend">

                    <div class="input-group">
                    
                        <span class="input-group-text"><i class="fa fa-credit-card"></i></span> 

                        <input type="text" class="form-control form-control-lg @error('cuit') is-invalid @enderror" name="cuit" placeholder="CUIT" value="@if(old('formType') == 'newVet') {{ old('cuit') }}  @endif" required>

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

                        <select name="tipo" id="tipo" class="form-control form-control-lg @error('tipo') is-invalid @enderror" value="@if(old('formType') == 'newVet') {{ old('tipo') }}  @endif" required>

                            <option value="Veterinario">Veterinario</option>
                            
                            <option value="Idóneo">Id&oacute;neo</option>
                            
                        </select>

                    </div>


                </div>

                <small class="errors" id="errorTipo"></small>

            </div>
        
        </div>

    </div>

@endsection

@section('submit')
    <button type="submit" class="btn btn-primary">Cargar Veterinario</button>
@endsection