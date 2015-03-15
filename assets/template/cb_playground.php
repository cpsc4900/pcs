<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CB_Play</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>


<body>
<div class="container-fluid">
	
	<div class = "row"> <!-- Main Menu -->
		<div class="col-sm-2" style="background-color:lavender;">Section 1</div>
    	<div class="col-sm-6" style="background-color:lavenderblush;">Section 2</div>
    	<div class="col-sm-4" style="background-color:lavender;"> Section 3</div>
	</div>

	<?php
	echo "<h1>Welcome to the PCS project ! </h1>";
	?>
  
  <div class="row">  <!--  Main Content -->
    <div class="col-sm-2" style="background-color:lavender;">.col-sm-4</div>
    <div class="col-sm-6" style="background-color:lavenderblush;">
    <!-- **************      Play Here           ****************** -->
    <table class="table table-striped">
      <?php for ($i=0; $i < 10; $i++) { 
        echo "<tr><td>".$i."</td></tr>";
      }
      ?>
      <tr><td>
      <a href="#myModal" data-toggle="modal" data-target="#myModal" onclick="passData(11)">
        11:00am</a>
      </td></tr>
      
    </table>

    </div>
    <div class="col-sm-4" style="background-color:lavender;">
    </div>
  </div>  <!-- end of row -->
</div> <!-- end of container-fluid -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div id="insertHere"> </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="myFunction()">Save changes</button>
      </div>
    </div>
  </div>
</div>
  <!-- alert box -->
    <div class="alert alert-warning">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Warning!</strong> There was a problem with your network connection.

    </div>


  <!-- Load scripts last, speeds up loading -->	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script>
  function myFunction() {
    alert("You Clicked on Submit");
  }
  function passData(hour) {
    document.getElementById("insertHere").innerHTML = hour;
  }
  </script>

</body>

</html>

suggestive fill
<script>
  $(function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  });
  </script>