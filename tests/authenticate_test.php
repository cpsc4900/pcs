<?php


class Authenticate_test extends PHPUnit_Framework_TestCase {
    // ...


    public function testSimpleOneWordTest() {
        // Arrange
        $password = "Hello";

        $hashed_a = create_hash($password);

        $is_valid = validateLogin($password, $hashed_a);

        // Assert
        $this->assertTrue($is_valid);
    }
    public function testEmptyPassWord() {
        // Arrange
        $password = "";

        $hashed_a = create_hash($password);

        $is_valid = validateLogin($password, $hashed_a);

        // Assert
        $this->assertTrue($is_valid);
    }

    public function testDevPassWords() {
        /**
        *
        * The Following Passwords are used in Dev:
        * username|usertype | password
        * --------|---------|---------
        * mark    |AR       | arpass
        * jenny   |EM       | empass
        * joe     |Doctor   | docpass
        * alice   |Nurse    | nursepass
        * bob     |MRS      | mrspass
        *
        **/
        
        // Arrange
        $AR_password = "arpass";
        $EM_password = "empass";
        $Doctor_password = "docpass";
        $Nurse_password = "nursepass";
        $MRS_password = "mrspass";

        // Use for development database

        

        $AR_hashed = create_hash($AR_password);
        $EM_hashed = create_hash($EM_password);
        $Doctor_hashed = create_hash($Doctor_password);
        $Nurse_hashed = create_hash($Nurse_password);
        $MRS_hashed = create_hash($MRS_password);
        
        /*$file = fopen("assets/hasedPasswords.txt","w");
        echo fwrite($file,$AR_hashed."\n");
        echo fwrite($file,$EM_hashed."\n");
        echo fwrite($file,$Doctor_hashed."\n");
        echo fwrite($file,$Nurse_hashed."\n");
        echo fwrite($file,$MRS_hashed."\n");
        fclose($file);*/

        $AR_is_valid = validateLogin($AR_password, $AR_hashed);
        $EM_is_valid = validateLogin($EM_password, $EM_hashed);
        $Doctor_is_valid = validateLogin($Doctor_password, $Doctor_hashed);
        $Nurse_is_valid = validateLogin($Nurse_password, $Nurse_hashed);
        $MRS_is_valid = validateLogin($MRS_password, $MRS_hashed);

        // Assert
        $this->assertTrue($AR_is_valid);
        $this->assertTrue($EM_is_valid);
        $this->assertTrue($Doctor_is_valid);
        $this->assertTrue($Nurse_is_valid);
        $this->assertTrue($MRS_is_valid);
    }

    public function testRetrieveHashedPwd() {
        // set test parameters
        init_db_conn();                              // establish db connection
        $usr_name = 'joe';                           // use joe as test case
                                                     // he is a doctor
        $joe_pwd_hased = create_hash('docpass');     // his pwd is docpass
        
        $hash_returned = retrieveHashedPwd($usr_name);  // call test function

        $this->assertEquals($joe_pwd_hased, $hash_returned);
    }

    public function testRetrieveUserType() {
        // set test parameters
        init_db_conn();

        $emp_id = 1;           // Joe the Doc is employee 1
        $user_type = retrieveUserType($emp_id);
        $this->assertEquals('Doctor', $user_type);
        
        $emp_id = 2;           // Alice the Nurse is employee 2
        $user_type = retrieveUserType($emp_id);
        $this->assertEquals('Nurse', $user_type);

        $emp_id = 3;           // Bob the MRS is employee 3
        $user_type = retrieveUserType($emp_id);
        $this->assertEquals('MRS', $user_type);
        
        $emp_id = 4;           // Jenny the EM is employee 4
        $user_type = retrieveUserType($emp_id);
        $this->assertEquals('EM', $user_type);

        $emp_id = 5;           // Mark the AR is employee 5
        $user_type = retrieveUserType($emp_id);
        $this->assertEquals('AR', $user_type);

        // Test: an employee number that does not exist
        $emp_id = 255;
        $user_type = retrieveUserType($emp_id);
        $this->assertEquals(0, $user_type);
    } 

    public function testRetrieveEmployeeID() {
        // set teset params
        init_db_conn();

        $usr_name = 'joe';
        $emp_id = retrieveEmployeeID($usr_name);
        $this->assertEquals($emp_id, 1);

        // test: a username that does not exist
        $usr_name = 'Sebestian';
        $emp_id = retrieveEmployeeID($usr_name);
        $this->assertEquals($emp_id, 0);

    }

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