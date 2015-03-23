/**
 * Handles New Allergy Modal.
 * Dependency:  handle_medical_rec_search.js
 *              handle_new_allergy.php
 *              new_allergy_model.php
 */

$(document).ready(function() {
    $('#setValueButton').click(function(event) {
        if ($('#allergyName').val() == "") {
            $('#form-group-new-allergy').toggleClass('has-error');
        } else {
            submitNewAllergy();
        }
    });

});



// handles the submission of a new allergy
function handleNewAllergySubmission() {
    var allergyName = $('#allergyName').val();
    var severity = $("input:radio[name='severity']:checked").val();
    var isSubmitted = submitAllergy(allergyName, severity);
    if (isSubmitted == "success") {
        alert("Allergy has been added to the Patient's Records");
    } else {
        alert("Error: Allergy has not been added.");
    }
    $('#allergyName').val() == "";
}

// passes the new allergy to handle_new_allergy.php to add it to the database
// Note: jsonMedicalRecords is pulled from handle_medical_rec_search.js
function submitAllergy(allergyName, severity) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://pcs/control/handle_new_allergy.php", true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("allergyName=" + allergyName + "&severity=" + severity + 
                 "&patid=" + jsonMedicalRecords[0].PatientID);
    var response = xmlhttp.responseText;
    return response;
}