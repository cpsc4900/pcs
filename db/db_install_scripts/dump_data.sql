/**
*
* This script dumps "dummy" data into the pcs_db database.  
* You must login to mysql, then run this script
*
* mysql> \. file_path/dump_data.sql
**/
USE pcs_db;


-- Log output
-- \T /var/www/pcs/db/db_install_scripts/log_sql.log


/**********************
* Dummy Info:
* 
*
**/

/* Delete all data: Refresh 
*
* Pay close attention to the order in which you clear (DELETE) the tables.
* You must go in the order of non-dependent foreign keys.  For example,
* Clinic depends on ADDRESS for a foreign key.  So, you have to delete CLINIC
* FIRST !!!!
*
* The same is true for creating records in a table.  Since CLINIC depends on 
* ADDRESS YOU MUST create ADDRESS FIRST !!!!!
*
*/
DELETE FROM PATIENT;
ALTER TABLE PATIENT AUTO_INCREMENT = 1;
DELETE FROM LOGIN;
DELETE FROM EMPLOYEE;
ALTER TABLE EMPLOYEE AUTO_INCREMENT = 1;    -- Reset auto increment to 1
DELETE FROM CLINIC;
ALTER TABLE CLINIC AUTO_INCREMENT = 1;    -- Reset auto increment to 1
DELETE FROM ADDRESS;
ALTER TABLE ADDRESS AUTO_INCREMENT = 1;    -- Reset auto increment to 1



/************************* Adresses ****************************/

INSERT INTO ADDRESS (Street, City, State, Zip)  
	VALUES('4019 Lost Oak Drive','Ooltewah', 'TN', 37363);
INSERT INTO ADDRESS (Street, City, State, Zip)  
	VALUES('753 Easy Way','Chattanooga', 'TN', 37421);
INSERT INTO ADDRESS (Street, City, State, Zip)  
	VALUES('1010 Industrial Drive','Washington', 'WA', 123456);
INSERT INTO ADDRESS (Street, City, State, Zip)  
	VALUES('123 Green Way Rd','Pheonix', 'AZ', 85004);
INSERT INTO ADDRESS (Street, City, State, Zip)  
	VALUES('13450 Here We Go','Roanoke', 'VA', 452354);
INSERT INTO ADDRESS (Street, City, State, Zip)
	VALUES('1 Infinite Loop', 'Cupertino', 'California', 53647);
INSERT INTO ADDRESS (Street, City, State, Zip)
	VALUES('SW1A Westminster', 'London', 'United Kingdom', 000000);
INSERT INTO ADDRESS (Street, City, State, Zip)
	VALUES('0 Wilderness', 'Plymouth Rock', 'Massachusetts', 90909);


/************************* CLINIC ****************************/
INSERT INTO CLINIC(ClinicName, AddressID) 
SELECT "Crazy Co.", AddressID 
FROM ADDRESS WHERE Street = '4019 Lost Oak Drive'
LIMIT 1;

INSERT INTO CLINIC(ClinicName, AddressID) 
SELECT "Mental Health Care Clinic", AddressID 
FROM ADDRESS WHERE Street = '753 Easy Way'
LIMIT 1;

INSERT INTO CLINIC(ClinicName, AddressID)
SELECT "Remain Insane", AddressID
FROM ADDRESS WHERE Street = '1414 Dead End Drive'
LIMIT 1;


/************************* EMPLOYEE ****************************/
/***Mental Health Care Clinic***/
INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
SELECT "Joe", "the Doc", "Doctor", ClinicID 
FROM CLINIC WHERE ClinicName = "Mental Health Care Clinic";

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
SELECT "Alice", "the Nurse", "Nurse", ClinicID 
FROM CLINIC WHERE ClinicName = "Mental Health Care Clinic";

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
SELECT "Bob", "the MRS", "MRS", ClinicID 
FROM CLINIC WHERE ClinicName = "Mental Health Care Clinic";

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
SELECT "Jenny", "the EM", "EM", ClinicID 
FROM CLINIC WHERE ClinicName = "Mental Health Care Clinic";

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
SELECT "Mark", "the AR", "AR", ClinicID 
FROM CLINIC WHERE ClinicName = "Mental Health Care Clinic";

/***Remain Insane***/
INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
SELECT "Gunther", "el Doctore", "Doctor", ClinicID 
FROM CLINIC WHERE ClinicName = "Remain Insane";

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
SELECT "Betsy", "la Secretaria", "Nurse", ClinicID 
FROM CLINIC WHERE ClinicName = "Remain Insane";

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
SELECT "Clint", "Medwreck", "MRS", ClinicID 
FROM CLINIC WHERE ClinicName = "Remain Insane";

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
SELECT "Senior", "Boss", "EM", ClinicID 
FROM CLINIC WHERE ClinicName = "Remain Insane";

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
SELECT "Leroy", "Clint's Brother", "AR", ClinicID 
FROM CLINIC WHERE ClinicName = "Remain Insane";

/***************************PATIENT*************************/
INSERT INTO PATIENT(Fname, Lname, Birthdate, SSN, Sex, AddressID, isSectioned, PatientNum) 
	SELECT 'Adam', 'Apple', 1970-1-1, 728649680, 'male', ADDRESS.AddressID, 0, '123'
		FROM ADDRESS WHERE Street = '1 Infinite Loop';
    
INSERT INTO PATIENT(Fname, Lname, Birthdate, SSN, Sex, AddressID, isSectioned, PatientNum) 
	SELECT 'Big', 'Ben', 1994-2-4, 637485918, 'male', ADDRESS.AddressID, 0, 'def456'
		FROM ADDRESS WHERE Street = 'SW1A Westminster';
    
