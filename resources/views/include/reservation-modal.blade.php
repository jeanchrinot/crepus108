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
            <form id="demo-form" class="form-horizontal mb-lg" novalidate>
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label">Nom complet</label>
                    <div class="col-sm-9">
                        <input name="name" class="form-control" placeholder="Votre nom complet..." required type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Téléphone</label>
                    <div class="col-sm-9">
                        <input name="email" class="form-control" placeholder="Votre Téléphone..." required type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Service</label>
                    <div class="col-sm-9">
                        <select name="service" class="form-control" required>
                          <option>Choisir un service</option>
                          <option value="Faux locs">Faux Locs</option>
                          <option value="Braids">Braids</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Date et heure</label>
                    <div class="col-sm-9">
                        <input name="date" class="form-control" type="datetime-local">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Note (optionnel)</label>
                    <div class="col-sm-9">
                    <textarea rows="5" class="form-control" placeholder="Taper ici si vous voulez laisser une note..." name="note"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <input name="condition" id="condition" class="form-control" type="checkbox">
                        <label for="condition">J'ai lu et compris les conditions d'utilisations.</label>
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="site-button site-button-secondry  m-r15" data-dismiss="modal">Annuler
             <i class="fa fa-close"></i></button>

            <button type="button" class="site-button ">Sauvegarder
             <i class="fa fa fa-check"></i></button>
            
          </div>
        </div>
      </div>
    </div>