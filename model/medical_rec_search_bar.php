<?php

/**
 * Requires:    handle_medical_rec_search.js
 * Depends on:  model/search_for_med_recs.php
 */
?>

<div class="row" id="spacer"></div>                <!-- Row Spacer -->

<!-- Search bar for Patient Medical Records -->
<div class="row temp-color">                        
  <div class="col-sm-10 col-sm-offset-2">

    <div class="control-group pull-right">
      <div class="controls">
        <div class="input-prepend input-append">
          <div class="btn-group">
            <button id="searchMedCrit" type="button" 
               class="btn btn-info dropdown-toggle btn-xs"
               data-toggle="dropdown">
               Search By <span class="caret"></span>
            </button>
            <ul id="searchByVal" class="dropdown-menu" role="menu">
               <li id="ssn"><a tabindex="-1" href="#">SSN</a></li>
               <li id="lname"><a tabindex="-1" href="#">Last Name</a></li>
               <li id="patid"><a tabindex="-1" href="#">Patient ID</a></li>
            </ul>
          </div>
          <input id="searchForPatientMedValue" name="patient_criteria" 
                class="span2 input-medium search-query" placeholder="Enter Patient Criteria" 
                type="text" required="">
          <button id="submit-search-button" class="btn btn-sm" type="button">Search</button>  
        </div>
          <input id="search-by" type="hidden" name="search_by_value">  
      </div>
    </div>
  </div>
</div>                               <!-- End Search bar for Patient Records -->
<div class="row" id="spacer"></div>                <!-- Row Spacer -->

