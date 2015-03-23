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
DELETE FROM SECTIONED;
ALTER TABLE SECTIONED AUTO_INCREMENT = 1;    -- Reset auto increment to 1
DELETE FROM APPOINTMENT;
ALTER TABLE APPOINTMENT AUTO_INCREMENT = 1;    -- Reset auto increment to 1
DELETE FROM MED_RECORD_has_TREATMENT;
ALTER TABLE MED_RECORD_has_TREATMENT AUTO_INCREMENT = 1;    -- Reset auto increment to 1
DELETE FROM MED_RECORD_has_ALLERGY;
ALTER TABLE MED_RECORD_has_ALLERGY AUTO_INCREMENT = 1;    -- Reset auto increment to 1
DELETE FROM MED_RECORD;
ALTER TABLE MED_RECORD AUTO_INCREMENT = 1;    -- Reset auto increment to 1
DELETE FROM MEDICATION;
ALTER TABLE MEDICATION AUTO_INCREMENT = 1;    -- Reset auto increment to 1
DELETE FROM TREATMENT;
ALTER TABLE TREATMENT AUTO_INCREMENT = 1;    -- Reset auto increment to 1
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
INSERT INTO ADDRESS (Street, City, State, Zip)
	VALUES('1414 Dead End Drive', 'Plymouth Rock', 'Massachusetts', 90909);
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
SELECT "Moe", "the Doc", "Doctor", ClinicID 
FROM CLINIC WHERE ClinicName = "Mental Health Care Clinic";

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
SELECT "Doc", "the Doc", "Doctor", ClinicID 
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
INSERT INTO PATIENT(Fname, Lname, Birthdate, SSN, Sex, AddressID, isSectioned, PatientNum, PhoneNum) 
	SELECT 'Adam', 'Apple', '1970-01-01', 728649680, 'male', ADDRESS.AddressID, 0, 'ABC123', 5555555555
		FROM ADDRESS WHERE Street = '1 Infinite Loop';
    
INSERT INTO PATIENT(Fname, Lname, Birthdate, SSN, Sex, AddressID, isSectioned, PatientNum, PhoneNum) 
	SELECT 'Big', 'Ben', '1994-02-04', 637485918, 'male', ADDRESS.AddressID, 0, 'DEF456', 5555555555
		FROM ADDRESS WHERE Street = 'SW1A Westminster';
    
INSERT INTO PATIENT(Fname, Lname, Birthdate, SSN, Sex, AddressID, isSectioned, PatientNum, PhoneNum) 
	SELECT 'Chris', 'Columbus', '1492-08-03', 202102010, 'male', ADDRESS.AddressID, 0, 'GHI789', 5555555555
		FROM ADDRESS WHERE Street = '0 Wilderness';
    
   
/************************ TREATMENT *************************/
INSERT INTO TREATMENT(Treats, Description, Duration, `Ongoing?`, EmployeeID)
	SELECT 'Generic Syndrome', 'A generic condition treatment in which 
    generalities generate recovery.', '1-2 days/weeks', 0, EmployeeID FROM EMPLOYEE WHERE Fname = 'Joe';
    
INSERT INTO TREATMENT(Treats, Description, Duration, `Ongoing?`, EmployeeID)
	SELECT 'Common Elderly Disorder', 'Medication prescribed to help 
    combat ailments to be taken until symptoms are reduced, combined with weekly checkup.', 
	'2-5 months', 0, EmployeeID FROM EMPLOYEE WHERE Fname = 'Joe';
    

/*********************** MEDICATION *************************/
INSERT INTO MEDICATION(MedicationID, CommonName, Side_Effects, Dosage, TimesPerDay)
	VALUES(DEFAULT, 'Cure-It-All', 'bloating; nausea; fatigue', 100+'mg', 'twice daily');

INSERT INTO MEDICATION(MedicationID, CommonName, Side_Effects, Dosage, TimesPerDay)
	VALUES(DEFAULT, 'The Sanity Pill', 'dementia; depression; anxiety; insanity', 100+'mg', 'once daily');
    
