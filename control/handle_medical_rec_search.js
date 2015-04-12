// Global variables
var searchByCriteria = "";
var searchForValue = "";
var jsonIDRecords = "";
var jsonMedicalRecords = "";
var globalCurrentPatientID = "";
var xmlhttpSearchRequest = new XMLHttpRequest();

/*==============================================================================
=                          Document Ready Binding                              =
==============================================================================*/

$(document).ready(function(){

  $('#pat_table_med_search_results').hide();          // begin with table hidden

  // Handles the search by option
  $('#searchByVal').children().click(function() {
      searchType = $(this).attr('id');                  // get search by value
      // change whats displayed in the button
      var displayValue = $(this).children().html();
      $('#searchMedCrit').html(displayValue + "<span class=\"caret\"></span>");
      updateSearchByHiddenField(searchType);
  });

  // search submit button
  $('#submit-search-button').click(function() {
      searchForValue = $('#searchForPatientMedValue').val();
      searchByCriteria = $('#search-by').val();
      if (errorCheck(searchByCriteria, searchForValue)) {
        getSearchResults();
        drawSearchResults();
      }
  });

  // close the search results
  $('#pat_table_med_search_close').click(function() {
    $('#pat_table_med_search_results').slideUp("slow");
  });

  // add new allergy
  $('#new-allergy-option').click(function(){
    // make sure a patient's record is open before adding a new allergy
    var patientssn = $('#gen-info-ssn').html();
    if (patientssn == "") {
      $('#newAllergyModel').modal('toggle');  // close modal before it opens
      alert("No Patient Record is open! Please search for a patient" +
            "\n or add a new Patient Identity Record first");
    }
  });

});

/*----------------      End of Document Ready Binding         ----------------*/

/*==============================================================================
=                          Patient Med Rec Search                              =
==============================================================================*/

// set hidden searchBy input
function updateSearchByHiddenField(searchType) {
  $('#search-by').val(searchType);
}

// Searches for medical records by either SSN | Lname | PatID
function getSearchResults() {
    xmlhttpSearchRequest.open("POST", "https://pcs/model/search_for_med_recs.php", false);
    xmlhttpSearchRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttpSearchRequest.send("searchBy=" + searchByCriteria + "&searchValue=" + 
                  searchForValue);
    jsonIDRecords = JSON.parse(xmlhttpSearchRequest.responseText); 
}


// This is the proper way to handle AJAX...Make it work son !!!
/*xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("searchBy=" + searchByCriteria + "&searchValue=" + 
                      searchForValue);
        jsonIDRecords = JSON.parse(xmlhttp.responseText); 
        
      }
}*/

// Basic null check for searchByCriteria
function errorCheck(searchBy, searchValue) {
  if (searchBy == "" || searchBy == null) {
    alert("The \"Search By\" option must be selected first");
    return false;
  } 
  if (searchValue == "") return false;
  return true;
}

// draws the results from a search
function drawSearchResults() {
  var resultTable = formatRecToTable;
  $('#pat_med_search_results').html(resultTable);
  $('#pat_table_med_search_results').show("slow");
}

/**
 * Creates a table listing the patient's primary record.
 * Used incase a search yields more than one result
 * @return {<table>} Returns a table, including an select button for each record.
 */
function formatRecToTable() {
    var newTable = "";
    var isSec = "No";
    for(var record in jsonIDRecords) {
        if (jsonIDRecords[record].isSectioned == 0) {
          isSec = "No";
        } else {
          isSec = "Yes";
        }
        newTable += "<tr>";
        newTable += "<td id=\"pat_search_id\">";
        newTable += jsonIDRecords[record].PatientID + "</td>";
        newTable += "<td id=\"pat_search_fname\">"; 
        newTable += jsonIDRecords[record].Fname + "</td>";
        newTable += "<td id=\"pat_search_lname\">"; 
        newTable += jsonIDRecords[record].Lname + "</td>";
        newTable += "<td id=\"pat_search_ssn\">"; 
        newTable += jsonIDRecords[record].SSN + "</td>";
        newTable += "<td id=\"pat_search_bday\">"; 
        newTable += jsonIDRecords[record].Birthdate + "</td>";
        newTable += "<td id=\"pat_search_sex\">"; 
        newTable += jsonIDRecords[record].Sex + "</td>";
        newTable += "<td id=\"pat_search_is_sec\">"; 
        newTable += isSec + "</td>";
        newTable += "<td><button id=\"edit_pat_rec\" type=\"button\""; 
        // Nasty, but it works
        newTable += "class= \"btn btn-primary btn-success btn-xs\"";
        newTable += "onclick=\"selectedPatient(";
        newTable += jsonIDRecords[record].PatientID;
        newTable += ")\">";
        newTable += "Select</button></td>";
        newTable += "</tr>";
    }
    return newTable;
}
/*----------------      End of Patient Med Rec Search         ----------------*/

