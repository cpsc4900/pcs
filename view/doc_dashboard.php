
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
  <title>Doctor Dashboard</title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link href="../assets/css/pcs_style.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../assets/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
  <script src="../model/clock.js"></script> <!-- Import Clock -->

</head>

<body>


  <!-- *****************         Header          *****************  -->

  <div class="row" id="header">
    <div class="col-sm-offset-2 col-sm-4"><h2>Patient Care System</h2></div>
    <div class="col-sm-offset-1 col-sm-2">
      <div id="pcsClock"></div>
    </div>
    <div class="col-sm-2">
      <button type="button" class="btn btn-default dropdown-toggle btn-sm"
      data-toggle="dropdown">
      <span class="glyphicon glyphicon-log-out"></span>
      </button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">Log out</a></li>
       </ul>
    </div>
  </div>  <!-- **** End Of Header *** -->

  <!-- *****************         Navbar          *****************  -->

  <div class="row">
    <div class="col-sm-1"></div>

    <div class="col-sm-8">  <!-- Center Column -->
      <ul class="nav nav-pills">                               <!-- Nav tabs -->
        <li class="active">
          <a href="#placeholder1" data-toggle="tab">View Daily Appointments</a>
        </li>
        <li>
          <a href="#placeholder2" data-toggle="tab">View Patient Medical Records</a>
        </li>
        <li>
		  <a href="#placeholder3" data-toggle="tab">New Patient Treatment</a>
        </li>
      </ul>                                                <!-- End Nav tabs -->

  <!-- *****************         Content          *****************  -->

  <br> <br>
  <div class="row">
    <div class="col-sm-offset-1 col-sm-11">
	  <div class="panel panel-default">
		<div class="panel-heading">
		  Doctor Daily Appointments
		</div>
		<div class="panel-body">
          <table class="table" id="doctor_appointments_table">

	  	    <!-- Appointment Information Table Here -->


		  </table>
		</div>
      </div>
	</div>
  </div>

</body>
</html>
