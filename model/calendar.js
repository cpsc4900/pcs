
/**
* Returns the number of days in a month.
* @param {number} month - The month 0-11.
* @param {number} year - The year in four digit format
*/
function getNumberOfDaysInMonth(month, year) {
    if (month === 11) {
        month = 0;
        year += 1;
    } else {
        month  += 1;
    }
   return new Date(year, month, 0).getDate();
}

/**
 * Returns true if the day is a working day (monday - friday).
 * @param  {number} month - The month 1-12.
 * @param  {number} year - the year in four digit format.
 * @param  {number} day - The day of the Month.
 * @return {Boolean} True if the day of the month and year is a working day
 *                   Monday - Friday, otherwise returns False.
 *  
 * tested and passed 2/16/15
 */
function isWorkingDay(month, year, day) {
    var lastDay = getNumberOfDaysInMonth(month, year, 0);

    // Make sure day makes sense
    if (day > lastDay) {    // day does not fall within the month
        return false;
    }

    // Get the day of the week (0-6)
    var dayOfTheWeek = new Date(year, month, day).getDay();

    if (dayOfTheWeek > 0 && dayOfTheWeek <6) {  // it is a week day
        return true;
    } else {                                    // it is a weekend day
        return false;
    }
}

/**
 * Returns the number of days left in the week as compare to dayOfWeek
 * @param  {int} dayOfWeek 0-6 value for Sun-Saturday
 * @return {int} returns the number of days left in the week
 */
function numDaysLeftInWeek(dayOfWeek) {
    return 6 - dayOfWeek;
}

Date.prototype.addHours= function(h){
    this.setHours(this.getHours()+h);
    return this;
}

/**
 * Formats 0-23 into HH:HH am or pm string format
 * @param  {int} time the time to be formatted in 0-23 value
 * @return {string} a string of formatted time    
 */
function formatTime(time) {
    var returnTime = "";
    time += 1;
    if (time == 23){return "12:00am";}
    if (time > 0 && time < 12) {
        returnTime =  time.toString() + ":00am";
    } else if (time > 11 && time < 25) {
        if (time > 12) {
            time = time - 12;
        }
        returnTime = time.toString() + ":00pm";
    } else {
        time -= 1;
        return "Invalid int value: " + time.toString();
    }
    return returnTime;
} 

// todo break up this logic
function drawDay(year, month, day, active = true, numOfHours = 8, startHour = 8, numOfApp = 3) {

    var hourCounter = new Date(year, month, day, startHour);
    var calendarDay = "";
    var tempTime = 0;
    if (!active) {
        calendarDay = "<table class = \" table table-condensed \" style=\"font-size: 8px;\" >";
    } else {
        calendarDay = "<table class = \" table table-hover  table-condensed \" style=\"font-size: 8px;\" >";
    }
    calendarDay += "<h4 class=\"text-right\" id=\"date\">" + day + "</h4>" ;                 // create date header
    for (var i = 1; i <= numOfHours; i++) {
        if (!active) {
            calendarDay += "<tr class=\"danger\">";
        } else {
            calendarDay += "<tr class=\"active\">";
        }
        tempTime = hourCounter.getHours();
        calendarDay += "<td>" + formatTime(tempTime) + "</td>";              // create hour row
        for (var inc = 0; inc < numOfApp; inc++) {                             // add appointments
            //TODO INSERT APPOINTMENT QUERY HERE !!!
            calendarDay += "<td>" + "<span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"> </span>";
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
//        calendar += "<table> <tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr> </table>";
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

