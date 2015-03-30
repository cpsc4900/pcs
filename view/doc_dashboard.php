
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
          <a href="#daily_appnt" data-toggle="tab">View Daily Appointments</a>
        </li>
        <li>
          <a href="#patient_rec" data-toggle="tab">View Patient Medical Records</a>
        </li>
        <li>
          <a href="#patient_treat" data-toggle="tab">New Patient Treatment</a>
        </li>
      </ul>                  
      <!-- ********************   Content   ***************  -->
      <div class ="tab-conent">

        <!-- ***************    Daily Appointments   *********  -->
        <div class="tab-pane active fade in" id="daily_appnt">
          <div class="row" id="spacer"></div>
          <div class="col-sm-offset-1 col-sm-11">
            <div class="panel panel-default">
              <div class="panel-heading" style="text-align: center">
                Doctor Daily Appointments  Insert_Object
              </div>
              <div class="panel-body">
                <table class="table" id="doctor_appointments_table">
                  <tr id="appointment_hour_id_8">
                    <td>8:00 AM</td>
                  </tr>
                  <tr id="appointment_hour_id_9">
                    <td>9:00 AM</td>
                  </tr>
                  <tr id="appointment_hour_id_10">
                    <td>10:00 AM</td>
                  </tr>
                  <tr id="appointment_hour_id_11">
                    <td>11:00 AM</td>
                  </tr>
                  <tr id="appointment_hour_id_12">
                    <td>12:00 PM</td>
                  </tr>
                  <tr id="appointment_hour_id_1">
                    <td>1:00 PM</td>
                  </tr>
                  <tr id="appointment_hour_id_2">
                    <td>2:00 PM</td>
                  </tr>
                  <tr id="appointment_hour_id_3">
                    <td>3:00 PM</td>
                  </tr>
                  <tr id="appointment_hour_id_4">
                    <td>4:00 PM</td>
                  </tr>                                                                 
                </table>
              </div>
            </div>  <!-- End Panel -->
          </div> <!-- End Column -->
        </div>
 <!-- **************   End Daily Appointment    ***************  -->

 <!-- ***********   View Patient Medical Record   ************** -->
        <div class="tab-pane fade" id="patient_rec">

        </div>
 <!-- ***********   End View Patient Medical Record    ***********  -->

 <!-- *************   Add Patient Treatment   **************** -->
        <div class="tab-pane fade" id="patient_treat">

        </div>
 <!-- *************   End Add Patient Treatment   **************** -->


      </div> <!-- End Tab Content -->
    </div> <!-- End main column -->
  </div> <!-- End main row -->
</div> <!-- End Container -->


  <!-- *****************     Scripts     ****************************  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../assets/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
  <script src="../assets/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  <script src="../model/global.js"></script>
  <script src="../model/clock.js"></script>

</body>
</html>