INSERT INTO PATIENT(Fname, Lname, Birthdate, SSN, Sex, AddressID, isSectioned, PatientNum) 
	SELECT 'Christopher', 'Columbus', 1492-8-3, 202102010, 'male', ADDRESS.AddressID, 0, 'ghi789'
		FROM ADDRESS WHERE Street = '0 Wilderness';
    
    
/************************ TREATMENT *************************/
INSERT INTO TREATMENT(TreatmentID, Treats, Description, Duration, `Ongoing?`)
	VALUES(DEFAULT, 'Generic Syndrome', 'A generic condition treatment in which 
    generalities generate recovery.', '1-2 days/weeks', DEFAULT);
    
INSERT INTO TREATMENT(TreatmentID, Treats, Description, Duration, `Ongoing?`)
	VALUES(DEFAULT, 'Common Elderly Disorder', 'Medication prescribed to help 
    combat ailments to be taken until symptoms are reduced, combined with weekly checkup.', 
	'2-5 months', DEFAULT);
    

/*********************** MEDICATION *************************/
INSERT INTO MEDICATION(MedicationID, CommonName, `Side Effects`, Dosage, TimesPerDay)
	VALUES(DEFAULT, 'Cure-It-All', 'bloating; nausea; fatigue', 100+'mg', 'twice daily');

INSERT INTO MEDICATION(MedicationID, CommonName, `Side Effects`, Dosage, TimesPerDay)
	VALUES(DEFAULT, 'The Sanity Pill', 'dementia; depression; anxiety; insanity', 100+'mg', 'once daily');
    
INSERT INTO MEDICATION(MedicationID, CommonName, `Side Effects`, Dosage, TimesPerDay)
	VALUES(DEFAULT, 'Depression Repression', 'smiles; loss of appetite; cerebral amputation', 100+'mg', 'thrice daily'); 
    

/************************ ALLERGY ***************************/
INSERT INTO ALLERGY(AllergyID, AllergyName, Severity)
	VALUES(DEFAULT, 'Penicillin', 'mild');
    
INSERT INTO ALLERGY(AllergyID, AllergyName, Severity)
	VALUES(DEFAULT, 'Sulfa', 'severe');
    
INSERT INTO ALLERGY(AllergyID, AllergyName, Severity)
	VALUES(DEFAULT, 'Latex', 'medium');
    

/*********************** APPOINTMENT ************************/
INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-17 13:30:00", ClinicID, (
		SELECT PatientID 
			FROM PATIENT 
				WHERE Fname = 'Adam'), (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE UserType = 'Doctor')
		FROM CLINIC
			WHERE ClinicName = 'Mental Health Care Clinic';
            
INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-17 11:15:00", ClinicID, (
		SELECT PatientID
			FROM PATIENT
				WHERE Fname = 'Big'), (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE UserType = 'Doctor')
		FROM CLINIC 
			WHERE ClinicName = 'Mental Health Care Clinic';
        
INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-17 14:00:00", ClinicID, (
		SELECT PatientID
			FROM PATIENT
				WHERE Fname = 'Chris'), (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE UserType = 'Doctor')
		FROM CLINIC
			WHERE ClinicName = 'Remain Insane';


/*************************SECTION***************************/
INSERT INTO SECTION(RoomNumber, DateSectioned, PatientID, ClinicID, EmployeeID)
	SELECT 13, "2015-03-17", PatientID, (
		SELECT ClinicID
			FROM CLINIC
				WHERE ClinicName = 'Remain Insane'), (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE UserType = 'Doctor')
		FROM PATIENT
			WHERE IsSectioned = 1;
			
    
/************************* LOGIN ****************************/
/**
*
* BE CAREFUL HERE: PASSWORDS NEED TO BE SHA-256 HASHED FIRST
* 
* REFER TO pcs/control/authenticate  to see the function that handles hashing
* Use pcs/tests/authenticate_test.php to generate the hash values for passwords
*
**/

INSERT INTO LOGIN(UserName, Password, EMPLOYEE_EmployeeID)
SELECT "mark", "5664ba6897fb5a0495df4004bc8ad8ef6eb4192c2c2297aa492e20fffc80173e",
EmployeeID FROM EMPLOYEE WHERE Lname="the AR";

INSERT INTO LOGIN(UserName, Password, EMPLOYEE_EmployeeID)
SELECT "jenny", "a6b00e5c8784cd9d3d6e353a28bce2fcdfcac3582ee2108c6beab9933dc7085d",
EmployeeID FROM EMPLOYEE WHERE Lname="the EM";

INSERT INTO LOGIN(UserName, Password, EMPLOYEE_EmployeeID)
SELECT "bob", "579d3753a25053abd5b444415baf3682397a137ad2487bb695490d1a70c88323",
EmployeeID FROM EMPLOYEE WHERE Lname="the MRS";

INSERT INTO LOGIN(UserName, Password, EMPLOYEE_EmployeeID)
SELECT "alice", "b4d9c32e4df79218bcf63be6c3951238babc63f8e00fe1d5088286179f3dca62",
EmployeeID FROM EMPLOYEE WHERE Lname="the Nurse";

INSERT INTO LOGIN(UserName, Password, EMPLOYEE_EmployeeID)
SELECT "joe", "135887ffe67113a5bacb1c9f5fc7e989b8a860bdfb06c72c8408bb99fdd78cb5",
EmployeeID FROM EMPLOYEE WHERE Lname="the Doc";



