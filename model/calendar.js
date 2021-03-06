
// GLOBAL: holds appointments of the present month being displayed
var jsonMonthApps = "";

/**
 * Returns a JSON format of the appointments schedule within a given month
 * @param  {int} the int value of the month to query for appointments (0-11)
 * @return {JSON} a JSON representation of the appointments in a month.
 * TODO IMPLEMENT
 */
function getAppointmentsByMonth(year, month) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "https://pcs/model/calendar.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("month="+month+"&year="+year);
    jsonMonthApps = JSON.parse(xmlhttp.responseText); 
}

/**
 * Returns an array of AppointmentIDs per the given hour.
 */
function getAppointmentsPerHour(year, month, day, hour) {
    var hourlyAppArray = new Array();
    var datetime = formatDateTime(year, month, day, hour);
    var inc = 0;
    if (jsonMonthApps == "") {                  // no appointments, bail out
        return hourlyAppArray;
    }
    for (var i in jsonMonthApps) {
        // did we find a matching date and hour ??
        if (jsonMonthApps[i].AppTime == datetime) {
            hourlyAppArray[inc] = jsonMonthApps[i].AppointmentID;
            inc += 1;
        }
    }
    return hourlyAppArray;
} 

/**
 * Draws the day within the calendar.  Each day includes, the date, an hours table.
 * @param  {int}  year       the year of the day to draw      
 * @param  {int}  month      the month of the day to draw
 * @param  {int}  day        the date of the day to draw
 * @param  {Boolean} active  if true, the day is drawn as active (i.e. it is clickable)
 * @param  {int}  numOfHours the number of total hours to display per day
 * @param  {int}  startHour  the hour to start with
 * @param  {int}  maxNumOfApp   number of maximum appointments per hour
 * @return {drawn table}     Draws a table representing a single day.
 */
function drawDay(year, month, day, active = true, numOfHours = 8, startHour = 8, maxNumOfApp = 3) {
    var apps = new Array();
    var numOfapps = 0;
    var hourCounter = new Date(year, month, day, startHour);
    var calendarDay = "";
    var tempTime = 0;
    if (!active) {
        calendarDay = "<table class = \" table table-condensed \"" + 
                        "style=\"font-size: 8px;\" >";
    } else {
        calendarDay = "<table class = \" table table-hover  table-condensed \"" + 
                        "style=\"font-size: 8px;\" >";
    }
    calendarDay += "<h4 class=\"text-right\" id=\"date\">" + day + "</h4>" ;       // create date header
    for (var i = 1; i <= numOfHours; i++) {
        // if displayed day is part of the present month, then make active
        if (!active) {
            calendarDay += "<tr class=\"danger\">";
        } else {
            calendarDay += "<tr class=\"active\" id=\"active_hour\">";
        }
        tempTime = hourCounter.getHours();
        apps = getAppointmentsPerHour(year, month, day, tempTime);
        numOfapps = apps.length;                       // get number of appointments per hour
        
        // does the hour belong to a prev or next month?
        if (!active) {
            calendarDay += "<td>" + formatTime(tempTime);     // YES, so create unactive hour row
        } else {
            // NO, so create active hour row, pass date and time when clicked
            calendarDay += "<td><a href=\"#addApp\" data-toggle=\"modal\"" + "class=\"appHours\"" +    // link to addApp modal
                           "data-target=\"#addApp\" onclick=\"passAppTime(" + 
                            year +","+ month +","+ day +","+ tempTime +","+     // pass current date
                            numOfapps + ")\">" +                                // pass numOf appointments/hour
                           formatTime(tempTime) + "</a>";
        }
        calendarDay += "</td>";                                        // close hour tag

        for (var inc = 0; inc < maxNumOfApp; inc++) {                  // add appointments
            calendarDay += "<td>";
            if (numOfapps != 0 && active) {
                numOfapps -= 1;
                calendarDay += "<span class=\"glyphicon glyphicon-user\"";
                calendarDay += "aria-hidden=\"true\"> </span>";
            }
            
            calendarDay += "</td>";    
        }
        calendarDay += "</tr>";
        hourCounter.addHours(1);                                    // increment hour
    }
    calendarDay += "</table>";
    return calendarDay;
}
/**
 * Draws the non-active days of the previous month into the calendar.
 * @param  {date} date the previous month of the active month to draw.
 * @param  {int} numOfDays the number of days from the previous month to draw
 * @return {string} returns an html format of rows that represent non-active
 * days of the previous month.
 */
function drawPreviousUnActiveDays(date, numOfDays) {
    var lastDay = date.getDate();
    var year = date.getFullYear();
    var month = date.getMonth();
    calendar = "<tr>";
    var numOfDaysToDraw = numOfDays;
    for (var i = 0; i <= numOfDays; i++) {
        calendar += "<td class=\"cal_inactive\" id=\"cal_inactive\">";
        calendar += drawDay(year, month, lastDay - numOfDaysToDraw, false);
        calendar += "</td>";
        numOfDaysToDraw -= 1;
    }
    if (numDaysLeftInWeek(numOfDays - 1) === 0) {
    calendar += "</tr>";
    }
    return calendar;
}

