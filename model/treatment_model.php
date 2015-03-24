<?php


?>


<!--  ********             Add/Edit Appointment Modal              ********* -->
  <div class="modal fade" id="newTreatmentModal" tabindex="-1" role="dialog" aria-labelledby="AddApp" aria-hidden="true">
    <div class="modal-dialog incmodalwidth">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close clearFields jsonUpdate" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <center><h3 class="modal-title">New Treatment/Diagnosis</h3></center>
        </div>
        <div class="modal-body">
            <!-- Form Here -->
            <form id="newTreatmentForm" class="form-horizontal">
            <div class="form-group">
                <label for="diagnosis"class="col-sm-4 control-label">Diagnosis: </label>
                <div class="col-sm-4">
                    <input type="text" id="diagnosis" class="form-control" name="diagnosis" placeholder="name">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-4 control-label">Description of Symptons/Diagnosis </label>
                <div class="col-sm-4">
                    <textarea class="form-control" rows="5" id="description"></textarea>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-3">
                <div class="checkbox">
                  <label><input type="checkbox" value="addMedication"><b>Add Medication</b></label>
                </div>
              </div>
            </div>
            <div class="form-group">
                <label for="medCommonName"class="col-sm-4 control-label">Name of Medication:</label>
                <div class="col-sm-4">
                    <input type="text" id="medCommonName" class="form-control" name="medCommonName" placeholder="name">
                </div>
            </div>
            <div class="form-group">
                <label for="dosage"class="col-sm-4 control-label">Dosage:</label>
                <div class="col-sm-3">
                    <input type="text" id="dosage" class="form-control" name="dosage" placeholder="name">
                </div>
            </div>
            <div class="form-group">
                <label for="sideEffects"class="col-sm-4 control-label">Side Effects:</label>
                <div class="col-sm-4">
                    <textarea class="form-control" rows="4" id="sideEffects"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="button" class="btn btn-primary" id="setValueButton">Add New Treatment</button>
                </div>
            </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default clearFields jsonUpdate" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>