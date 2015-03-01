# Tests Folder


## Unit Test

----

### PHPUnit

Install PHPUnit Test Framework.

Add the php

Refer to [https://phpunit.de/manual/current/en/installation.html](https://phpunit.de/manual/current/en/installation.html) for install and using php unit testing.

For Linux Install,  do the following at command line:

```
$: wget https://phar.phpunit.de/phpunit.phar

$: chmod +x phpunit.phar

$: sudo mv phpunit.phar /usr/local/bin/phpunit

$: phpunit --version
```



#### Usage

Create a test class for each unit test.  See authenticate_test.php as an example.

Run test using the following at the command line:

```
$: phpunit --bootstrap control/authenticate.php tests/authenticate_test.php
```

To see the test run in verbose:

```
$: phpunit --debug --bootstrap control/authenticate.php tests/authenticate_test.php
```

Note: the above example assumes that the command prompt is at the "pcs" main folder.

As can be seen in the above command _--bootstrap--_ will load the file being tested.  This way _tests/authenticate\_test.php_ can access (and test) anything in _control/authenticate.php_


### TODO
Add each command line exection of each unit test into master_test_script.  This script should be able to execute from the command line under the pcs folder and work.

**NOTE: Keep all file path dependencies relavtive from the pcs root folder. DO NOT USE ABSOLUTE PATHS **


## List of command line running test unit
The following is a list of command-line ran unit test.  These eventually need to be put in one script.

```
 phpunit --debug --bootstrap control/authenticate.php tests/authenticate_test.php

```

----

### js_unit_test

Under this folder you will find JavaScript Unit Test (using QUnitsjs).

To run a test:

1. Create javascript test file. (This file should be named so the actual file in the system
is easy to reference).

2. Add the test js file to _js\_test.html_

3. Run the test by simple opening the _js\_test.html_ in a browser.

That's it ! 

_See calendar\_test.js for examples of creating a unit test._