/*==============================================================================
=                          Medical Record Display                              =
==============================================================================*/

// Searches for medical records by id, 
// then places result in global jsonMedicalRecords
function getJsonMedRecords(patid) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "https://pcs/model/search_for_med_recs.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("patid=" + patid);
    jsonMedicalRecords = JSON.parse(xmlhttp.responseText);
}

// Main Call from selected patient search results
function selectedPatient(patid) {
  $('#pat_table_med_search_results').slideUp("slow");
  globalCurrentPatientID = patid;
  getJsonMedRecords(patid);
  var numOfAll = countAllergiesInJson();
  var numOfTreats = countTreatmentsInJson();
  var numOfMeds = countMedicationsInJson();
  

  showPatientGeneralInfo();                       // display gen info of patient
  showPatientKnownAllergies(numOfAll);            // display known allergies
  showPatientPreviousTreatments(numOfAll, numOfTreats, numOfMeds);
}

/************************************
 * Fills Patient's General Information in medical_record_model.php
 * 
 */
function showPatientGeneralInfo() {
  // format name
  var formattedName = formatPatName(jsonMedicalRecords[0].Fname, 
                                    jsonMedicalRecords[0].Lname);
  $('#gen-info-patID').val(jsonMedicalRecords[0].PatientID);
  $('#gen-info-patName').html(formattedName);
  $('#gen-info-ssn').html("<b>SSN:</b>  " + jsonMedicalRecords[0].SSN);
  $('#gen-info-birthday').html("<b>Birthdate:</b>  " +  
                                jsonMedicalRecords[0].Birthdate);
  $('#gen-info-gender').html("<b>Gender:</b>  " +
                                jsonMedicalRecords[0].Sex); 
  $("#gen-info-phoneNum").html("<b>Phone Number:</b>  " +
                                jsonMedicalRecords[0].PhoneNum);
  $('#address-header').html("<b>Address:</b>");
  $("#gen-info-street").html(jsonMedicalRecords[0].Street);
  $("#gen-info-rest-of-address").html(formatAddress());
} 

/************************************
 * Fills Patient's Known Allergies in medical_record_model.php
 * 
 */
function showPatientKnownAllergies(numOfAll) {
  if (numOfAll == 0) {   // no allergies
    $('#patient-known-allergies').html("<h5>No known Allergies</h5>");
    return;
  }
  var drawAllergies ="";

  drawAllergies += "<dl class=\"dl-horizontal\">";  
  for (var i = 1; i < (numOfAll + 1); i++) {  // skip patient primary record and go
    drawAllergies += " <dt>(" + i + ") Allergy: " + jsonMedicalRecords[i].AllergyName + "</dt>";  
    drawAllergies += " <dd>Severity: " + jsonMedicalRecords[i].Severity + "</dd>";
  }
  drawAllergies += "</dl>"; 
  $('#patient-known-allergies').html(drawAllergies);
}


/************************************
 * Fills Patient's Previous Treatments in medical_record_model.php
 * 
 */
