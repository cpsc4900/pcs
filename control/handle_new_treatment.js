var treatType = "";
var jsonDocList = "";
var xmlReq = new XMLHttpRequest();
var currentPatientID = ""; // pulled from handle_medical_rec_search.js

$(document).ready(function(){



    hideAllSubFields();

    // Handles the search by option
    $('#treat-options').children().click(function() {
        treatType = $(this).attr('id');                  // get search by value
        hideAllSubFields();

        // toggle selected type of treatment
        switch(treatType) {
            case "medication":
                $('#main-medication-form-group').show('fast');
                break;
            case "doc-referral":
                $('#main-referral-form-group').show('fast');
                getDocList();
                drawDocList();
                break;
            case "therapy":
                $('#main-therapy-form-group').show('fast');
                break;
        }
        // change whats displayed in the button
        var displayValue = $(this).children().html();
        $('#treat-options-btn').html(displayValue + "<span class=\"caret\"></span>");
    });

    // Handles new Treatment submission
    $('#submitNewTreat').click(function(event) {
        currentPatientID = $('#gen-info-patID').val();
        console.log("currPatientID=" + currentPatientID);
        console.log("treatType=" + treatType);
        switch(treatType) {
            case "therapy":
                submitNewTherapyTreat();
                break;
            case "medication":
                submitNewMedicationTreat();
                break;
            case "doc-referral":
                submitNewReferralTreat();
                break;
        }
        hideAllSubFields();
    });
    
});

/*=============================================================================
=                           View Functionality                                =
==============================================================================*/

/**
 * Toggles between the different Treatment Options.  Options are medication |
 * therapy | doctor referral
 */
function hideAllSubFields() {
    $('#main-medication-form-group').hide('fast');
    $('#main-referral-form-group').hide('fast');
    $('#main-therapy-form-group').hide('fast');
}


/**
 * Gets all the doctors at every clinic location and stores them in jsonDocList.
 * Each field in the list includes Fname, Lname, and the EmployeeID.  This function
 * is meant to be used for the doctor referral.
 *
 * @postcondition: jsonDocList is updated.
 */
function getDocList() {
    xmlReq.open("POST", "https://pcs/control/handle_new_treatment.php", false);
    xmlReq.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlReq.send("getDocList=" + "true" );
    jsonDocList = JSON.parse(xmlReq.responseText); 
}

/**
 * Adds the jsonDocList to the drop down list of doctors.
 *
 * @precondition Doctor Referral must be selected from the Treatment Options 
 *               drop-down menu.
 */
function drawDocList() {
    var ulOfDocs = "";
    for (var i in jsonDocList) {
        ulOfDocs += "<li class=\"doc-list\"><a tabindex=\"-1\"";
        ulOfDocs += "href=\"#\" onclick=\"selectedDocID(";
        ulOfDocs +=  "\'" + jsonDocList[i].Fname + "\',\'" + jsonDocList[i].Lname + "\',\'"; 
        ulOfDocs +=  jsonDocList[i].EmployeeID + "\')\">";
        ulOfDocs +=  jsonDocList[i].Lname + ", " + jsonDocList[i].Fname +"</a></li>";
    }
    console.log(ulOfDocs);
    $('#doc-referral-list').html(ulOfDocs);
}

/**
 * Fills the doctor referral fields.
 */
function selectedDocID(docFname, docLname, docID) {
    $('#docRefFname').val(docFname);
    $('#docRefLname').val(docLname);
    $('#docRefID').val(docID);
}
/*-----               End of View Functionality                         ------*/


/*==============================================================================
=                           Handle New Treatment Submission                    =
==============================================================================*/

function submitNewReferralTreat() {
    var sendReq = generalSubmissionInfo();
    var docFname = $('#docRefFname').val();
    var docLname = $('#docRefLname').val();

    if (docFname == "" || docLname == "") {
        alert("from refPlease fill out all fields with valid values");
        return;        
    }
    sendReq += "&treats=Referral";
    sendReq += "&duration=na";
    sendReq += "&docRefID=" + $('#docRefID').val();
    sendReq += "&docLname=" + docLname;
    sendReq += "&docFname=" + docFname;

    updateTreatmentTable(sendReq);
}

function submitNewTherapyTreat() {
    var sendReq = generalSubmissionInfo();
    var descript = $('#therapyDescript').val();
    var duration = $('#therapyDuration').val();
    
    // make sure we have some values
    if ((descript == "" || typeof descript != 'string')  || 
        (duration == "" || typeof duration != 'string')) {
        alert("from therapy Please fill out all fields with valid values");
        return;
    }
    sendReq += "&therapy=\"true\"";
    sendReq += "&therapyDescript=" + descript;
    sendReq += "&therapyDuration=" + duration;
    updateTreatmentTable(sendReq);
}

function submitNewMedicationTreat() {
    var sendReq = generalSubmissionInfo();
    var name = $('#medCommonName').val();
    var sideEffects = $('#sideEffects').val();
    var dosage = $('#dosage').val();
    var timesPerDay = $('#timesPerDay').val();
    var docID = $('#prescribingDoc').val();
    console.log("name=" + name);
    console.log("sideEffects=" + sideEffects);
    console.log("dosage=" + dosage);
    console.log("docID=" + docID);

    if(name == "" || sideEffects == "" || dosage == "" || docID == "") {
        alert("Please fill out all fields with valid values");
        return;
    }
    sendReq += "&medCommonName=" + name;
    sendReq += "&sideEffects=" + sideEffects;
    sendReq += "&dosage=" + dosage;
    sendReq += "&timesPerDay=" + timesPerDay;
    sendReq += "&docID=" + docID;
    updateTreatmentTable(sendReq);
}

function generalSubmissionInfo() {
    var sendReq = "patid=" + currentPatientID;
    var diagnosis = $('#diagnosis').val();
    var descript = $('#description').val();
    if (diagnosis == "") {
        diagnosis = "na";
    }
    if (descript == "") {
        descript = "na";
    }
    sendReq += "&diagnosis=" + diagnosis; 
    sendReq += "&descript=" + descript;
    return sendReq;
}

function updateTreatmentTable(urlData) {
    xmlReq.open("POST", "https://pcs/control/handle_new_treatment.php", false);
    xmlReq.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlReq.send(urlData);
    result = xmlReq.responseText;
    console.log(result); 
}

/*-----               End of Handle New Treatment Submission            ------*/



/**********
 * Doc fields
 *
 * diagnosis
 * description
 *
 * treat-options-btn : doc-referral | medication | therapy
 *
 * for meds:
 * medCommonName
 * sideEffects
 * dosage
 * timesPerDay
 * prescribingDoc
 *
 * for doc-referral
 * doc-ref-btn (to be filled by js)
 *     ul -> doc-referral-list
 *
 * docRefFname
 * docRefLname
 *
 * for therapy:
 * therapyDescript
 */