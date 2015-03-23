<?php


?>


<!--  ********             Add/Edit Appointment Modal              ********* -->
  <div class="modal fade" id="newAllergyModel" tabindex="-1" role="dialog" aria-labelledby="AddApp" aria-hidden="true">
    <div class="modal-dialog incmodalwidth">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close clearFields" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <center><h3 class="modal-title" id="newAllergyTitle">New Allergy</h3></center>
        </div>
        <div class="modal-body">
            <!-- Form Here -->
            <form id="newAllergyForm" class="form-horizontal">
            <div id="form-group-new-allergy" class="form-group">
                <label class="col-sm-3 control-label">Allergy Name</label>
                <div class="col-sm-4">
                    <input type="text" id="allergyName" class="form-control" name="allergyName" placeholder="name">
                </div>
                <div class="col-sm-4">
                    <label class="radio-inline">
                       <input type="radio" name="severity" checked="checked" id="allergy-mild" value="mild"> mild
                     </label>
                     <label class="radio-inline">
                       <input type="radio" name="severity" id="allergy-moderate" value="moderate"> moderate
                     </label>
                     <label class="radio-inline">
                       <input type="radio" name="severity" id="allergy-severe" value="severe"> severe
                     </label>
                </div>
            </div>
        
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="button" class="btn btn-primary" id="setValueButton">Add New Allergy</button>
                </div>
            </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default clearFields" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>