function showPatientPreviousTreatments(numOfAll, numOfTreats, numOfMeds) {
  numOfAll += 1;                                     // compensate for id record
  numOfTreats += numOfAll;                            // set offset
  numOfMeds += numOfTreats;                           // set offset
  var drawTreats = "";
  for (var i = numOfAll; i < numOfTreats; i++) {
    drawTreats += "<dt>Diagnosis</dt>";
    drawTreats += "<dd>" + jsonMedicalRecords[i].Diagnosis + "</dd>";
    drawTreats += "<dt>Description of Symptons/Diagnosis</dt>";
    drawTreats += "<dd>" + jsonMedicalRecords[i].Description + "</dd>";
    drawTreats += "<dt>Treatment</dt>";
    drawTreats += "<dd>" + jsonMedicalRecords[i].Treats + "</dd>";
    drawTreats += "<dt>Duration of Treatment</dt>";
    drawTreats += "<dd>" + jsonMedicalRecords[i].Duration + "</dd>";
    drawTreats += "<dt>Date Diagnosed</dt>";
    drawTreats += "<dd>" + jsonMedicalRecords[i].DateDiagnosed + "</dd>";
    drawTreats += "<dt>Record Submitted by (Employee ID)</dt>";
    drawTreats += "<dd>" + jsonMedicalRecords[i].EmployeeID + "</dd>";
    drawTreats += "<hr>";
  }
  for (var i = numOfTreats; i < numOfMeds; i++) {
    var currentlyOnMed = "No";
    if (jsonMedicalRecords[i].ActiveRx == 1) {
      currentlyOnMed = "Yes";
    }
    drawTreats += "<dt>Medication's Common Name</dt>";
    drawTreats += "<dd>" + jsonMedicalRecords[i].CommonName + "</dd>";
    drawTreats += "<dt>Known Side Effects</dt>";
    drawTreats += "<dd>" + jsonMedicalRecords[i].Side_Effects + "</dd>";
    drawTreats += "<dt>Perscribed Dosage</dt>";
    drawTreats += "<dd>" + jsonMedicalRecords[i].Dosage + "</dd>";
    drawTreats += "<dt>Times per Day</dt>";
    drawTreats += "<dd>" + jsonMedicalRecords[i].TimesPerDay + "</dd>";
    drawTreats += "<dt>Currently taking Medication?</dt>";
    drawTreats += "<dd>" + currentlyOnMed + "</dd>";
    drawTreats += "<hr>";
  }
  // No data to show
  if (drawTreats == "") {
    drawTreats = "<h5>No previous treatments to be displayed</h5>";
  }
  $('#patient-prev-treatments').html(drawTreats);
}

/*===============  Med Record Display Helper Functions  ================*/

// formats the patient's name for displaying
function formatPatName(fname, lname) {
  return "<b>Name:</b>    " + lname + ", " + fname;
}

// formats the address
function formatAddress() {
  var returnAddress ="";
  returnAddress = jsonMedicalRecords[0].City + ", " + 
                  jsonMedicalRecords[0].State + "   " +
                  jsonMedicalRecords[0].Zip;
  return returnAddress;
}
// counts the number of Allergies in the jsonMedicalRecords
function countAllergiesInJson() {
  var numOfAllergies = 0;
  for (var field in jsonMedicalRecords) {
    if (jsonMedicalRecords[field].hasOwnProperty('AllergyID')) {
      numOfAllergies += 1;
    }
  }
  return numOfAllergies;
}

// counts the number of Treatments in the jsonMedicalRecords
function countTreatmentsInJson() {
  var numOfTreatments = 0;
  for (var field in jsonMedicalRecords) {
    if (jsonMedicalRecords[field].hasOwnProperty('TreatmentID')) {
      numOfTreatments += 1;
    }
  }
  return numOfTreatments;
}

// counts the number of Medications in the jsonMedicalRecords
function countMedicationsInJson() {
  var numOfMedications = 0;
  for (var field in jsonMedicalRecords) {
    if (jsonMedicalRecords[field].hasOwnProperty('MedicationID')) {
      numOfMedications += 1;
    }
  }
  return numOfMedications;
}

/*==========  End Med Record Display Helper Functions  ==========*/


// ----- for testing
/*function testPrintJson() {
  console.log(jsonMedicalRecords[0].Fname);
  var numOfAll = countAllergiesInJson();
  console.log("numOfAll = " + numOfAll);
  var numOfTreatments = countTreatmentsInJson();
  console.log("numOfTreatments = " + numOfTreatments);
  var numOfMedications = countMedicationsInJson();
  console.log("numOfMedications = " + numOfMedications);
}*/



/*----------------      End of Medical Record Display         ----------------*/