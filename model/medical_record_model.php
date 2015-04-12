<?php
/**
 * Requires:    control/handle_medical_rec_search.js
 * Depends On;  model/medical_rec_search_bar.php
 */
  include "new_allergy_model.php";
  include "treatment_model.php";

?>

<!-- **************          Search Results                      *********** -->
<div class="row">
    <div id="pat_table_med_search_results" class="panel panel-default">  
        <div class="panel-heading">
            <button type="button" id="pat_table_med_search_close"class="close"aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          <h3 class="panel-title">
             Search Results:
          </h3>
       </div>
       <div class="panel-body"> 
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                   <thead>
                      <tr>
                         <th>Patient ID</th>
                         <th>First Name</th>
                         <th>Last Name</th>
                         <th>Social Security #</th>
                         <th>Birth Date</th>
                         <th>Gender</th>
                         <th>Currently Sectioned</th>
                      </tr>
                   </thead>
                   <tbody id="pat_med_search_results">
                    <!-- Filled by drawSearchResults() in handle_medical_rec_search.js -->
                   </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- **************          End Search Results                  *********** -->

<!-- **************          Medical Record Display              *********** -->
<div class="panel-group" id="accordion">
   <div class="panel panel-warning">
      <div class="panel-heading">
         <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" 
               href="#collapseOne">
               Patient's General Information
            </a>
         </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse in">
         <div class="panel-body">
          <input id="gen-info-patID" name="gen-info-patID" hidden>
            <!-- General Info Here -->
            <p id="gen-info-patName"></p>
            <p id="gen-info-ssn"></p>
            <p id="gen-info-birthday"></p>
            <p id="gen-info-gender"></p>
            <p id="gen-info-phoneNum"></p>
            <p id="address-header"></p>
            <p id="gen-info-street"></p>
            <p id="gen-info-rest-of-address"></p>
         </div>
      </div>
   </div>
   <div class="panel panel-success">
      <div class="panel-heading">
         <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" 
               href="#collapseTwo">
               Patient's Known Allergies  
            </a>
         </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse">
          <div id="patient-known-allergies"class="panel-body">
           <!-- filled by showPatientKnownAllergies() in handle_medical_rec_search.js -->   
          </div>
          <div class="row">
           <div class="col-sm-4 col-sm-offset-10">
            <a data-toggle="modal" role="button" class="btn btn-success btn-xs" id="new-allergy-option" 
               href="#" data-target="#newAllergyModel">
              New Allergy
            </a>
            </div>
          </div>
      </div>
   </div>
   <div class="panel panel-info">
      <div class="panel-heading">
         <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" 
               href="#collapseThree">
               Patient's Previous Treatments
            </a>
         </h4>
      </div>
      <div id="collapseThree" class="panel-collapse collapse">
         <div class="panel-body">
            <div id="patient-prev-treatments"class="panel-body">
             <!-- filled by showPatientPreviousTreatments() in handle_medical_rec_search.js -->   
            </div>
            <div class="row">
             <div class="col-sm-4 col-sm-offset-7">
              <a data-toggle="modal" role="button" class="btn btn-info btn-xs" id="new-treatment-option" 
                 href="#" data-target="#newTreatmentModal">
                New Treatment/Medication Record
              </a>
              </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- **************          End Medical Record Display          *********** -->
