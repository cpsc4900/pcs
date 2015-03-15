<?php
include "../control/global.php";
?>

<form class="form-horizontal" id="addAppForm" action="../control/handle_apps.php"
      method="post">
<fieldset>  <!-- New Appointment field -->

<!-- Form Name -->
<legend>Add New Appointment</legend>

<!-- Patien ID input-->
<div class="control-group">
  <div class="controls form-inline">
  <label class="control-label" for="pat_id">Patient ID:</label>
    <input id="pat_id" name="pat_id" placeholder="abc###" class="input-medium" type="text" required="">
    <button id="autofill" name="autofill" class="btn btn-primary btn-xs">auto fill</button>
  </div>
</div>

<!-- Patient First Name input-->
<div class="control-group">
  <div class="controls form-inline">
  <label class="control-label" for="fname">First Name:</label>
    <input id="fname" name="fname" placeholder="name" class="input-medium" type="text">
  </div>
</div>

<!-- Patien Last Name input-->
<div class="control-group">
  <div class="controls form-inline">
  <label class="control-label" for="lname">Last Name</label>
    <input id="lname" name="lname" placeholder="name" class="input-medium" type="text">
  </div>
</div>

<!-- Doctor ID with Drop Down -->
<div class="control-group">
  <div class="controls form-inline">
    <div class="input-append">
      <label class="control-label" for="doc_id">Attending Doctor ID:</label>
      <input id="doc_id" name="doc_id" class="input-medium" placeholder="id" type="text">
      <div class="btn-group">
        <button class="btn dropdown-toggle" data-toggle="dropdown">
          List of Doctor
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">  <!-- To do, add doctor to id display -->
          <?php 
            $list_of_docs = get_list_of_doctor_names_and_ids();  // gets a list of Docs f,l name and id
            foreach ($list_of_docs as $doc_field) {
                echo "<li>".'<a href="#"'; 
                echo 'onclick="docIdSelect('.$doc_field["EmployeeID"].')">'.
                      $doc_field["Fname"].' '. $doc_field["Lname"].'</a></li>';
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Hidden Time Field -->
<input type="hidden" id="appDate" name="appDate"value="" />

<!-- Buttons Submit and Cancel -->
<div class="control-group">
  <div class="controls form-inline">
    <button id="submit" name="submit" class="btn btn-success">Submit</button>
    <button id="formCancel" name="cancel" class="btn btn-danger">Cancel</button>
  </div>
</div>

</fieldset>
</form>
