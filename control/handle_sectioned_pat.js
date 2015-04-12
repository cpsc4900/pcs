var jsonSectionedPatients = "";
var jsonMedications = "";

$(document).ready(function(){
    get_sectioned_patients();
    draw_sectioned_pat_table();
});


function get_sectioned_patients() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "https://pcs/control/handle_sectioned_patient.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("get_sectioned=true");
    jsonSectionedPatients = JSON.parse(xmlhttp.responseText);

}


function draw_sectioned_pat_table() {
    if (jsonSectionedPatients == "") {
        return 0;
    }
    var table = "";
    for (var rec in jsonSectionedPatients) {
        table += '<tr onclick=\"displayMeds(' + jsonSectionedPatients[rec].PatientID + ')\" >';
        table += "<td>" + jsonSectionedPatients[rec].PatientID + "</td>";
        table += "<td>" + jsonSectionedPatients[rec].Lname + "</td>";
        table += "<td>" + jsonSectionedPatients[rec].Fname + "</td>";
        table += "<td>" + jsonSectionedPatients[rec].Birthdate + "</td>";
        table += "<td>" + jsonSectionedPatients[rec].Sex + "</td>";
        table += "</tr>";
    }
    $('#sec-pat-table-body').html(table);
}

function displayMeds(patID) {
    console.log('hello');
    displayPatientInfo(patID);
}

//function get_medications()