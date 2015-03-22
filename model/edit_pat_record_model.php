<?php

?>

<div class="row" id="spacer"></div>                <!-- Row Spacer -->

<!-- Search bar for Patient Records -->
<div class="row">                        
  <div class="col-sm-7 col-sm-offset-4">

    <div class="control-group pull-right">
      <div class="controls">
        <div class="input-append">
          <div class="btn-group">
            <button id="searchCrit" type="button" class="btn btn-primary dropdown-toggle btn-xs"
               data-toggle="dropdown">
               Search By <span class="caret"></span>
            </button>
            <ul id="searchBy" class="dropdown-menu" role="menu">
               <li id="ssn"><a href="#">SSN</a></li>
               <li id="lname"><a href="#">Last Name</a></li>
               <li id="patid"><a href="#">Patient ID</a></li>
            </ul>
          </div>
          <input id="searchForPatient" name="searchForPatient" class="input-medium" placeholder="Enter Patient Criteria" type="text">
          <button id="submitSearch" type="button" class="btn btn-primary btn-xs">
              <span class="glyphicon glyphicon-search"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>                               <!-- End Search bar for Patient Records -->


<!--********             Patient Primary Record Table              ********* -->
<div class="row">
    <div id="pat_table_search_results" class="panel panel-default">  
        <div class="panel-heading">
            <button type="button" id="pat_table_search_close"class="close"aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          <h3 class="panel-title">
             Search Results:
          </h3>
       </div>
       <div class="panel-body"> 
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                   <thead>
                      <tr>
                         <th>Patient ID</th>
                         <th>First Name</th>
                         <th>Last Name</th>
                         <th>Social Security #</th>
                         <th>Birth Date</th>
                         <th>Gender</th>
                         <th>Street Address</th>
                         <th>City</th>
                         <th>State</th>
                         <th>Zip</th>
                      </tr>
                   </thead>
                   <tbody id="pat_search_tbody">
                    <!-- Filled by patientRecordSearch() in handle_ar_edit_pat_rec.js -->
                   </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!--********         End Patient Primary Record Table              ********* -->



<!--********          Patient Primary Record Edit                  ********* -->

<div class="row">
    <div id="patient_edit_panel" class="panel panel-default">
       <div class="panel-heading">
            <button type="button" id="pat_panel_close"class="close"aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          <h3 class="panel-title">
             Edit Patient Primary Record
          </h3>
       </div>
       <div class="panel-body">
      <div class="form-horizontal">
    
      <!-- Patien First/Last Name input-->
      <input type="hidden" id ="edit_patid">
      <div class="row">
          <div class="form-group">
            <div class="col-sm-2">
              <label class="control-label label-sm" for="edit_firstName">First Name:</label>
            </div>
            <div class="col-sm-4">
              <input id="edit_firstName" name="firstName" placeholder="name" class="form-control input-sm" type="text" required="">
            </div>
            <div class="col-sm-2">
              <!-- Patien Last Name input-->
              <label class="control-label label-sm" for="edit_lastName">Last Name:</label>
            </div>
            <div class="col-sm-4">
              <input id="edit_lastName" name="lastName" placeholder="name" class="form-control input-sm" type="text" required="">
            </div>
          </div>
      </div>

      <!-- Patient SSN/BDay input-->
      <div class="row">
        <div class="form-group">
          <div class="col-sm-2">
            <label class="control-label label-sm" for="edit_patSSN">SSN:</label>
          </div>
          <div class="col-sm-4">
              <input id="edit_patSSN" name="patSSN" placeholder="##########" class="form-control input-sm" type="text" required="">
          </div>
          <div class="col-sm-2"><!-- Patient Birthday -->
            <label class="control-label label-sm" for="edit_patBday">Birthday:</label>
          </div>
          <div class="col-sm-4">
              <input id="edit_patBday" name="patBday" placeholder="YYYY-MM-DD" class="form-control input-sm" type="date" required="">
          </div>
        </div>
      </div>

      <!-- Patient Gender/Phone Number -->
      <div class="row">
        <div class="form-group">
          <div class="col-sm-4">
            <label class="control-label label-sm" for="edit_genderChk">Gender:</label>
            <div class="btn-group">
              <label class ="label-sm" >
                <input type="radio" id="edit_maleChk" name="genderChk" value="male" />Male
              </label> 
              <label class ="label-sm">
                <input type="radio" id="edit_femaleChk" name="genderChk"  value="female" />Female
              </label> 
            </div>      
          </div>
          <div class="col-sm-2 col-sm-offset-2"> <!-- Phone Number -->
            <label class="control-label label-sm" for="edit_phoneNum">Phone #:</label>
          </div>
          <div class="col-sm-4"> <!-- Phone Number -->
            <input id="edit_phoneNum" name="phoneNum" placeholder="##########" class="form-control input-sm" type="text" required="">
          </div>
        </div>
    </div>

    <!-- Street Address| City -->
    <div class="row">
      <div class="form-group">
        <div class="col-sm-2"> <!-- Street Address -->
          <label class="control-label label-sm" for="edit_patStAdd">Street Address:</label>
        </div>
        <div class="col-sm-4">
          <input id="edit_patStAdd" name="patStAdd" placeholder="Address" class="form-control input-sm" type="text" required="">
        </div>
        <div class="col-sm-2"><!-- City -->
          <label class="control-label label-sm" for="edit_patCity">City:</label>
        </div>
        <div class="col-sm-4">
          <input id="edit_patCity" name="patCity" placeholder="city" class="form-control input-sm" type="text" required="">
        </div>
      </div>
    </div>

    <!-- State|Zip -->
    <div class="row">
      <div class="form-group">
        <div class="col-sm-2"><!-- State -->
          <label class="control-label label-sm" for="edit_patState">State:</label>
        </div>
        <div class="col-sm-4">  
          <input id="edit_patState" name="patState" placeholder="state" class="form-control input-sm" type="text" required="">
        </div>
        <div class="col-sm-2"><!-- Zip -->
          <label class="control-label label-sm" for="edit_patZip">ZIP:</label>
        </div>
        <div class="col-sm-4">  
          <input id="edit_patZip" name="patZip" placeholder="#####" class="form-control input-sm" type="text" required="">
        </div>
      </div>
    </div>
  
    <!-- Buttons Submit and Cancel -->
    <div class="form-group pull-right">
      <div class="controls form-inline">
        <button id="submit" onclick="handle_edit_pat_record()" class="btn btn-success btn-sm clearFields">Submit</button>
      </div>
    </div>
    </div>
       </div>
    </div>
</div>

<!--********         End Patient Primary Record Edit              ********* -->

