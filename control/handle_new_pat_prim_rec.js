/**
 * Handles the creation of a new primary patient record.  New primary patient
 * records include F & L nmae, SSN, phone number, gender, Bday, and Address info.
 * The creation of a new primary record is handled by handle_new_pat_rec.php
 * via ajax.
 */

/*=================================
=            Variables            =
=================================*/

var firstName = "";
var lastName = "";
var patSSN = "";
var phoneNum = "";
var genderChk = "";
var patBday = "";
var patStAdd = "";
var patCity = "";
var patState = "";
var patZip = "";

// doc elements
var doc_firstName;
var doc_lastName;
var doc_patSSN;
var doc_phoneNum;
var doc_patBday;
var doc_patStAdd;
var doc_patCity;
var doc_patState;
var doc_patZip;
/*-----  End of Variables  ------*/

/*=================================================
=            Handle New Patient Record            =
=================================================*/

// Add listener
document.getElementById("new_pat_rec")
      .addEventListener("load", patient_record_bind_values());

// bind elements by id
function patient_record_bind_values() {
    doc_firstName = document.getElementById('firstName'); 
    doc_lastName = document.getElementById('lastName'); 
    doc_patSSN = document.getElementById('patSSN'); 
    doc_phoneNum = document.getElementById('phoneNum'); 
    doc_patBday = document.getElementById('patBday'); 
    doc_patStAdd = document.getElementById('patStAdd'); 
    doc_patCity = document.getElementById('patCity'); 
    doc_patState = document.getElementById('patState'); 
    doc_patZip = document.getElementById('patZip');
}

// get the current values in the new patient record form
function get_values() {
    firstName = doc_firstName.value; 
    lastName = doc_lastName.value; 
    patSSN = doc_patSSN.value; 
    phoneNum = doc_phoneNum.value; 
    patBday = doc_patBday.value; 
    patStAdd = doc_patStAdd.value; 
    patCity = doc_patCity.value; 
    patState = doc_patState.value; 
    patZip = doc_patZip.value; 
    
    var isMaleChecked = document.getElementById('maleChk').checked;
    var isFemaleChecked = document.getElementById('femaleChk').checked;

    if (isMaleChecked) {
        genderChk = 'male';
    } else if (isFemaleChecked) {
        genderChk = 'female';
    } else {
        genderChk = "unknown";
    }
}

// set a new patient record
function set_new_pat_record() {
    print_vars();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://pcs/control/handle_new_pat_rec.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    // Send POST
    xmlhttp.send('firstName=' + firstName +'&lastName=' + lastName +'&patSSN=' + 
                  patSSN +'&phoneNum=' + phoneNum +'&genderChk=' + genderChk +
                  '&patBday=' + patBday +'&patStAdd=' + patStAdd +'&patCity=' + 
                   patCity +'&patState=' + patState +'&patZip=' + patZip);

    var response = xmlhttp.responseText;
    response = response.trim();
    console.log(response);
    if (response == "success") {
        alert("New Patient Record Added");
    } else if (response == "error_empty") { 
        alert("Error: Some Fields have been left empty!");
    }
}

// main call. Called from the form itself (the submit button)
function handle_new_pat_record() {
    doc_firstName.setAttribute("class", "form-control input-sm success");
    get_values();
    set_new_pat_record();
}


// Testing purposes
function print_vars() {
    console.log(firstName);
    console.log(lastName);
    console.log(patSSN);
    console.log(phoneNum);
    console.log(genderChk);
    console.log(patBday);
    console.log(patStAdd);
    console.log(patCity);
    console.log(patState);
    console.log(patZip);
}






// Getting inner html
/*    $('#searchBy').children().click(function() {
        var searchValue = $(this).children().html();
        console.log($(this).children().html());
        console.log(searchValue);*/