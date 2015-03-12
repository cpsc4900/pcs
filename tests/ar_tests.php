<?php
/**
 * To run:  
 * $ phpunit --debug --bootstrap control/handle_apps.php tests/ar_tests.php
 */

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class AR_test_suite extends PHPUnit_Framework_TestCase {
    // ...
    public function test_formatMonth() {
        // Test javascript (0-11) monthly format to MySQL datetime format 
        $month= 0;

        $month = formatMonth($month);
        // Assert
        $this->assertEquals($month, "01");

        // Test 2 digit month
        $month= 11;

        $month = formatMonth($month);
        // Assert
        $this->assertEquals($month, "12");
        
    }

    public function test_formatDay() {
        // Test javascript (1-31) to MySQL datetime format
        $day = 1;

        $day = formatDay($day);
        // Assert
        $this->assertEquals($day, "01");

        // Test 2 digit day
        $day = 28;

        $day = formatDay($day);
        // Assert
        $this->assertEquals($day, "28");

    }

    public function test_formatTime() {
        // Test javascript (0-23) hour  to MySQL datetime format
        $hour = 1;

        $hour = formatTime($hour);
        // Assert
        $this->assertEquals($hour, "01:00:00");

        // Test two digit hour
        $hour = 10;

        $hour = formatTime($hour);
        // Assert
        $this->assertEquals($hour, "10:00:00");

    }

    public function test_createDateBounds() {
        // Arrange
        $year = 2015;
        $month = 1;
        $lower_result = createDateBounds($year, $month);
        $high_result = createDateBounds($year, $month, true);
        // Assert
        $this->assertEquals($lower_result, "2015-02-01 00:00:00");
        
        $this->assertEquals($high_result, "2015-02-31 23:59:59");
    }

    /**
    *
    * $this->assertFalse();
    * $this->assertTrue();
    *
    **/
    

}

?>