<div id="modalStatusSanitario" class="modal fade" role="dialog">
  
    <div class="modal-dialog modal-lg">
  
        <div class="modal-content">
  
            <form 
            action="/brutur/updateStatus/{{str_replace('/','-',$dataEstablecimiento->renspa)}}"
            method="post" 
            class="formStatusSanitario">
                @method('PATCH')
                @csrf
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
        
                <div class="modal-header" style="background:#3c8dbc; color:white">
            
                    <h4 class="modal-title">Actualizar Satus Sanitario Bru-Tur</h4>
                    
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
        
                </div>
        
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                
                <div class="modal-body">
        
                    <div class="box-body">

                        <div class="row">
                                
                            <!-- BRUCELOSIS -->
                            
                            <div class="col-md-6"  style="border-right:solid;">

                                <h3>Brucelosis</h3>

                                <div class="row">

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Vacas</label>

                                            <input type="number" class="form-control animalesBrucelosis" id="vacasBrucelosis" name="vacasBrucelosis" value="{{$brucelosis->vacas}}">
                                        
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Vaquillonas</label>

                                            <input type="number" class="form-control animalesBrucelosis" id="vaquillonasBrucelosis" name="vaquillonasBrucelosis" value="{{$brucelosis->vaquillonas}}">
                                        
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Toros</label>
                                        
                                            <input type="number" class="form-control animalesBrucelosis" id="torosBrucelosis" name="torosBrucelosis" value="{{$brucelosis->toros}}">
                                        
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Total</label>
                                        
                                            <input type="number" class="form-control totalBrucelosis" id="totalBrucelosis" name="totalBrucelosis" readOnly>
                                        
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                
                                    <div class="col-md-12">
                                    
                                        <div class="form-group">
                                        
                                            <label>Protocolo</label>
                                        
                                            <input type="text" class="form-control" id="protocoloBrucelosis" name="protocoloBrucelosis" value="{{$brucelosis->protocolo}}">
                                        
                                        </div>
                                    
                                    </div>

                                </div>
                            
                                <div class="row">
                                
                                    <div class="col-md-12">
                                    
                                        <div class="form-group">
                                        
                                            <label>Estado</label>

                                            <select class="form-control" name="estadoBrucelosis" id="estadoBrucelosis">

                                                @foreach($estados['brucelosis'] as $estado)

                                                    <option value="{{$estado}}" @if($estado == $brucelosis->estado) selected @endif >{{$estado}}</option>

                                                @endforeach

                                            </select>

                                        </div>
                                    
                                    </div>

                                </div>
                                
                                <!-- DATOS POSITIVOS, NEGATIVOS , SOSPECHOSOS -->
                                <div class="row">


                                    <div class="col-md-3">
                                    
                                        <div class="form-group">
                                        
                                            <label>N°</label>
                                        
                                            <input type="number" class="form-control" id="saneamientoBrucelosis" name="saneamientoBrucelosis" value="{{$brucelosis->saneamiento}}">
                                        
                                        </div>
                                    
                                    </div>
                                
                                    <div class="col-md-3">
                                    
                                        <div class="form-group">
                                        
                                            <label><i class="fa fa-plus-square" style="line-height:1.5"></i></label>
                                        
                                            <input type="number" class="form-control" id="positivoBrucelosis" name="positivoBrucelosis" value="{{$brucelosis->positivo}}">
                                        
                                        </div>
                                    
                                    </div>
                                
                                    <div class="col-md-3">
                                    
                                        <div class="form-group">
                                        
                                        <label><i class="fa fa-minus-square" style="line-height:1.5"></i></label>
                                        
                                        <input type="number" class="form-control" id="negativoBrucelosis" name="negativoBrucelosis" value="{{$brucelosis->negativo}}">
                                        
                                        </div>
                                    
                                    </div>
                                
                                    <div class="col-md-3">
                                    
                                        <div class="form-group">
                                        
                                        <label>Sospechoso</label>
                                        
                                        <input type="number" class="form-control" id="sospechosoBrucelosis" name="sospechosoBrucelosis" value="{{$brucelosis->sospechoso}}">
                                        
                                        </div>
                                    
                                    </div>

                                </div>

                                <div class="row" id="inputFechaMuestraBruce">
                                
                                    <div class="col-md-12">
                                    
                                        <div class="form-group">
                                        
                                            <label>Fecha de Muestra</label>
                                        
                                            <input type="date" class="form-control" id="fechaEstadoBrucelosis" name="fechaEstadoBrucelosis" value="{{$brucelosis->fechaEstado->format('Y-m-d')}}" required>
                                        
                                        </div>
                                    
                                    </div>

                                </div>
                                
                            </div>

                            <!-- TUBERCULOSIS -->
                            
                            <div class="col-md-6">

                                <h3>Tuberculosis</h3>

                                <!-- AMIMALES -->
                                <div class="row">

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Vacas</label>
                                        
                                            <input type="number" class="form-control animalesTuberculosis" id="vacasTuberculosis" name="vacasTuberculosis" value="{{$tuberculosis->vacas}}">
                                        
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Vaquillonas</label>
                                        
                                            <input type="number" class="form-control animalesTuberculosis" id="vaquillonasTuberculosis" name="vaquillonasTuberculosis" value="{{$tuberculosis->vaquillonas}}">
                                        
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Terneros</label>
                                        
                                            <input type="number" class="form-control animalesTuberculosis" id="ternerosTuberculosis" name="ternerosTuberculosis" value="{{$tuberculosis->terneros}}">
                                        
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Terneras</label>
                                        
                                            <input type="number" class="form-control animalesTuberculosis" id="ternerasTuberculosis" name="ternerasTuberculosis" value="{{$tuberculosis->terneras}}">
                                        
                                        </div>

                                    </div>
                                    
                                </div>
                                
                                <div class="row">

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Toros</label>
                                        
                                            <input type="number" class="form-control animalesTuberculosis" id="torosTuberculosis" name="torosTuberculosis" value="{{$tuberculosis->toros}}">
                                        
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Novillos</label>
                                        
                                            <input type="number" class="form-control animalesTuberculosis" id="novillosTuberculosis" name="novillosTuberculosis" value="{{$tuberculosis->novillos}}">
                                        
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Novillitos</label>
                                        
                                            <input type="number" class="form-control animalesTuberculosis" id="novillitosTuberculosis" name="novillitosTuberculosis" value="{{$tuberculosis->novillitos}}">
                                        
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                        
                                            <label>Total</label>
                                        
                                            <input type="number" class="form-control totalTuberculosis" id="totalTuberculosis" name="totalTuberculosis" readOnly>
                                        
                                        </div>

                                    </div>
                                
                                </div>
                                
                                <!-- PROTOCOLO -->
                                <div class="row">
                                
                                    <div class="col-md-12">
                                    
                                        <div class="form-group">
                                        
                                            <label>Protocolo</label>
                                        
                                            <input type="text" class="form-control" id="protocoloTuberculosis" name="protocoloTuberculosis" value="{{$tuberculosis->protocolo}}">
                                        
                                        </div>
                                    
                                    </div>

                                </div>
                            
                                <!-- ESTADO -->
                                <div class="row">
                                
                                    <div class="col-md-12">
                                    
                                        <div class="form-group">
                                        
                                            <label>Estado</label>

                                            <select class="form-control" name="estadoTuberculosis" id="estadoTuberculosis">

                                                @foreach($estados['tuberculosis'] as $estado)

                                                    <option value="{{$estado}}" @if($estado == $tuberculosis->estado) selected @endif>{{$estado}}</option>

                                                @endforeach
                                                
                                            </select>
                                        
                                        </div>
                                    
                                    </div>

                                </div>

                                <!-- DATOS SANEAMIENTO -->
                                <div class="row" id="saneamientoInfoTuberculosis" @if($tuberculosis->estado != 'En Saneamiento')style="display:none;" @endif>

                                    <div class="col-md-3">
                                    
                                        <div class="form-group">
                                        
                                            <label>N°</label>
                                        
                                            <input type="number" class="form-control" id="saneamientoTuberculosis" name="saneamientoTuberculosis" value="{{$tuberculosis->saneamiento}}">
                                        
                                        </div>
                                    
                                    </div>
                                
                                    <div class="col-md-3">
                                    
                                        <div class="form-group">
                                        
                                            <label><i class="fa fa-plus-square" style="line-height:1.5"></i></label>
                                        
                                            <input type="number" class="form-control" id="positivoTuberculosis" name="positivoTuberculosis" value="{{$tuberculosis->positivo}}">
                                        
                                        </div>
                                    
                                    </div>
                                
                                    <div class="col-md-3">
                                    
                                        <div class="form-group">
                                        
                                            <label><i class="fa fa-minus-square" style="line-height:1.5"></i></label>
                                            
                                            <input type="number" class="form-control" id="negativoTuberculosis" name="negativoTuberculosis" value="{{$tuberculosis->negativo}}">
                                            
                                        </div>
                                    
                                    </div>
                                
                                    <div class="col-md-3">
                                    
                                        <div class="form-group">
                                        
                                        <label>Sospechoso</label>
                                        
                                        <input type="number" class="form-control" id="sospechosoTuberculosis" name="sospechosoTuberculosis" value="{{$tuberculosis->sospechoso}}">
                                        
                                        </div>
                                    
                                    </div>

                                </div>

                                <!-- FECHA MUESTRA -->
                                <div class="row" id="inputFechaMuestraTuber">
                                
                                    <div class="col-md-12">
                                    
                                        <div class="form-group">
                                        
                                            <label>Fecha de Muestra</label>
                                        
                                            <input type="date" class="form-control" id="fechaEstadoTuberculosis" name="fechaEstadoTuberculosis" value="{{$tuberculosis->fechaEstado->format('Y-m-d')}}" required>
                                        
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

                    <button type="submit" id="btnActualizarStatusSanitario" class="btn btn-primary btn-block">Actualizar Status</button>
                
                </div>

            </form>

        </div>

    </div>

</div>
