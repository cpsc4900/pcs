
<?php
session_start();
include "../control/access_control.php";
include "../control/handle_apps.php";


// Make sure user has the right to view this page
if($UserType != 'Doctor') {
  header("Location: ../PermissionDenied.php");
  exit();
}

?>


<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Doctor Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/bootstrap-3.3.4-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/pcs_style.css">
</head>

<body>
<div class="container-fluid">

  <!-- *****************         Header          *****************  -->
  <div class="row" id="header">
    <div class="col-sm-offset-2 col-sm-4"></div>
    <div class="col-sm-offset-1 col-sm-2">
      <div id="pcsClock"></div>
    </div>
    <div class="col-sm-2">
      <button type="button" class="btn btn-default dropdown-toggle btn-sm"
      data-toggle="dropdown">
      <span class="glyphicon glyphicon-log-out"></span>
      </button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="../control/logout.php">Log out</a></li>
       </ul>
    </div>
  </div>  <!-- **** End Of Header *** -->

  <!-- *****************     Tabs      *****************  -->
  <div class="row">
    <div class="col-sm-1"></div>

    <div class="col-sm-8">  <!-- Center Column -->
      <ul class="nav nav-pills"> 
        <li class="active">
          <a  id="appt-select"href="#daily_appnt" data-toggle="tab">View Daily Appointments</a>
        </li>
        <li>
          <a id ="sec-select"href="#sectioned-pat" data-toggle="tab">Sectioned Patients</a>
        </li>
      </ul>                  
      <!-- ********************   Content   ***************  -->
      <div class ="tab-conent">

        <!-- ***************    Daily Appointments   *********  -->
        <div class="tab-pane active fade in" id="daily_appnt">
          <div class="row" id="spacer"></div>
          <div class="row">
            <div class="panel panel-primary" id="daily-appnt-table">
              <div class="panel-heading">
                <h3>Doctor Daily Appointments</h3>
              </div>
              <div class="panel-body">
              </div>
                <?php include "../model/daily_apps_model.php"; ?>
            </div>  <!-- End Panel -->
        </div>
        </div>
 <!-- **************   End Daily Appointment    ***************  -->

 <!-- *************   Add Patient Sectioned   **************** -->
        <div class="tab-pane fade" id="sectioned-pat">
           <div class="row" id="spacer"></div>
          <?php include "../model/sectioned_pat_model.php" ?>
        </div>
 <!-- *************   End Add Patient Sectioned   **************** -->

      </div> <!-- End Tab Content -->
    </div> <!-- End main column -->
    <div class="col-sm-3"></div> <!-- end of third column -->
  </div> <!-- End main row -->
</div> <!-- End Container -->




  <!-- *****************     Scripts     ****************************  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../assets/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
  <script src="../assets/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  <script src="../model/global.js"></script>
  <script src="../model/clock.js"></script>
  <script src="../control/handle_medical_rec_search.js"></script>
  <script src="../control/handle_new_allergy.js"></script> <!-- depends on the script right above -->
  <script src="../control/handle_new_treatment.js"></script>
  <script src="../control/handle_daily_apps.js"></script>
  <script src="../control/handle_sectioned_pat.js"></script>



</body>
</html>
