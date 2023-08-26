@extends('modals/layout',[
    'idModal'=>'modalRenspaActaProductor',
    'title'=>'Actas por productor',
    'action'=>'aftosa.actasProductor',
    'formClass'=>'formActasProductor'
])

@section('modal')

    <div class="row">

        <div class="col-md-12">

            <div class="form-group">

                <label>Renspa</label>
            
                <div class="input-group-prepend">

                    <div class="input-group">
                    
                        <span class="input-group-text"><i class="fa fa-user"></i></span> 

                        <input type="text" class="form-control form-control-lg @error('renspa') is-invalid @enderror" name="renspa" value="{{ $preRenspa }}" required>
                        
                    </div>
                    
                    
                </div>

                <small class="errors" id="errorNombre"></small>

            </div>
        
        </div>

    </div>

@endsection

@section('submit')
    <button type="submit" class="btn btn-primary">Buscar Actas</button>
@endsection

@section('js')

    <script>
        $('#modalRenspaActaProductor').children().first().removeClass('modal-lg') 
        $('#modalRenspaActaProductor').children().first().addClass('modal-xs') 
    </script>

@endsection