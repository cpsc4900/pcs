var numberOfApps = 0;

$(document).ready(function(){
    // Clears fields in the New Appointment form (app_form.php)
    $("#formCancel").click(function(){
        $('input').val('');
    });

});  //-- end of document ready




// ----------------------  Adding and Deleting Appointments -------------------


// Recieves a Date object
// binded to each active hour in the calendar
function passAppTime(yr, mnth, day, time, numOfApps) {
  console.log("passed year =" + yr);
  console.log("passed month =" + mnth);
  console.log("passed day =" + day);
  console.log("passed time = " + time);
  console.log("passed apps = " + numOfApps);

  numberOfApps = numOfApps;

  // Display date and time in app_form
  var appDate = new Date(yr, mnth, day, time);
  document.getElementById("AddApp").firstChild.nodeValue = "Appointment Details for " +
                                    appDate.toDateString() + " " + formatTime(time);

  // Add mySQL formatted datetime param to app_form hidden time field
  var appDates = formatDateTime(yr, mnth, day, time);
  document.getElementById("appDate").value = appDates;

  if (numberOfApps == 3) {
    $('#addAppForm').hide();
  }
}


