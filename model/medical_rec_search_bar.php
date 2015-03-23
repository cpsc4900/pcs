<?php

/**
 * Requires:    handle_medical_rec_search.js
 * Depends on:  model/search_for_med_recs.php
 */
?>

<div class="row" id="spacer"></div>                <!-- Row Spacer -->

<!-- Search bar for Patient Medical Records -->
<div class="row">                        
  <form class="well form-search">  
  <div class="col-sm-7 col-sm-offset-4">

    <div class="control-group pull-right">
      <div class="controls">
        <div class="input-append">
          <div class="btn-group">
            <button id="searchMedCrit" type="button" 
               class="btn btn-primary dropdown-toggle btn-xs"
               data-toggle="dropdown">
               Search By <span class="caret"></span>
            </button>
            <ul id="searchByVal" class="dropdown-menu" role="menu">
               <li id="ssn"><a href="#">SSN</a></li>
               <li id="lname"><a href="#">Last Name</a></li>
               <li id="patid"><a href="#">Patient ID</a></li>
            </ul>
          </div>
          <input id="searchForPatientMedValue" name="patient_criteria" 
                class="input-medium search-query" placeholder="Enter Patient Criteria" 
                type="text" required="">
        </div>
      </div>
    </div>
  </div>
  <input id="search-by"type="hidden" name="search_by_value">  
  <button id="submit-search-button" class="btn">Search</button>  
  </form>
</div>                               <!-- End Search bar for Patient Records -->

