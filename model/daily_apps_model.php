<?php

/**
 * @file
 * Model for displaying the hourly appointments belonging to the currently logged
 * in doctor.
 */


?>


<table class="table table-hover  table-condensed table-striped" id="doctor_appointments_table">
  <tr id="app_hour_id_08">
    <td>&nbsp;8:00 AM</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr id="app_hour_id_09">
    <td>&nbsp;9:00 AM</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr id="app_hour_id_10" >
    <td>10:00 AM</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr id="app_hour_id_11">
    <td>11:00 AM</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr id="app_hour_id_12">
    <td>12:00 PM</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr id="app_hour_id_13">
    <td>&nbsp;1:00 PM</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr id="app_hour_id_14">
    <td>&nbsp;2:00 PM</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr id="app_hour_id_15">
    <td>&nbsp;3:00 PM</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr id="app_hour_id_16">
    <td>&nbsp;4:00 PM</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>                                                                 
</table>

<div class="modal fade" id="med-rec-drop-down" tabindex="-1" role="dialog" aria-labelledby="med-rec-drop-down" aria-hidden="true">
    <div class="modal-dialog incmodalwidth">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close clearFields" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <center><h3 class="modal-title" id="dropInModal">Patient's Details</h3></center>
        </div>
        <div class="modal-body">
        <?php include "medical_record_model.php"; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default clearFields" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>