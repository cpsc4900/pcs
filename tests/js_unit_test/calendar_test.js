/**
* Possible assertions
*
* assert.equal(a, b);
* 
* assert.ok(true, "Print me if true")  = assertTrue
**/


/**
 * To run test, all document.getElementByID statements must be commented out in
 * calendar.js !!!!!!
 */

// Simple test demo
QUnit.test("Demo test", function( assert ) {
  assert.ok( 1 == "1", "Passed!" );
});

// Simple test demo 2: using multiple inputs
QUnit.test("Demo 2 test", function( assert ) {
  function multiple_inputs(inputA, inputB) {
    assert.equal(inputA, inputB);
  }

  multiple_inputs(1, 1);
  multiple_inputs(true, true);
  multiple_inputs(false, false);
  multiple_inputs("Chris", "Chris");
});


/**
 * Test Date Object
 *
 * Observed: Sunday = 0, Saturday = 6
 */
QUnit.test("DateObject_test", function( assert ) {
  var date = new Date(2015, 2, 1).getDay();  
  assert.equal(date, 0);
  date = new Date(2015, 2, 7).getDay();  
  assert.equal(date, 6);

  date = new Date(2015, 1, 0);
  var lastDay = date.getDate();
  assert.equal(lastDay, 31);

  var firstDayOftheMonth = new Date(2015,2,1).getDay();
  assert.equal(firstDayOftheMonth, 0);

  var testClosing = new Date(2015, 6, 31).getDay();

  assert.ok(testClosing != 6, "Should not equal 6");
});

/**
* Test: getNumberOfDaysInMonth
* Observed effect. Months just wrap around. So, the month 14 of 2015 = 3 of 2016
* Function does not care about negative values for years
**/

QUnit.test("getNumberOfDaysInMonth_test", function( assert ) {
  // Test this year
  assert.equal(getNumberOfDaysInMonth(1, 2015), 28);
  // Test leap year
  assert.equal(getNumberOfDaysInMonth(1, 2016), 29);
  // Test month out of bounds
  assert.equal(31, getNumberOfDaysInMonth(14, 2016));
  // Test negative value year
  assert.equal(31, getNumberOfDaysInMonth(12, -2016));
});

/**
 * Test: isWorkingDay
 *
 * Observed effects:  A day out of bounds will produce false
 */
QUnit.test("isWorkingDay_test", function(assert) {
    // Test March 2015
    var year = 2015;
    var month = 2;
    for (var i = 1; i < 31; i++) {
        if(i > 2 && i < 7) {
            assert.ok(isWorkingDay(month, year, i), "Is Working Day");
        } else if (i == 1) {
            assert.ok(!isWorkingDay(month, year, i), "Is Not Working Day");
        } else if(i > 8 && i < 14) {
            assert.ok(isWorkingDay(month, year, i), "Is Working Day");
        } else if (i > 6 && i < 9) {
            assert.ok(!isWorkingDay(month, year, i), "Is Not Working Day");
        } else if(i > 15 && i < 21) {
            assert.ok(isWorkingDay(month, year, i), "Is Working Day");
        } else if (i > 13 && i < 16) {
            assert.ok(!isWorkingDay(month, year, i), "Is Not Working Day");
        } else if(i > 22 && i < 28) {
            assert.ok(isWorkingDay(month, year, i), "Is Working Day");
        } else if (i > 20 && i < 23) {
            assert.ok(!isWorkingDay(month, year, i), "Is Not Working Day");
        } else if (i == 28) {
            assert.ok(!isWorkingDay(month, year, i), "Is Not Working Day");
        } else if (i == 29) {
            assert.ok(!isWorkingDay(month, year, i), "Is Not Working Day");
        } else {

        }
    }; 

});


QUnit.test("formatTime", function(assert) {
  // Test formatting time into xx:00 am/pm format
  var time = 1;   // = 1:00 am
  var timeString = formatTime(time);

  assert.equal(timeString, "1:00am");

  time = 12;   // = 12:00 pm
  timeString = formatTime(time);

  assert.equal(timeString, "12:00pm");

  time = 23;   // = 11:00 pm
  timeString = formatTime(time);

  assert.equal("11:00pm", timeString);

  time = 24;   // = Out of bounds
  timeString = formatTime(time);

  assert.equal(timeString, "Invalid int value: 24");

});

QUnit.test("getMonth", function(assert) {
  // Test formatting month from int to string
  var month = 0;
  var monthString = getMonth(month);

  assert.equal(monthString, "January");

  month = 11;
  monthString = getMonth(month);

  assert.equal(monthString, "December");


  month = 24;   // = Out of bounds
  monthString = getMonth(month);

  assert.equal(monthString, "NaM");

});

QUnit.test("arrayDeclerationTest", function(assert) {
  // Test array decleration
  var myArray = new Array();

  myArray[0] = 1;
  myArray[1] = 2;

  assert.equal(myArray[0], 1);
  assert.equal(myArray[1], 2);
});

QUnit.test("getAppointmentsPerHour_test", function(assert) {
  // Test array decleration
  var hourlyApps = new Array();
  hourlyApps = getAppointmentsPerHour(2015, 2, 21, 9);

  assert.equal(hourlyApps[0], 1);
  assert.equal(hourlyApps.length, 2);
});

QUnit.test("sqlFormatHour_test", function(assert) {
  // Test array decleration
  var hour = sqlFormatHour(9); 

  assert.equal("09:00:00", hour);
});

QUnit.test("sqlFormatMonth_test", function(assert) {
  // Test array decleration
  var month = sqlFormatMonth(9); 

  assert.equal("10", month);
});
