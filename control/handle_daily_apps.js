var jsonDailyApp = "";  // Holds the appointments for the current day

$(document).ready(function(){
    get_daily_apps();
    parse_json_daily_app();

});


function get_daily_apps() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "https://pcs/control/handle_daily_apps.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("get_daily_apps=true");
    jsonDailyApp = JSON.parse(xmlhttp.responseText);
}

function parse_json_daily_app() {
    var tempApp = "";
    var hourOfApp = "";
    var appObj = "";
    for (var i = 0; i < jsonDailyApp.length; i++) {
        tempApp = jsonDailyApp[i];
        hourOfApp = get_app_hour(tempApp);
        appObj = parse_appointment_obj(i);
        draw_app_obj(appObj, hourOfApp);
    }
}

function draw_app_obj(appObj, hourSelector) {
    var numOfChildren = $(hourSelector).children().length;
    var childIdx = "";
    for (var i = 1; i <= numOfChildren; i++) {
        childIdx = $(hourSelector + ' :nth-child(' + i + ')').html();
        if (childIdx == "") {
            $(hourSelector + ' :nth-child(' + i + ')').html(appObj);
            return;
        }
    }
}
/**
 * Abstracts the hour from the 'AppTime' field.
 * @param  {JSON} jsonObj an appointment json object belonging to jsonDailyApp
 * @return {string/int}   the hour of the appointment in 00-23 notation
 */
function get_app_hour(jsonObj) {
    var timeOfApp = jsonObj["AppTime"];
    timeOfApp = timeOfApp.substring(11, 13);  

    if (parseInt(timeOfApp) < 10) {
        timeOfApp = timeOfApp.substring(1,1);
    }
    timeOfApp = parse_app_hour_id_for_table(timeOfApp);
    return timeOfApp;
}


function parse_app_hour_id_for_table(hour) {
    return "#app_hour_id_" + hour;
}
/**
 * Creates an appointment model (i.e. table) to be inserted into the hourly 
 * appointment model.
 * @param  {int/string} appidx the index of jsonDailyApp (array of JSON 
 *                      appointment objects)
 * @param  {string}     appid the appointmentID of the appointment model to create.  
 * @return {string table} a string of a DOM table that should be inserted into the
 *                        hourly appointment model. The following is the structure
 *                        of the appoinment model:
 *
 *       <a href="displayPatientInfo()" class="list-group-item list-group-item-info">
 *         <h5 class="list-group-item-heading">
 *            Patient First and Last
 *            <span class="glyphicon glyphicon-collapse-down pull-right"></span>
 *         </h5>
 *       </a>
 *                        
 */
function parse_appointment_obj(appidx) {
    var appModel = "";
    var appJsonObj = jsonDailyApp[appidx];

    appModel += "<a href=\"javascript:displayPatientInfo()\"";
    appModel += "class=\"list-group-item list-group-item-info\">";
    appModel += "<h5 class=\"list-group-item-heading\">";
    appModel += appJsonObj["Lname"] + ", " + appJsonObj["Fname"];
    appModel += "<span class=\"glyphicon glyphicon-collapse-down pull-right\">";
    appModel += "</span></h5></a>";
    return appModel
}

// TODO display patient info: see medical_rec_model.php
function displayPatientInfo() {

}