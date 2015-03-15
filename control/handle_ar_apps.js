var availablePatSSN = new Array();
var jsonPatInfo;
var searchByCriteria = "";

$(document).ready(function(){
    // Clears fields in the New Appointment form (app_form.php)
    $("#formCancel").click(function(){
        $('input').val('');
    });


    $("#autofill").click(function(){
        var pat_ssn = $('#searchBar').val();
        if (pat_ssn != "") {
          autoFillAppForm(pat_ssn);
        } else {
          alert("Search Bar is Empty, Please Enter a Social Security Number to" +
                 " search for the Patient's corresponding information");
        }
    });

    // searching capabailities: REUSE THIS !!!!
    $("#searchBar").autocomplete({
        source: availablePatSSN
    });
    $( "#searchBar" ).autocomplete( "option", "appendTo", ".eventInsForm" );
    

});  //-- end of document ready




// ----------------------  Adding and Deleting Appointments -------------------


// Recieves a Date object
// binded to each active hour in the calendar
function passAppTime(yr, mnth, day, time, numOfApps) {
  console.log("passed year =" + yr);
  console.log("passed month =" + mnth);
  console.log("passed day =" + day);
  console.log("passed time = " + time);
  console.log("passed apps = " + numOfApps);


  // Display date and time in app_form
  var appDate = new Date(yr, mnth, day, time);
  document.getElementById("AddApp").firstChild.nodeValue = "Appointment Details for " +
                                    appDate.toDateString() + " " + formatTime(time);

  // Add mySQL formatted datetime param to app_form hidden time field
  var appDates = formatDateTime(yr, mnth, day, time);
  document.getElementById("appDate").value = appDates;

  if (numOfApps == 3) {
    $('#addAppForm').hide();
  } else {
    $('#addAppForm').show();
  }

  getPatients();  // populate patient arrays for searching (see arrays at top)
}

function docIdSelect(docID) {
    document.getElementById("doc_id").value = docID;
}

// auto fills the new app form IF a SSN match is found in the search bar
function autoFillAppForm(pat_ssn) {
    for (var field in jsonPatInfo) {
      if (jsonPatInfo[field].SSN == pat_ssn) {
        document.getElementById("fname").value = jsonPatInfo[field].Fname;
        document.getElementById("lname").value = jsonPatInfo[field].Lname;
        document.getElementById("pat_id").value = jsonPatInfo[field].PatientID;
      }
    }
}


// gets a JSON of all patient ID, Lname, and SSN. For searching
function getPatients() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://pcs/model/ar_patient_list.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("patreq="+"patreq");
    localjsonPatInfo = JSON.parse(xmlhttp.responseText);
    jsonPatInfo = localjsonPatInfo;
    console.dir(jsonPatInfo);
    fillSearchArrays(localjsonPatInfo);
}

// gets the JSON data and places each field in an array for searching
function fillSearchArrays(jsonPatInfo) {
  var inc = 0;
  for (var i in jsonPatInfo) {
    availablePatSSN[inc] = jsonPatInfo[i].SSN;
    inc += 1;
  }
}