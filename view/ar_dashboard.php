<?php
session_start();
include "../control/access_control.php";


// Make sure user has the right to view this page
if($UserType != 'AR') {
  header("Location: ../PermissionDenied.php");
  exit();
}

?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AR Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/pcs_style.css">
</head>

<body>
<div class="container-fluid">

  <!-- **************************** Header ***************************  -->
  <div class="row" id="header">
    <div class="col-sm-2"></div>
    <div class="col-sm-6">
    <!-- Use as spacer OR coud put Clinic Name here (or something) -->
    </div>
    <div class="col-sm-3">
      <a href="../control/logout.php">                      <!-- Logout Link -->
        <span class="glyphicon glyphicon-log-out pull-right"></span>
      </a>
    </div>
  </div>  <!-- **** End Of Header *** -->

  <!-- *****************         Main Content          *****************  -->
  <div class="row"> 
    <div class="col-sm-1"></div>

    <div class="col-sm-8">  <!-- Center Column -->
      <ul class="nav nav-pills">                               <!-- Nav tabs -->
        <li class="active">
          <a href="#calendar" data-toggle="tab">View Appointment Calendar</a>
        </li>
        <li>
          <a href="#patient_rec" data-toggle="tab">View Patient Identity Records</a>
        </li>
      </ul>                                                <!-- End Nav tabs -->
       
      <!-- **************          Tab panes              ****************** -->
      <div class="tab-content">
        <!-- *************          Calendar              ****************** -->
        <div class="tab-pane active" id="calendar">
          <div class="row" id="spacer"></div>                <!-- Row Spacer -->

          <div class="btn-toolbar"> <!-- Calendar buttons -->
            <div class="btn-group">                        <!-- Year Buttons -->          
              <button type="button" class="btn btn-default" id = "prev_year">
                <span class="glyphicon glyphicon-arrow-left" ></span>
              </button>
              <button type="button" class="btn btn-default">
                  <div id="displayed_year">Year</div>
              </button>
              <button type="button" class="btn btn-default" id = "next_year">
                <span class="glyphicon glyphicon-arrow-right" ></span>
              </button>
            </div>                                  <!-- End of Year Buttons -->
            <div class="btn-group">                       <!-- Month Buttons -->
                <button type="button" class="btn btn-default" id = "prev_month">
                  <span class="glyphicon glyphicon-arrow-left" ></span>
                </button>
                <button type="button" class="btn btn-default">
                  <div id="displayed_month">Month</div>
                </button>
                <button type="button" class="btn btn-default" id = "next_month">
                  <span class="glyphicon glyphicon-arrow-right" ></span>
                </button>
            </div>                                 <!-- End of Month Buttons -->
          </div>                                   <!-- End Calendar buttons -->

          <div class="row">
            <div class="col-sm-12">              <!-- insert calendar matrix -->
              <div class = "table-responsive" id="calendar_div">
                <table class="table table-striped table-bordered table-condensed" 
                               id="calendar_matrix" style="font-size: 8px;">
                </table>
              </div>

            </div>  
          </div>
        </div>    
        
        <!-- *************          End Calendar          ****************** -->

        <div class="tab-pane" id="patient_rec">
          Add patient identity records here
          <div class="btn-group" role="mygroup">
            <button type = "button" id="mybutton">Get External Content</button>
          </div>
          <p id="change">This is a paragraph with little content.</p>
        </div>
      </div>
    </div>    <!-- end of Main Column -->
    <div class="col-sm-3"></div> <!-- end of third column -->
  </div>  <!-- end of Main Content -->
</div> <!-- end of container-fluid -->
    
  <!-- Load scripts last, speeds up loading --> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="../model/calendar.js"></script>
  <script src="../control/handle_calendar.js"></script>

</body>

</html>
