/**
*
* Handles the updating of the AR calendar
*
**/

//------------- Handle Initial loading of the page -----------------------------
var today = new Date();
var month = today.getMonth();
var year = today.getFullYear();
var str_month = "";
document.getElementById("calendar_matrix")
      .addEventListener("load", createCalendar(year, month, "calendar_matrix"));
document.getElementById("displayed_year").firstChild.nodeValue = year;
var str_month = getMonth(month);
document.getElementById("displayed_month").firstChild.nodeValue = str_month;
// ----------------        End of init            ---------------------------- -

// Updates the year and the month displayed to the user
function updateDisplayedSettings(year, month) {
    document.getElementById("displayed_year").firstChild.nodeValue = year;
    document.getElementById("displayed_month").firstChild.nodeValue = month;
}


// -------------  Handle calendar display navigation       ---------------------

document.getElementById("prev_year").addEventListener("click", function() {
  year = year -1;
  createCalendar(year, month, "calendar_matrix");
  updateDisplayedSettings(year, str_month);
});

document.getElementById("next_year").addEventListener("click", showNextYear);

function showNextYear() {
    year = year + 1;
    createCalendar(year, month, "calendar_matrix");
    updateDisplayedSettings(year, str_month);
}

document.getElementById("prev_month").addEventListener("click", showPrevMonth);

function showPrevMonth() {
    if (month == 0) {
        month = 11;
        year = year - 1;
    } else {
        month = month - 1;
    }
    str_month = getMonth(month);
    createCalendar(year, month, "calendar_matrix");
    updateDisplayedSettings(year, str_month);
}

document.getElementById("next_month").addEventListener("click", showNextMonth);

function showNextMonth() {
    if (month == 11) {
        month = 0;
        year = year + 1;
    } else {
        month = month + 1;
    }
    str_month = getMonth(month);
    createCalendar(year, month, "calendar_matrix");
    updateDisplayedSettings(year, str_month);
}
// -------------  End Handle calendar display navigation       -----------------





