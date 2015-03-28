<?php

/**
 * Relies on handle_new_treatment.js
 *           handle_new_treatment.php
 */
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
                    <input type="text" id="diagnosis" class="form-control input-sm" name="diagnosis" placeholder="name">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-4 control-label">Description of Symptons/Diagnosis </label>
                <div class="col-sm-4">
                    <textarea class="form-control input-sm" rows="5" id="description"></textarea>
                </div>
            </div>
            <div class="control-group">
                <div class="col-sm-4 col-sm-offset-3">
                <label for="treatment" class="control-label">Treatment</label>
                 <div class="btn-group">
                    <button id="treat-options-btn"class="btn dropdown-toggle" data-toggle="dropdown">
                    Treatment Options
                    <span class="caret"></span>
                    </button>
                    <ul id="treat-options" class="dropdown-menu">
                        <li id="doc-referral"><a tabindex="-1" href="#">Doctor Referral</a></li>
                        <li id="medication"><a tabindex="-1" href="#">Medication</a></li>
                        <li id="therapy"><a tabindex="-1" href="#">Therapy</a></li>
                    </ul>
                 </div>
             </div>
            </div>
            <div class="row" id="spacer"></div>                <!-- Row Spacer -->

             <!-- Medication Form Group -->
            <div id="main-medication-form-group">
                <div class="form-group">
                    <label for="medCommonName"class="col-sm-4 control-label">Name of Medication:</label>
                    <div class="col-sm-2">
                        <input type="text" id="medCommonName" class="form-control input-sm" name="medCommonName" placeholder="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sideEffects"class="col-sm-4 control-label">Side Effects:</label>
                    <div class="col-sm-4">
                        <textarea class="form-control input-sm" rows="4" id="sideEffects"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dosage"class="col-sm-4 control-label">Dosage</label>
                    <div class="col-sm-3 input-append">
                            <div class="input-group">
                            <input type="text" id="dosage" class="form-control span1 input-sm" name="dosage" placeholder="xxx">
                            <span class="input-group-addon">mg</span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                        <select id="timesPerDay">
                            <option value="1">once</option>
                            <option value="2">twice</option>
                            <option value="3">three times</option>
                            <option value="4">four times</option>
                            <option value="5">five times</option>
                            <option value="6">six times</option>
                            <option value="7">seven times</option>
                            <option value="8">eight times</option>
                            <option value="9">nine times</option>
                            <option value="10">ten times</option>
                            <option value="11">11 times</option>
                            <option value="12">12 times</option>
                        </select>
                        <span class="input-group-addon">per day</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="prescribingDoc"class="col-sm-4 control-label">Perscribing Doctor ID</label>
                    <div class="col-sm-2">
                        <input type="text" id="prescribingDoc" class="form-control input-sm" name="prescribingDoc" placeholder="##">
                    </div>
                    <!-- TODO Add Doctor ID look up -->
                </div>
            </div>                                <!-- Medication Form Group -->


            <!-- End of Doctor Referral -->
            <div id="main-referral-form-group">
                <div class="control-group">
                    <div class="col-sm-4 col-sm-offset-3">
                    <label for="docReferral" class="control-label">Select Doctor</label>
                     <div class="btn-group">
                        <button id="doc-ref-btn"class="btn dropdown-toggle" data-toggle="dropdown">
                        Select
                        <span class="caret"></span>
                        </button>
                        <ul id="doc-referral-list" class="dropdown-menu">
                            <!-- filled by handle_new_treatment.js -->
                        </ul>
                     </div>
                    </div>
                </div>
                <div class="row" id="spacer"></div>                <!-- Row Spacer -->
               
                <div class="form-group">
                    <label for="docRefFname"class="col-sm-4 control-label">First Name:</label>
                    <div class="col-sm-3">
                            <input type="text" id="docRefFname" class="form-control span1 input-sm" name="docRefFname" placeholder="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="docRefLname"class="col-sm-4 control-label">Last Name:</label>
                    <div class="col-sm-3">
                        <input type="text" id="docRefLname" class="form-control input-sm" name="docRefLname" placeholder="name">
                    </div>
                </div>
                <input id="docRefID" name="docRefID" hidden>  
            </div>                  <!-- End of Doctor Referral -->

            <!-- Therapy Form -->
            <div id="main-therapy-form-group">
                <div class="form-group">
                    <label for="therapyDescript" class="col-sm-4 control-label">Brief Description of Therapy:</label>
                    <div class="col-sm-4">
                        <textarea class="form-control input-sm" rows="5" id="therapyDescript"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="therapyDuration"class="col-sm-4 control-label">Anticapted Duration of Therapy:</label>
                    <div class="col-sm-3">
                        <input type="text" id="therapyDuration" class="form-control input-sm" name="therapyDuration" placeholder="in weeks or months">
                    </div>
                </div>
            </div>                  <!-- End of Therapy Form -->

            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-7">
                    <button type="button" class="btn btn-primary btn-sm" id="submitNewTreat">Add New Treatment</button>
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