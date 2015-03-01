<?php

include "../control/access_control.php";

global $UserType;

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
  <link rel="stylesheet" href="assets/css/pcs_style.css">
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
      <ul class="nav nav-tabs">                                <!-- Nav tabs -->
        <li class="active">
          <a href="#calendar" data-toggle="tab">View Appointment Calendar</a>
        </li>
        <li>
          <a href="#patient_rec" data-toggle="tab">View Patient Identity Records</a>
        </li>
      </ul>                                                <!-- End Nav tabs -->
       
      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="calendar">
          <div id="calendar"></div>
          Add Calendar Here
        </div>
        <div class="tab-pane" id="patient_rec">
          Add patient identity records here
        </div>
      </div>
    </div>    <!-- end of Center Column -->
    <div class="col-sm-3">
    </div> <!-- end of third column -->
  </div>  <!-- end of Main Content -->
</div> <!-- end of container-fluid -->
    
  <!-- Load scripts last, speeds up loading --> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="../model/calendar.js"></script>
</body>

</html>
