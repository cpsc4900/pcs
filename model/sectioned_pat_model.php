<?php
/**
 * @file
 *
 * Models the patient sectioned section belonging to doctors and nurses.
 */
?>

<table class="table table-hover  table-condensed table-striped" id="doctor_appointments_table">
  <thead>
    <tr>
      <th>Patient ID</th>
      <th>Social Security #</th>
      <th>Last Name</th>
      <th>First Name</th>
      <th>Gender</th>
      <th>Room Number</th>
      <th>Date Sectioned</th>
    </tr>
  </thead>
  <tbody id="sec-pat-table-body">
    <!-- Filled by handle_sectioned_pat.js -->
  </tbody>                                                                 
</table>


<!-- Modal -->
<div class="modal fade" id="med-modal" tabindex="-1" role="dialog" 
   aria-labelledby="med-model" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" >Medication(s) List</h4>
         </div>
         <div class="modal-body" id="med-modal-details">
            
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">Close
            </button>
         </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->