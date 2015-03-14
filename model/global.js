
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
    if (time == 0){return "12:00am";}
    if (time > 0 && time < 12) {
        returnTime =  time.toString() + ":00am";
    } else if (time > 11 && time < 24) {
        if (time > 12) {
            time = time - 12;
        }
        returnTime = time.toString() + ":00pm";
    } else {
        return "Invalid int value: " + time.toString();
    }
    return returnTime;
}

function sqlFormatHour(hour) {
    var returnHr = "";
    if (hour < 10) {
        returnHr = "0"+hour.toString();
    } else {
        returnHr = hour.toString();
    }
    returnHr = returnHr+":00:00";
    return returnHr;
}

function sqlFormatMonth(month) {
    month = month + 1;
    var rtMonth = "";
    if (month < 10) { 
        rtMonth = "0"+month.toString();
    } else {
        rtMonth = month.toString();
    }
    return rtMonth;
}

function sqlFormatDay(day) {
    var rtday = "";
    if (day < 10) { 
        rtday = "0"+day.toString();
    } else {
        rtday = day.toString();
    }
    return rtday;
}
/**
 * Returns a String of the month represented by an int 0 - 11
 * @param  {int} numMonth the month to returns
 * @return a String of the month if numMonth is between 0 -11, otherwise
 *         returns NaM (Not a Month)
 */
function getMonth(numMonth) {
    var string_month;
    switch(numMonth) {
        case 0:
            string_month = "January";
            break;
        case 1:
            string_month = "February";
            break;
        case 2:
            string_month = "March";
            break;
        case 3:
            string_month = "April";
            break;
        case 4:
            string_month = "May";
            break;
        case 5:
            string_month = "June";
            break;
        case 6:
            string_month = "July";
            break;
        case 7:
            string_month = "August";
            break;
        case 8:
            string_month = "September";
            break;
        case 9:
            string_month = "October";
            break;
        case 10:
            string_month = "November";
            break;
        case 11:
            string_month = "December";
            break;
        default:
            string_month = "NaM";
            break;
    }
    return string_month;   
}
function formatDateTime(year, month, day, hour) {
    var datetime = year.toString();
    datetime = datetime+"-"+sqlFormatMonth(month)+"-"+sqlFormatDay(day); 
    datetime = datetime+" "+sqlFormatHour(hour);
    return datetime;
}
