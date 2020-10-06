<!-- MODAL -->
    <div id="with-form" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-white">Réservation en ligne</h4>
          </div>
          <div class="modal-body">
            @php

              $all_services = getAllServices();

              if(!empty($all_services)){
                $all_services = json_encode($all_services);
              }
              else{
                $all_services = '';
              }
              
            @endphp
            <reservation-form :services="{{ $all_services }}"></reservation-form>
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="site-button site-button-secondry  m-r15" data-dismiss="modal">Annuler
             <i class="fa fa-close"></i></button>

            <button type="button" class="site-button ">Sauvegarder
             <i class="fa fa fa-check"></i></button>
            
          </div> -->
        </div>
      </div>
    </div>