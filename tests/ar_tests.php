<?php
/**
 * To run:  
 * $ phpunit --debug --bootstrap control/handle_apps.php tests/ar_tests.php
 */

class AR_test_suite extends PHPUnit_Framework_TestCase {
    // ...
    public function testSimpleOneWordTest() {
        // Arrange
        $password = "Hello";

        $hashed_a = create_hash($password);

        $is_valid = validateLogin($password, $hashed_a);

        // Assert
        $this->assertTrue($is_valid);
    }

    /**
    *
    * $this->assertFalse();
    * $this->assertTrue();
    *
    **/
    

}

?>