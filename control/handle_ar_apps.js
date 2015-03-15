var numberOfApps = 0;

$(document).ready(function(){
    // Clears fields in the New Appointment form (app_form.php)
    $("#formCancel").click(function(){
        $('input').val('');
    });

    $("#autofill").click(function(){
        var pat_id = $('#pat_id').val();
        autoFillAppForm(pat_id);
    });

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

  numberOfApps = numOfApps;

  // Display date and time in app_form
  var appDate = new Date(yr, mnth, day, time);
  document.getElementById("AddApp").firstChild.nodeValue = "Appointment Details for " +
                                    appDate.toDateString() + " " + formatTime(time);

  // Add mySQL formatted datetime param to app_form hidden time field
  var appDates = formatDateTime(yr, mnth, day, time);
  document.getElementById("appDate").value = appDates;

  if (numberOfApps == 3) {
    $('#addAppForm').hide();
  }
}

function docIdSelect(docID) {
    document.getElementById("doc_id").value = docID;
}

function autoFillAppForm(pat_id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://pcs/model/ar_patient_list.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("getPatName="+pat_id);
    var jsonFullName = JSON.parse(xmlhttp.responseText);
    console.dir(jsonFullName);
    $('#fname').val(jsonFullName['Fname']);
    $('#lname').val(jsonFullName['Lname']);

}


function getPatients() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://pcs/model/ar_patient_list.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("patreq="+"patreq");
    jsonMonthApps = JSON.parse(xmlhttp.responseText);
}