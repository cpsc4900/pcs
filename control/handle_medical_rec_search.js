// Global variables
var searchByCriteria = "";
var searchForValue = "";
var jsonIDRecords = "";
var jsonMedicalRecords = "";


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
      console.log("searchForValue = " + searchForValue);
      searchByCriteria = $('#search-by').val();
      console.log("searchByCriteria = " + searchByCriteria);

      if (errorCheck(searchByCriteria, searchForValue)) {
        getSearchResults();
        drawSearchResults();
      }
  });

  // close the search results
  $('#pat_table_med_search_close').click(function() {
    $('#pat_table_med_search_results').slideUp("slow");
  });

});  //-- end of document ready


// set hidden searchBy input
function updateSearchByHiddenField(searchType) {
  $('#search-by').val(searchType);
}

// Searches for medical records by either SSN | Lname | PatID
function getSearchResults() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://pcs/model/search_for_med_recs.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("searchBy=" + searchByCriteria + "&searchValue=" + 
                  searchForValue);
    jsonIDRecords = JSON.parse(xmlhttp.responseText); 
}

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
  $('#pat_table_med_search_results').slideDown("slow");
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
        newTable += "onclick=\"selectPatient(";
        newTable += jsonIDRecords[record].PatientID;
        newTable += ")\">";
        newTable += "Select</button></td>";
        newTable += "</tr>";
    }
    return newTable;
}

// TODO fill out medical record display
function selectPatient(patid) {
  var medRecords = getJsonMedRecords(patid);
  $('#p_patName').html();
  $('#p_ssn').html();
  $('#p_birthday').html();
  $('#p_gender').html();     

}

// Searches for medical records by id
function getJsonMedRecords(patid) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://pcs/model/search_for_med_recs.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("patid" + patid);
    jsonMedicalRecords = JSON.parse(xmlhttp.responseText); 
}