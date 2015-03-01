<?php

// Chris Bonham's random test, for quick testing PHP functionality

class Authenticate_test extends PHPUnit_Framework_TestCase {

    public function testDateObjects() {
        // Cannot do this !!
        // $date =new DateTime()->getTimeStamp();
        $date = new DateTime();

        $now_unix_ts = $date->getTimeStamp();

        $formatted_now = $date->format('Y-m-d H:i:s');
        
        print $now_unix_ts."\n";
        print $formatted_now;
    }
    /**
    *
    * $this->assertFalse();
    * $this->assertTrue();
    *
    **/
}



?>