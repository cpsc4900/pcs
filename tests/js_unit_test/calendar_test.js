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