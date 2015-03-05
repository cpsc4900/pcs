/**
*
* Handles the updating of the AR calendar
*
**/

//------------- Handle Initial loading of the page -----------------------------
var today = new Date();
var month = today.getMonth();
var year = today.getFullYear();
document.getElementById("calendar_matrix")
      .addEventListener("load", createCalendar(year, month, "calendar_matrix"));
document.getElementById("displayed_year").firstChild.nodeValue = year;
document.getElementById("displayed_month").firstChild.nodeValue = month;
// ----------------        End of init            ---------------------------- -

// Updates the year and the month displayed to the user
function updateDisplayedSettings(year, month) {
    document.getElementById("displayed_year").firstChild.nodeValue = year;
    document.getElementById("displayed_month").firstChild.nodeValue = month;
}

document.getElementById("prev_year").addEventListener("click", function() {
  year = year -1;
  createCalendar(year, month, "calendar_matrix");
  updateDisplayedSettings(year, month);
});

// -------------  Handle calendar display navigation       ---------------------
// document.getElementById("prev_year").addEventListener("click", showPrevYear);

// function showPrevYear() {
//     year = year - 1;
//     createCalendar(year, month);
//     updateDisplayedSettings(year, month);
// }

document.getElementById("next_year").addEventListener("click", showNextYear);

function showNextYear() {
    year = year + 1;
    createCalendar(year, month);
    updateDisplayedSettings(year, month);
}

document.getElementById("prev_month").addEventListener("click", showPrevMonth);

function showPrevMonth() {
    month = month - 1;
    createCalendar(year, month);
    updateDisplayedSettings(year, month);
}

document.getElementById("next_month").addEventListener("click", showNextMonth);

function showNextMonth() {
    month = month + 1;
    createCalendar(year, month);
    updateDisplayedSettings(year, month);
}
