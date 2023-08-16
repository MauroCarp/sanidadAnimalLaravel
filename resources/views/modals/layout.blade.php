<div id="{{ $idModal }}" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
    
            <h4 class="modal-title">Nuevo {{ $seccion }}</h4>
            
            <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        
        <div class="modal-body">

          <div class="box-body">

            @yield('modal')

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="submit" class="btn btn-primary">Cargar {{ $seccion }}</button>

        </div>

      </form>

    </div>

  </div>

</div>