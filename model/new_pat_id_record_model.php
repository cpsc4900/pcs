<?php

?>

<div class="row" id="spacer"></div>                          <!-- Row Spacer -->

<div class="panel panel-info" id="new_pat_rec">   <!-- Add New Patient Record Form/Panel -->
<div class="panel-heading">Add New Patient Record</div>
<div class="panel-body">
    
  <div class="form-horizontal">
    
      <!-- Patien First/Last Name input-->
      <div class="row">
          <div class="form-group">
            <div class="col-sm-2">
              <label class="control-label label-sm" for="firstName">First Name:</label>
            </div>
            <div class="col-sm-4">
              <input id="firstName" name="firstName" placeholder="name" class="form-control input-sm" type="text" required="">
            </div>
            <div class="col-sm-2">
              <!-- Patien Last Name input-->
              <label class="control-label label-sm" for="lastName">Last Name:</label>
            </div>
            <div class="col-sm-4">
              <input id="lastName" name="lastName" placeholder="name" class="form-control input-sm" type="text" required="">
            </div>
          </div>
      </div>

      <!-- Patient SSN/BDay input-->
      <div class="row">
        <div class="form-group">
          <div class="col-sm-2">
            <label class="control-label label-sm" for="patSSN">SSN:</label>
          </div>
          <div class="col-sm-4">
              <input id="patSSN" name="patSSN" placeholder="##########" class="form-control input-sm" type="text" required="">
          </div>
          <div class="col-sm-2"><!-- Patient Birthday -->
            <label class="control-label label-sm" for="patBday">Birthday:</label>
          </div>
          <div class="col-sm-4">
              <input id="patBday" name="patBday" placeholder="YYYY-MM-DD" class="form-control input-sm" type="date" required="">
          </div>
        </div>
      </div>

      <!-- Patient Gender/Phone Number -->
      <div class="row">
        <div class="form-group">
          <div class="col-sm-4">
            <label class="control-label label-sm" for="genderChk">Gender:</label>
            <div class="btn-group">
              <label class ="label-sm" >
                <input type="radio" id="maleChk" name="genderChk" checked="checked" value="male" />Male
              </label> 
              <label class ="label-sm">
                <input type="radio" id="femaleChk" name="genderChk"  value="female" />Female
              </label> 
            </div>      
          </div>
          <div class="col-sm-2 col-sm-offset-2"> <!-- Phone Number -->
            <label class="control-label label-sm" for="phoneNum">Phone #:</label>
          </div>
          <div class="col-sm-4"> <!-- Phone Number -->
            <input id="phoneNum" name="phoneNum" placeholder="##########" class="form-control input-sm" type="text" required="">
          </div>
        </div>
    </div>

    <!-- Street Address| City -->
    <div class="row">
      <div class="form-group">
        <div class="col-sm-2"> <!-- Street Address -->
          <label class="control-label label-sm" for="patStAdd">Street Address:</label>
        </div>
        <div class="col-sm-4">
          <input id="patStAdd" name="patStAdd" placeholder="Address" class="form-control input-sm" type="text" required="">
        </div>
        <div class="col-sm-2"><!-- City -->
          <label class="control-label label-sm" for="patCity">City:</label>
        </div>
        <div class="col-sm-4">
          <input id="patCity" name="patCity" placeholder="city" class="form-control input-sm" type="text" required="">
        </div>
      </div>
    </div>

    <!-- State|Zip -->
    <div class="row">
      <div class="form-group">
        <div class="col-sm-2"><!-- State -->
          <label class="control-label label-sm" for="patState">State:</label>
        </div>
        <div class="col-sm-4">  
          <input id="patState" name="patState" placeholder="state" class="form-control input-sm" type="text" required="">
        </div>
        <div class="col-sm-2"><!-- Zip -->
          <label class="control-label label-sm" for="patZip">ZIP:</label>
        </div>
        <div class="col-sm-4">  
          <input id="patZip" name="patZip" placeholder="#####" class="form-control input-sm" type="text" required="">
        </div>
      </div>
    </div>
  
    <!-- Buttons Submit and Cancel -->
    <div class="form-group pull-right">
      <div class="controls form-inline">
        <button id="submit" onclick="handle_new_pat_record()"class="btn btn-success btn-sm clearFields">Submit</button>
        <button id="formCancel" name="cancel" class="btn btn-danger btn-sm">Cancel</button>
      </div>
    </div>
    </div>
  </div>
</div>