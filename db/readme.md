# Database Folder

## Include
1. Keep copies of the script needed to generate the database in "db_install_scripts"
2. Keep test scripts in "db_test"
3. Keep pics of the ERD in "db_model"
4. Keep a test TODO list in "db_test"
5. Keep the mysql workbench project in "db_model"

## General Note

See db_install_scripts to install the pcs_db locally

I am by no means a database tester, so if you find a more elegant way to handle testing, go for it.  Below is just a suggested method.  In any event, we need to document functional queries to the database AND have proof that they work.  The following is just a suggestion.

## Test Scripts
Test scripts need to include the commands used to access the database.  The test script should also include the user type that is used to log in to the database.  These test scripts should be direct MySQL queries, testable in the mysql command prompt.  For example: a test case needed is to test if the AR user can retrieve all appointments (by time and by patientID) that have already been made.  So, the script should be something similar to the one below:

```
// Note: This assumes that mysql has been invoked at the command prompt
//	     (i.e.  shell> mysql)
// Also, I am using $ to represent the command line, and PCS as the database name.

$ mysql --host=localhost --user=AR --password=arpass PCS

// 	Test Case: get appointments by time and the patientID of the patient
//  returns a table of the appointments in order of time
SELECT Date, Time, PatientID
FROM APPOINTMENT
ORDER BY Date DESC, Time DESC

```

### Saving test results to a file for comparing expected results

To save the output of a mysql query to a file, simply use the _INTO OUTFILE_ command.  By default, mysql uses tab separators. We should change this to comma separated (makes it easier to work with in an excel program).  Reusing the Query test above, it would look like this:

```
SELECT Date, Time, PatientID
FROM APPOINTMENT
ORDER BY Date DESC, Time DESC
INTO OUTFILE '/tmp/test_ar_appointment_retrieve.csv'
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
```
WARNING: the output file must not exist!!!
So, each test case must create a new file.  Label each file so it makes sense like above.

As for where to store the file??? It will be different for all of us, cause if you use relative paths it will be different depending on the OS being used.  So, I would recommend (@Mike) just storing in a folder called test_scripts under **THIS** folder.  Then, Paul and I can adjust accordingly.

### One Master Script
After each individual test script proves to be working as expected, add it to a "Master Test Script".  This script should be able to run all the test cases at once.  This way, when we get the database as somewhat expected, we can run the master script after any changes made to the database and the script should point out any errors.

----
## Test TODO

### Description
List individual test cases that need to be tested here.

### Test Cases

1. 

----
## Login to the database:
We need 7 users right now to be able to login to the database. Use the following:

username | password
---------|---------
AR       | arpass
EM       | empass
Doctor   | docpass
Nurse    | nursepass
MRS      | mrspass
Master   | masterpass
Login    | loginpass

### User Priveleges: To be completed !!!
The following list the privileges each user type will need.  Note I am using r for read and w for write, and by _resource_ I mean the table(s) in which each user should have access to.

1. Master: will have global permissions (much like root) on the database. TESTING PURPOSES ONLY (via php and javascript).  This user will be removed at deployment

2. Login: Login user is used at initial login to check username and password.  ONLY LOGIN USER SHOULD HAVE ACCESS TO THE LOGIN TABLE !!!

privilege | resource
---------|---------
r  	     | LOGIN
r        | EMPLOYEE

3. AR

privilege | resource
----------|---------
wr | APPOINTMENT
wr | PATIENT
wr | ADDRESS
r  | CLINIC
r  | EMPLOYEE


4. EM - Will Need to think about this one BUT, only read permissions !

privilege | resource
----------|---------

5. Doctor

privilege | resource
----------|---------
rw | APPOINTMENT
rw | MEDICATIONS
rw | TEATEMENT
rw | MED_RECORD
rw | ALLERGY
rw | SECTIONED
r  | PATIENT
r  | RX
r  | CLINIC
r  | EMPLOYEE


6. Nurse

privilege | resource
----------|---------

7. MRS

privilege | resource
----------|---------