/**
 * Draws the active days in a calendar.  Active days are days that can be accessed
 * to add appointments to.  Only one month is active in the calendar display.
 * Preceding and ending days are displayed (non-active) to maintain the calendar
 * view.
 * @param  {int} year the year of the active month to display
 * @param  {int} month the active month to display.
 * @param  {int} numOfPreviousDays the number of previous non-active days
 * @param  {int} numOfDays the number of days in the active month
 * @return {string} an html formatted table of active days to be added to the 
 * calendar
 * @precondition drawPreviousUnActiveDays must be called first.
 */
function drawActiveDays(year, month, numOfPreviousDays, numOfDays) {
    var calendar ="";
    if (numOfPreviousDays === 6) {     // has a whole inactive week been drawn ?
        calendar = "</tr>";                            // Yes, close out the row
        calendar += "<tr>";                            // and start a new row
    }
    for (var i = 1; i <= numOfDays ; i++) {
        calendar += "<td class=\"cal_active\" id=\"cal_active_" + i + "\">";
        calendar += drawDay(year, month, i);
        calendar += "</td>";
        if (new Date(year, month, i).getDay() === 6) {  // Need to close row?
            calendar += "</tr>";                        // Yes, close row
            if (i != numOfDays) {                       // Are we still drawing?
                calendar += "<tr>";                     // Yes, so start new row
            }
        }            
    }
    return calendar;
}

/**
 * Draws the ending non-active days.  This function adds the non-active days of 
 * the next month to the calendar.  This is needed to keep the calendar view a 
 * consistent 6x7 matrix
 * @param  {int} year              the year of the next month to display
 * @param  {int} month             the next month to display
 * @param  {int} numOfPreviousDays the number of previous non-active days already drawn
 * @param  {int} numOfActiveDays   the number of active days already drawn 
 * @return {string} an html formatted row(s) of non-active days
 * @precondition drawPreviousUnActiveDays must be called first, then drawActiveDays,
 * then this function
 */
function drawEndingUnActiveDays(year, month, numOfPreviousDays, numOfActiveDays) {
    var calendar="";
    var nextMonth = 0;
    var nextYear = 0;

    if (month === 11) {         // special case: Next month is Jan of new year
        nextMonth = 0;
        nextYear = year + 1;
    } else {
        nextMonth = month + 1;
        nextYear = year;
    }

    // var: how many days left to draw in calendar matrix ?
    var daysDrawn = numOfPreviousDays + 1 + numOfActiveDays;
    var daysLeftToDraw = 42 - daysDrawn;

    if (new Date(year, month, numOfActiveDays).getDay == 6) {  // if last day drawn
        calendar += "<tr>";                                    // was a Saturday, open new row
    }

    for (var i = 1; i <= daysLeftToDraw; i++) {
        // draw
        calendar += "<td class=\"cal_inactive\" id=\"cal_inactive\">";
        calendar += drawDay(year, month, i, false);
        calendar += "</td>";
        if(new Date(nextYear, nextMonth, i).getDay() == 6) {        // close row on Saturday(s)
            calendar += "</tr>";
            if(daysLeftToDraw != i) {                       // are there more days to draw?
                calendar += "<tr>";                         // Yes, so open a new row
            }
        }
    }
    return calendar;
}

/**
 * Creates a Calendar.  Creates a Calendar in the location specified by divID.
 * The Calendar is formatted with 6 weeks.  The first and last week include days from
 * the previous and next month respectivelly.  Therefore, the matrix is a
 * 6 X 7, with each row starting on Sunday.
 *  
 * @param  {string} The name of the div id to place the calendar in.
 *
 * Generated HTML: a div id = "calendarDiv"
 *                   table id = "calendarMatrix"
 *                   td class = "cal_inactive_x" where x is the calendar day
 *                   td class = "cal_active"
 */
function createCalendar(year, month, divID) {
    var calendar="";   // the string object to be returned in HTML/CSS format 


    // ---- Init parameters
    // Get number of Days in the Month
    var numOfDaysInMonth = getNumberOfDaysInMonth(month, year);

    // Find what weekday the first day of the month falls on
    var firstDayOftheMonth = new Date(year,month,1).getDay();
    var thisDate = new Date(year,month,1);

    // How many days from previous month to include ?
    var numOfPreviousDays = 0;
    if (firstDayOftheMonth == 0) {  // Special Case: 1st day falls on Sunday
        numOfPreviousDays = 6;
    } else {                        // Otherwise, include the number of days of the week
        numOfPreviousDays = firstDayOftheMonth - 1;
    }

    // Get last date of previous month
    var prevDate = new Date(year, month, 0);
    var prevMonthDate = new Date(year, month, 0);
    getAppointmentsByMonth(year, month);
    // ---- End Init parameters
    
    //-----------    Draw the monthly calendar       ---------------

    // Draw dates of previous month
    calendar += drawPreviousUnActiveDays(prevMonthDate, numOfPreviousDays);

    // Draw date of current month
    calendar += drawActiveDays(year, month, numOfPreviousDays, numOfDaysInMonth);
    // Draw inactive dates of next month until calendar matrix is full
    calendar += drawEndingUnActiveDays(year, month, numOfPreviousDays, numOfDaysInMonth);
    document.getElementById(divID).innerHTML = calendar;
}

