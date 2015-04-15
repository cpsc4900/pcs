/**
 * @file
 *
 * Hanles the sectioned sectioned_pat_model.php.
 * Displays sectioned patients
 */

var jsonSectionedPatients = "";
var jsonMedications = "";
var clinicID = "";

/**
 * On Document ready:  get list of sectioned patients, 
 *                     draw the daily appointments
 */
$(document).ready(function(){
    get_sectioned_patients();
    draw_sectioned_pat_table();
});


/**
 * Gets a list of the currently sectioned patients
 * @return {json} JSON parsed list of sectioned patients
 */
function get_sectioned_patients() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "https://pcs/control/handle_sectioned_patient.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("get_sectioned=true");
    jsonSectionedPatients = JSON.parse(xmlhttp.responseText);
}

/**
 * Draws the daily appointment table for the Doctor (Or Nurse)
 * @postcondition  the User's appoinment table is drawn.
 */
function draw_sectioned_pat_table() {
    if (jsonSectionedPatients == "") {
        return 0;
    }
    var table = "";
    for (var rec in jsonSectionedPatients) {
        table += '<tr onclick=\"displayMeds(' + jsonSectionedPatients[rec].PatientID + ')\" >';
        table += "<td>" + jsonSectionedPatients[rec].PatientID + "</td>";
        table += "<td>" + jsonSectionedPatients[rec].SSN + "</td>";
        table += "<td>" + jsonSectionedPatients[rec].Lname + "</td>";
        table += "<td>" + jsonSectionedPatients[rec].Fname + "</td>";
        table += "<td>" + jsonSectionedPatients[rec].Sex + "</td>";
        table += "<td>" + jsonSectionedPatients[rec].RoomNumber + "</td>";
        var dateSec = jsonSectionedPatients[rec].DateSectioned;
        dateSec = dateSec.substring(0,10);
        table += "<td>" + dateSec + "</td>";
        table += "</tr>";
    }
    $('#sec-pat-table-body').html(table);
}

/**
 * Displays the medical history of a patient
 * @param  {[type]} patID the id of the patient to display relevant medical history info
 *        
 */
function displayMeds(patID) {
    get_patient_medications(patID);
    set_patient_med_modal();
    $('#med-modal').modal(show = true);
}


function set_patient_med_modal(Fname, Lname) {
    var medTable = "";
    medTable = "<table class=\"table table-hover  table-condensed table-striped\" ";
    medTable += "id=\"med-table\">";

    for (var i in jsonMedications) {
        medTable += "<tr>"
        medTable += "<td>" + jsonMedications[i].CommonName + "</td>";
        medTable += "<td>" + jsonMedications[i].Dosage + " mg" + "</td>";
        medTable += "<td>" + jsonMedications[i].TimesPerDay + " per Day" + "</td>";
        medTable += "<td>" + jsonMedications[i].Side_Effects + "</td>";
    };
    medTable += "</table>";
    if (jsonMedications == null) {
        medTable = "No known Medications";
    }
    $('#med-modal-details').html(medTable);   
}


function get_patient_medications(patID) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "https://pcs/control/handle_sectioned_patient.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("get_medication=true&patID= " + patID);
    jsonMedications = JSON.parse(xmlhttp.responseText);
}
