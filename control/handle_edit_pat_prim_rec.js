/*-----  End of Handle New Patient Record  ------*/

// Searching variables
var searchType = "";              // holds the search type (ssn | lname | patid)
var jsonSearchResults = "";       // holds the returned value of a search

$(document).ready(function(){  // bind on page load

   $('#pat_table_search_results').hide();  // start without search results displayed
   $('#patient_edit_panel').hide();  // start without search results displayed

   
    // Handles the search by option
    $('#searchBy').children().click(function() {
        searchType = $(this).attr('id');                  // get search by value
        // change whats displayed in the button
        var displayValue = $(this).children().html();
        $('#searchCrit').html(displayValue + "<span class=\"caret\"></span>");
    });

    // submits a new search
    $('#submitSearch').click(function() {
        var searchValue = $('#searchForPatient').val();
        patientRecordSearch(searchValue);
    });

    $('#pat_panel_close').click(function() {
        $('#patient_edit_panel').slideUp();
    });

    $('#pat_table_search_close').click(function() {
        $('#pat_table_search_results').slideUp();
    });
});

/*===========================================================
=            Patient Record Search Functionality            =
===========================================================*/

/**
 * Ajax call for patient records
 * @param  {string} value the value to search for
 * @postcondition It there is a match, results are drawn into a table and displayed
 *                otherwise displays an alert saying no matches were found
 */
function patientRecordSearch(value) {
    if (value == "") {
        alert("Please Enter a Value to Search for");
        return 0;
    }
    if (searchType =="") {
        alert("Please select the appropiate \"Search By\" criteria");
    }
    queryForPrimaryRecords(searchType, value);
    drawSearchResultsTable();
}

// gets a JSON of matched search
function queryForPrimaryRecords(criteria, value) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://pcs/control/handle_edit_pat_rec.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("criteria="+ criteria+"&value="+value);
    jsonSearchResults = JSON.parse(xmlhttp.responseText);
}

/**
 * Checks if any searches rendered a match.  If so, calls formatJsonToTable() and
 * "draws" the search result table into 'pat_search_tbody'
 * @return {[type]} [description]
 */
function drawSearchResultsTable() {
    var newTable = formatJsonToTable();
    // Did the search return a result ?
    if (newTable != "" && newTable != null) {       // Yes, so draw table and show it
        $('#pat_search_tbody').html(newTable);
        $('#pat_table_search_results').fadeIn("slow");
    } else {                                        // No, so hide table, alert user
        $('#pat_table_search_results').hide();
        alert("No Patient Record matches your search.");
    }
}

/**
 * Creates a table listing the patient's primary record along with their address.
 * Used incase a search yields more than one result
 * @return {<table>} Returns a table, including an edit button for each record.
 */
function formatJsonToTable() {
    var newTable = "";
    for(var record in jsonSearchResults) {
        newTable += "<tr>";
        newTable += "<td id=\"pat_search_id\">";
        newTable += jsonSearchResults[record].PatientID + "</td>";
        newTable += "<td id=\"pat_search_fname\">"; 
        newTable += jsonSearchResults[record].Fname + "</td>";
        newTable += "<td id=\"pat_search_lname\">"; 
        newTable += jsonSearchResults[record].Lname + "</td>";
        newTable += "<td id=\"pat_search_ssn\">"; 
        newTable += jsonSearchResults[record].SSN + "</td>";
        newTable += "<td id=\"pat_search_bday\">"; 
        newTable += jsonSearchResults[record].Birthdate + "</td>";
        newTable += "<td id=\"pat_search_sex\">"; 
        newTable += jsonSearchResults[record].Sex + "</td>";
        newTable += "<td id=\"pat_search_street\">"; 
        newTable += jsonSearchResults[record].Street + "</td>";
        newTable += "<td id=\"pat_search_city\">"; 
        newTable += jsonSearchResults[record].City + "</td>";
        newTable += "<td id=\"pat_search_state\">"; 
        newTable += jsonSearchResults[record].State + "</td>";
        newTable += "<td id=\"pat_search_zip\">"; 
        newTable += jsonSearchResults[record].Zip + "</td>";
        newTable += "<td><button id=\"edit_pat_rec\" type=\"button\""; 
        // Nasty, but it works
        newTable += "class= \"btn btn-primary btn-success btn-xs\"";
        newTable += "onclick=\"edit_patient_record(" + record;
        newTable += ")\">";
        newTable += "Edit</button></td>";
        newTable += "</tr>";
    }
    return newTable;
}
/*-----  End of Patient Record Search Functionality  ------*/


/*=============================================================
=            Handle Editing Patient Primary Record            =
=============================================================*/

// binds event to the edit buttons produced from a search result
function edit_patient_record(pat_rec) {
    set_edit_fields(pat_rec);
    $('#patient_edit_panel').slideDown("slow");
}

// sets the edit fields of the Edit panel.  The edit panel appears ONLY if
// a search returns a result, AND the user clicks on the "Edit" button.
function set_edit_fields(pat_rec) {
    console.dir(jsonSearchResults);
    $('#edit_patid').val(jsonSearchResults[pat_rec].PatientID);
    $('#edit_firstName').val(jsonSearchResults[pat_rec].Fname);
    $('#edit_lastName').val(jsonSearchResults[pat_rec].Lname);
    $('#edit_patSSN').val(jsonSearchResults[pat_rec].SSN);
    $('#edit_patBday').val(jsonSearchResults[pat_rec].Birthdate);
    $('#edit_patStAdd').val(jsonSearchResults[pat_rec].Street);
    $('#edit_patCity').val(jsonSearchResults[pat_rec].City);
    $('#edit_patState').val(jsonSearchResults[pat_rec].State);
    $('#edit_patZip').val(jsonSearchResults[pat_rec].Zip);
    if (jsonSearchResults[pat_rec].Sex == "male") {
        $('#edit_maleChk').attr("checked", "checked");
    } else {
        $('#edit_femaleChk').attr("checked", "checked");
    }
}

/**
 * Updates the newly edited Patient Record. Returns an alert window upon success
 * or failure. On completion, closes the edit and search results panels
 */
function handle_edit_pat_record() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://pcs/control/handle_edit_pat_rec.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    
    var url_string = "";
    url_string += "patid=" +  $('#edit_patid').val(); 
    url_string += "&fname=" + $('#edit_firstName').val(); 
    url_string += "&lname=" + $('#edit_lastName').val(); 
    url_string += "&ssn=" + $('#edit_patSSN').val(); 
    url_string += "&bday=" + $('#edit_patBday').val(); 
    url_string += "&street=" + $('#edit_patStAdd').val(); 
    url_string += "&city=" + $('#edit_patCity').val(); 
    url_string += "&state=" + $('#edit_patState').val(); 
    url_string += "&zip=" +  $('#edit_patZip').val(); 
    url_string += "&phoneNum=" + "1234565555";

    // gender check box
    var gender = "";
    if ($('#edit_maleChk').attr("checked") == "checked") {
        gender = "male";
    } else {
        gender = "female";
    }
    url_string += "&gender=" + gender;

    // submit post
    xmlhttp.send(url_string);
    var result = xmlhttp.responseText;
    result = result.trim();
    if (result == "success") {
        alert("Patient Primary Record Updated!");
    } else {
        alert("Patient Primary Record was NOT Updated!");
    }

   $('#patient_edit_panel').slideUp();  // close search results displayed
   $('#pat_table_search_results').slideUp();  // close search results displayed
}

/*-----  End of Handle Editing Patient Primary Record  ------*/