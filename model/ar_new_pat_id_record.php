<?php

?>
<div class="row" id="spacer"></div>                <!-- Row Spacer -->

<!-- Search bar for Patient Records -->
<div class="row">                        
  <div class="col-sm-8 col-sm-offset-4">
    <div class="control-group pull-right">
      <div class="controls">
        <div class="input-append">
          <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle btn-sm" 
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
          <label class="control-label" for="searchForPatient">
            Search for Patient Records:
          </label>
          <input id="searchForPatient" name="searchForPatient" class="input-medium" placeholder="Enter Patient Criteria" type="text">
          
        </div>
      </div>
    </div>
  </div>
</div>                               <!-- End Search bar for Patient Records -->

<div class="row" id="spacer"></div>                <!-- Row Spacer -->

<div class="panel panel-info"> <!-- Add New Patient Record Form/Panel -->
<div class="panel-heading">Add New Patient Record</div>
<div class="panel-body">
    
  <form class="form-horizontal" role="form" action="../control/handle_new_pat_rec.php"
          method="post">
    
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
              <input id="patBday" name="patBday" placeholder="YYYY-MM-DD" class="form-control input-sm" type="text" required="">
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
        <button id="submit" name="submit" class="btn btn-success btn-sm">Submit</button>
        <button id="formCancel" name="cancel" class="btn btn-danger btn-sm">Cancel</button>
      </div>
    </div>
    
  </form>
  </div>
</div>