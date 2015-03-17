<?php

?>
<div class="row" id="spacer"></div>                <!-- Row Spacer -->
<div class="row">
  <div class="col-sm-8 col-sm-offset-4">
    <div class="control-group pull-right">
      <div class="controls">
        <div class="input-append">
          <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" 
               data-toggle="dropdown">
               Primary <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
               <li><a href="#">Action</a></li>
               <li><a href="#">Another action</a></li>
               <li><a href="#">Something else here</a></li>
               <li class="divider"></li>
               <li><a href="#">Separated link</a></li>
            </ul>
          </div>
          <label class="control-label" for="searchForPatient">Search for Patient Records:</label>
          <input id="searchForPatient" name="searchForPatient" class="input-medium" placeholder="Enter Patient Criteria" type="text">
          
        </div>
      </div>
    </div>
  </div>
</div>

<form class="form-horizontal" role="form" action="../control/handle_apps.php"
        method="post">
  
  <!-- Form Name -->
  <legend>Add New Appointment</legend>
  
  <!-- Patien First Name input-->
  <div class="form-group">
    <label class="control-label col-sm-2" for="firstName">First Name:</label>
    <div class="col-sm-4">
      <input id="firstName" name="firstName" placeholder="name" class="form-control input-medium" type="text" required="">
    </div>
  </div>
  <!-- Patien Last Name input-->
  <div class="form-group">
    <div class="controls">
    <label class="control-label" for="lastName">Patient's Last Name:</label>
      <input id="lastName" name="lastName" placeholder="name" class="input-medium" type="text">
    </div>
  </div>
  <!-- Patient SSN input-->
  <div class="form-group">
    <div class="controls">
    <label class="control-label" for="patSSN">Patient's SSN:</label>
      <input id="patSSN" name="patSSN" placeholder="name" class="input-medium" type="text">
    </div>
  </div>
  <!-- Patient Birthday -->
  <div class="form-group">
    <div class="controls">
    <label class="control-label" for="patBday">Patient's Birthday:</label>
      <input id="patBday" name="patBday" placeholder="name" class="input-medium" type="text">
    </div>
  </div>
  <!-- Patient Gender -->
  <div class="form-group">
    <div class="controls">
    <label class="control-label" for="patGender">Patient's Birthday:</label>
      <input id="patGender" name="patGender" placeholder="name" class="input-medium" type="text">
    </div>
  </div>

  <!-- Street Address -->
  <div class="form-group">
    <div class="controls">
    <label class="control-label" for="patStAdd">Street Address:</label>
      <input id="patStAdd" name="patStAdd" placeholder="name" class="input-medium" type="text">
    </div>
  </div>
  <!-- City -->
  <div class="form-group">
    <div class="controls">
    <label class="control-label" for="patCity">City:</label>
      <input id="patCity" name="patCity" placeholder="name" class="input-medium" type="text">
    </div>
  </div>
  <!-- State -->
  <div class="form-group">
    <div class="controls">
    <label class="control-label" for="patState">State:</label>
      <input id="patState" name="patState" placeholder="name" class="input-medium" type="text">
    </div>
  </div>
  <!-- ZIP -->
  <div class="form-group">
    <div class="controls">
    <label class="control-label" for="patZip">ZIP:</label>
      <input id="patZip" name="patZip" placeholder="name" class="input-medium" type="text">
    </div>
  </div>
  

  
  <!-- Buttons Submit and Cancel -->
  <div class="form-group pull-right">
    <div class="controls form-inline">
      <button id="submit" name="submit" class="btn btn-success btn-sm">Submit</button>
      <button id="formCancel" name="cancel" class="btn btn-danger btn-sm">Cancel</button>
    </div>
  </div>
  
</form>