INSERT INTO MEDICATION(MedicationID, CommonName, Side_Effects, Dosage, TimesPerDay)
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
	SELECT "2015-03-17 13:00:00", ClinicID, (
		SELECT PatientID 
			FROM PATIENT 
				WHERE Fname = 'Adam'), (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE EmployeeID = 1)
		FROM CLINIC
			WHERE ClinicName = 'Mental Health Care Clinic';
            
INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-17 11:00:00", ClinicID, (
		SELECT PatientID
			FROM PATIENT
				WHERE Fname = 'Big'), (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE EmployeeID = 1)
		FROM CLINIC 
			WHERE ClinicName = 'Mental Health Care Clinic';
        
INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-17 14:00:00", ClinicID, (
		SELECT PatientID
			FROM PATIENT
				WHERE Fname = 'Chris'), (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE EmployeeID = 1)
		FROM CLINIC
			WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-14 08:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-24 09:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-29 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-14 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-22 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-20 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-30 10:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-07 10:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-27 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-17 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-19 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-09 10:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-03 08:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-18 16:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-11 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-04 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-20 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-19 12:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-20 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-18 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-01 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-27 16:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-21 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-28 10:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-20 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-30 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-06 08:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-20 09:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-27 10:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-27 10:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-17 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-25 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-13 09:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-22 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-08 12:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-02 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-31 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-09 12:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-27 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-24 10:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-29 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-28 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-24 10:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-24 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-24 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-30 08:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-05 06:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-31 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-10 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-18 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-07 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-15 08:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-23 06:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-17 06:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-16 12:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-14 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-14 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-10 10:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-18 08:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-27 12:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-07 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-17 12:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-17 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-18 12:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-18 16:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-21 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-08 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-02 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-16 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-27 16:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-29 10:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-16 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-30 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-07 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-21 09:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-22 00:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-13 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-10 06:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-17 08:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-24 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-06 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-28 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-20 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-26 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-11 13:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-18 07:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-22 09:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-29 09:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-21 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-14 11:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-27 10:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-29 08:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-09 14:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';

INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-26 15:00:00", ClinicID, 
		(SELECT PatientID FROM PATIENT WHERE Fname = 'Chris'), 
		(SELECT EmployeeID FROM EMPLOYEE WHERE EmployeeID = 1) 
		FROM CLINIC WHERE ClinicName = 'Mental Health Care Clinic';


/*************************SECTION***************************/
INSERT INTO SECTIONED(RoomNumber, DateSectioned, PatientID, ClinicID, EmployeeID)
	SELECT 13, "2015-03-17", PatientID, (
		SELECT ClinicID
			FROM CLINIC
				WHERE ClinicName = 'Remain Insane'), (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE EmployeeID = 1)
		FROM PATIENT
			WHERE IsSectioned = 1;

/*************************MED_RECORD***************************/
/**
 * This is sloppy: Need to clean up....need more patients first !!!!
 */
INSERT INTO MED_RECORD(RecordID, PatientID) VALUES(1,1);
INSERT INTO MED_RECORD(RecordID, PatientID) VALUES(2,1);
/*************************MED_RECORD_has_ALLERGY***************************/
INSERT INTO MED_RECORD_has_ALLERGY(RecordID, AllergyID) VALUES(1,1);
INSERT INTO MED_RECORD_has_ALLERGY(RecordID, AllergyID) VALUES(2,2);


/*************************MED_RECORD_has_TREATMENT***************************/
INSERT INTO MED_RECORD_has_TREATMENT(MED_RECORD_RecordID, TREATMENT_TreatmentID) VALUES(1,1);
INSERT INTO MED_RECORD_has_TREATMENT(MED_RECORD_RecordID, TREATMENT_TreatmentID) VALUES(2,2);

INSERT INTO TREATMENT_has_MEDICATION(TREATMENT_TreatmentID, MEDICATION_MedicationID, MEDICATION_CommonName) VALUES(1, 1,"Cure-It-All");

    
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
EmployeeID FROM EMPLOYEE WHERE Fname="Joe" AND Lname="the Doc";



