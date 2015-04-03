/**
 * @file
 *
 * Handles the new appointment form (model/app_form.php),the
 * appointment table (model/ar_app_table.php) models. Also, uses
 * model/ar_patient_list.php and the calendar generated from
 * model/calendar.js.
 * 
 */

var availablePatSSN = new Array(); /*!< available patient SSN, used for autocomplete in search field */
var currAppsPerHour = new Array(); /*!< array of current appointments belonging to the current hour */
var jsonAppsPerHour;               /*!< a JSON formatted appointment list of the current hour */
var jsonPatInfo;                   /*!< Stores Patient Info found after a SSN match has been found*/
var searchByCriteria = "";         /*!< Not used*/
var thisDateTime ="";              /*!< The time to use for the new apointment form. Note, this value is passed by the Calendar onclick*/

$(document).ready(function(){
    // Clears fields in the New Appointment form (app_form.php)
    $("#formCancel").click(function(){
        $('input').val('');
    });

    $(".clearFields").click(function(){
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

    // bind: deleting appointment from current appointment table
    $('.delApp').click(function() {
      var this_app_entry = $(this).parent().parent();
      var appointment_id = this_app_entry.find('#app_id');
      removeAndUpdateAppTable(appointment_id.html());
    });
    

});  //-- end of document ready

/*========================================
=            Make this Global            =
========================================*/

/**
 * Removes an element by id or class and all of its children.
 * Used to remove rows from the appointment table if there is
 * less than 3 appointments
 */
Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = 0, len = this.length; i < len; i++) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}
/*-----  End of Make this Global  ------*/



/*==============================================================================
=                   Current Appointment Edit and Delete                        =
==============================================================================*/
// gets a JSON of appointments for the current hour being displayed
function getApps(datetime) {
    thisDateTime = datetime;            // update datetime for refreshing
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "https://pcs/model/ar_patient_list.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("datetime="+ datetime);
    jsonAppsPerHour = JSON.parse(xmlhttp.responseText);
}

// draws the appointment table.  Must be redrawn on app removal
function drawAppTable() {
  var idTable = new Array('first_app', 'second_app', 'third_app');
  var inc = 0, i = 1;
  var tdEl;
  // add appointments
  for (var field in jsonAppsPerHour) {
    document.getElementById(idTable[inc]).style.display = "";
    console.log("in first loop idTable[" + inc + "] = " + idTable[inc]);
    document.getElementById(idTable[inc]).childNodes[i].innerHTML = 
              jsonAppsPerHour[field].PatientID;
    i += 2;
    document.getElementById(idTable[inc]).childNodes[i].innerHTML = 
              jsonAppsPerHour[field].Fname;
    i += 2;
    document.getElementById(idTable[inc]).childNodes[i].innerHTML = 
              jsonAppsPerHour[field].Lname;
    i += 2;
    document.getElementById(idTable[inc]).childNodes[i].innerHTML = 
              jsonAppsPerHour[field].DocFullName;
    i += 2;
    document.getElementById(idTable[inc]).childNodes[i].innerHTML = 
              jsonAppsPerHour[field].EmployeeID;
    i += 2;
    document.getElementById(idTable[inc]).childNodes[i].innerHTML = 
              jsonAppsPerHour[field].AppointmentID;
    
    inc += 1;
    i = 1;
  }
  if (inc < 3) {                             // have all table rows been filled?
      for (var i = 2;i >= inc; i--) {
        document.getElementById(idTable[i]).style.display = "none";
      }
  }
}

// removes an appointment from both the database and the website
function removeAndUpdateAppTable(app_id) {

  var result = removeAppFromDatabase(app_id);
  console.log("result = " + result);
  alert("Appointment has been removed");
  if (result == "success") {
  }
  if (result == "failed") {
    alert("Unable to remove the appointment");
  }
  getApps(thisDateTime);            // redraw table
  drawAppTable();
  createCalendar(year, month, "calendar_matrix");
}

// removes app from database, returns "success" or  "failed"
function removeAppFromDatabase(app_id) {
  console.log("removeAppFrom(app_id) =" + app_id);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "https://pcs/model/ar_patient_list.php", false);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send("removeApp="+ app_id);
  return xmlhttp.responseText;
}

/*------------   End of Current Appointment Edit and Delete    ---------------*/
/*==============================================================================
=                         Adding  Appointments                                 =
==============================================================================*/
// Recieves a Date object
// binded to each active hour in the calendar
function passAppTime(yr, mnth, day, time, numOfApps) {

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
  getApps(appDates);  // get the appointments belonging to this hour
  drawAppTable();     // draw current appointments table into app modal
}

function docIdSelect(docID) {
    document.getElementById("doc_id").value = docID;
}

// auto fills the new app form IF a SSN match is found in the search bar
function autoFillAppForm(pat_ssn) {
    for (var field in jsonPatInfo) {
      if (jsonPatInfo[field].SSN == pat_ssn) {
        document.getElementById("app-fname").value = jsonPatInfo[field].Fname;
        document.getElementById("app-lname").value = jsonPatInfo[field].Lname;
        document.getElementById("app-pat_id").value = jsonPatInfo[field].PatientID;
      }
    }
}
// gets a JSON of all patient ID, Lname, and SSN. For searching
function getPatients() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "https://pcs/model/ar_patient_list.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("patreq="+"patreq");
    localjsonPatInfo = JSON.parse(xmlhttp.responseText);
    jsonPatInfo = localjsonPatInfo;
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



/*--------------------  End of Adding  Appointments  -------------------------*/



