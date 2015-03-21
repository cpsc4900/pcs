<?php

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
               Patient General Info
            </a>
         </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse in">
         <div class="panel-body">
            <!-- General Info Here -->
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
         <div class="panel-body">
            Known Allerigies here
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
            Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred 
            nesciunt sapiente ea proident. Ad vegan excepteur butcher vice 
            lomo.
         </div>
      </div>
   </div>
</div>

<!-- **************          End Medical Record Display          *********** -->
