<?php
session_start();
include "../control/access_control.php";
include "../control/handle_apps.php";


// Make sure user has the right to view this page
if($UserType != 'MRS') {
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
          <a href="#patient_med_rec_view" data-toggle="tab">Patient Medical Records</a>
        </li>
        <li>
          <a href="#pat_prim_rec_view" data-toggle="tab">Patient Identity Records</a>
        </li>
        <li>
          <a href="#activity_log_view" data-toggle="tab">Activity Logs</a>
        </li>
        <li>
          <a href="#backup_rec_view" data-toggle="tab">Backup Records</a>
        </li>
      </ul>                                                <!-- End Nav tabs -->
       
      <!-- **************          Tab Content              ****************** -->
      <div class="tab-content">

        <!-- *************     Patient Medical Records       *************** -->
        <div class="tab-pane active fade in" id="patient_med_rec_view">
          <div class="row" id="spacer"></div>                <!-- Row Spacer -->
          <div class="col-sm-12"><h3>add medical records here</h3></div>
        </div>    
        
        <!-- *************   End Patient Medical Records   ***************** -->

        <!-- *************   Patient Primary Records View ****************** -->
        <div class="tab-pane fade" id="pat_prim_rec_view">
          <?php include "../model/edit_pat_record_model.php"; ?>
          <?php include "../model/new_pat_id_record_model.php"; ?>
        </div>
        <!-- *************  End Patient Primary Records View  ************** -->

        <!-- *************       Activity Logs View       ****************** -->
        <div class="tab-pane fade" id="activity_log_view">
          <h3> Add Activity Logs Here </h3>
        </div>
        <!-- *************     End Activity Logs View         ************** -->

        <!-- *************       Backup Records View       ****************** -->
        <div class="tab-pane fade" id="backup_rec_view">
          <h3> Add Backup Records Here </h3>
        </div>
        <!-- *************     End Backup Records View         ************** -->
      </div>
      <!-- **************      End Tab Content            ****************** -->
    </div>    <!-- end of Main Column -->
    <div class="col-sm-3"></div> <!-- end of third column -->
  </div>  <!-- end of Main Content -->
</div> <!-- end of container-fluid -->



<!--  ********             Drop Down Modal if needed               ********* -->
  <div class="modal fade" id="dropInModal" tabindex="-1" role="dialog" aria-labelledby="dropInModal" aria-hidden="true">
    <div class="modal-dialog incmodalwidth">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close clearFields" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <center><h3 class="modal-title" id="dropInModal">Drop Down Modal</h3></center>
        </div>
        <div class="modal-body">
        <!-- Add content Here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default clearFields" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    
  <!-- Load scripts last, speeds up loading --> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../assets/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="../model/global.js"></script>
  <script src="../model/calendar.js"></script>
  <script src="../control/handle_new_pat_prim_rec.js"></script>
  <script src="../control/handle_edit_pat_prim_rec.js"></script>


</body>

</html>