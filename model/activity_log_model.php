<?php
/**
 * @file
 *
 * Model for displaying info from the ACTIVITY_LOG Table.
 *
 * Activities that are logged are:
 * (1) User Login and Logout (note: Logout is only recorded when the user clicks
 *     on the logout button, so this cannot be considered accurate)
 * (2) New or Changes to TREATMENT records
 * (3) New or Changes to ALLERGY records
 * (4) New Primary Records
 *
 * Each activity logs a timestamp, the EmployeeID, and the ID of record that
 * has been changed or created.  Of course, Login and Logout logs do not have a
 * RecordID
 */

?>

<div class="row" id="spacer"></div>                <!-- Row Spacer -->

<div class="panel panel-success">
  <div class="panel-heading">Current Activities</div>  
  <div class="panel-body">
    <table  class="table table-striped table-hover table-condensed">
      <thead>
        <th><a href="#" id ="activity-log-id"class="btn btn-success btn-xs act-log-order"><span class="glyphicon glyphicon-sort-by-attributes"></span> LogID</a></th>
        <th><a href="#" id ="activity-activity-type"class="btn btn-success btn-xs act-log-order"><span class="glyphicon glyphicon-sort-by-attributes"></span> ActivityType</a></th>
        <th><a href="#" id ="activity-timestamp"class="btn btn-success btn-xs act-log-order"><span class="glyphicon glyphicon-sort-by-attributes"></span> TimeStamp</a></th>
        <th><a href="#" id ="activity-emp-id"class="btn btn-success btn-xs act-log-order"><span class="glyphicon glyphicon-sort-by-attributes"></span> EmployeeID</a></th>
        <th><a href="#" id ="activity-allergy-id"class="btn btn-success btn-xs act-log-order"><span class="glyphicon glyphicon-sort-by-attributes"></span> AllergyID</a></th>
        <th><a href="#" id ="activity-treat-id"class="btn btn-success btn-xs act-log-order"><span class="glyphicon glyphicon-sort-by-attributes"></span> TreatmentID</a></th>
        <th><a href="#" id ="activity-pat-rec-id"class="btn btn-success btn-xs act-log-order"><span class="glyphicon glyphicon-sort-by-attributes"></span> PatientRecID</a></th>
      </thead>
      <tbody id="activity-table">

      </tbody>
    </table>
  </div>
</div>


