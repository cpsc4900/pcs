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
    
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #904-2418 Dui, Ave","Denny","Tennessee","91790");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("424-8442 Sem St.","Boise","Tennessee","37899");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #317-1726 Sed St.","Levallois-Perret","Tennessee","69396");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("4410 Pharetra, St.","Provo","Tennessee","9210");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("4061 Vestibulum. Av.","Bearberry","Tennessee","84425-311");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("425-8865 Mollis Avenue","Anderlecht","Tennessee","50812");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #844-268 Non, Street","My","Tennessee","1460");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 311, 947 Eu Street","Hudson's Hope","Tennessee","R1G 8V8");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("582-3678 Dis Street","Worksop","Tennessee","2677");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("7145 Lorem Avenue","Chambord","Tennessee","648362");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("393-4834 Conubia Ave","Huntly","Georgia","89176");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("9833 Auctor. Road","Pastena","Georgia","66508");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("7646 Maecenas St.","Carstairs","Georgia","RG5 3BU");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("152-9836 Vitae Road","Essex","Georgia","5214");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #946-1499 Amet, Road","Manoppello","Georgia","01614");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 430, 2075 Libero Road","Erlangen","Georgia","5893");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("164-2151 Lorem St.","Pironchamps","Georgia","31899");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("300-6590 Nisi St.","Gresham","Georgia","23342");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("5989 Dis St.","Polpenazze del Garda","Georgia","27639");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("386-8467 Dui, Ave","Ayr","Georgia","4974");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 856, 9481 Proin Avenue","Ipswich","Kentucky","B0T 8B4");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("7470 Ut Avenue","Stratford","Kentucky","1109CX");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 514, 1122 Elit St.","Stuttgart","Kentucky","X0M 2Z7");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("258-516 Curae; Rd.","Bunbury","Kentucky","77561-346");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 732, 4024 Ullamcorper. Rd.","Vancouver","Kentucky","41604");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("158-920 Nunc Av.","Chippenham","Kentucky","20501");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("137-1510 Duis Street","Poole","Kentucky","32438");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("667-6297 Fusce Road","Collinas","Kentucky","10736");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("962-9166 Magna Rd.","Saint-Pierre","Kentucky","358360");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #222-7468 Et, Rd.","Varanasi","Kentucky","2803");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("8993 Donec Av.","Kirkland","North Carolina","2547");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("143-5394 Montes, St.","Havr�","North Carolina","DA1B 0YR");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("465-9973 Luctus, Street","Cape Breton Island","North Carolina","86219");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 644, 7329 Molestie Rd.","Illkirch-Graffenstaden","North Carolina","7404");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("5911 Eros. St.","Varsenare","North Carolina","46924");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("8113 Rhoncus. Ave","Houtain-le-Val","North Carolina","34613");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 117, 1828 Enim, St.","Hay River","North Carolina","3750");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("696-1070 Cras Av.","Turriaco","North Carolina","55205");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #337-4585 Aliquam Street","Rigolet","North Carolina","483395");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 355, 5332 Et, Road","Modakeke","North Carolina","3908UZ");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("826-6399 Pellentesque St.","Terrance","Alabama","11005");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("256-1213 Amet Road","Penticton","Alabama","8131IA");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 460, 1730 Ornare, Ave","Palencia","Alabama","7391");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 803, 9413 Commodo Rd.","Maple Creek","Alabama","57425");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("2484 Ridiculus Av.","Ururi","Alabama","74970");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 326, 182 Tellus St.","Dorgali","Alabama","9473EE");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("127-8097 Ut St.","Chandigarh","Alabama","80-985");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("1664 Turpis Ave","Höchst","Alabama","38345-985");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #696-8379 At Ave","Rendsburg","Alabama","55845");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 689, 5203 A, Street","Bama","Alabama","332648");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 721, 7650 Amet Rd.","Peutie","Tennessee","24596");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 345, 5340 Varius Av.","Lakeshore","Tennessee","11124");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("7742 Donec Rd.","Chandannagar","Tennessee","ZM9J 8AR");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #272-4053 Posuere St.","Campofelice di Fitalia","Tennessee","94280");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("489-2400 Metus Rd.","Parla","Tennessee","12611");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #722-8970 Lobortis Ave","March","Tennessee","5769");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #109-4862 At St.","Kelowna","Tennessee","62336");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("978-2375 Semper Avenue","Champlain","Tennessee","X7X 4V8");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("784-1408 Consequat Av.","Minderhout","Tennessee","1671");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("803-2861 Rutrum, Avenue","Lanark County","Tennessee","1221TW");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 749, 7253 Proin Av.","Hengelo","Georgia","4161ND");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("5635 Donec Av.","Canberra","Georgia","595998");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("729-6599 Accumsan Street","Tuscaloosa","Georgia","2998");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #412-4648 Pede. Av.","Springdale","Georgia","9182");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("589-6468 Luctus St.","Newbury","Georgia","61800");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 796, 5509 Varius St.","Havr�","Georgia","7237");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("5975 Porttitor Avenue","Thalassery","Georgia","19437");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("2106 Iaculis Rd.","Ostellato","Georgia","74649");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("734-5768 Mollis. Road","Regina","Georgia","L4W 9E3");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #332-5400 Est Ave","Mackay","Georgia","2768");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 767, 5965 Cras Av.","Ortacesus","Kentucky","5463");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("5776 Leo. Street","Str�e","Kentucky","5427");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #267-358 Mollis. Rd.","Penhold","Kentucky","39789");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 389, 6550 In Road","Calais","Kentucky","953121");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 789, 6670 Vitae, St.","Baricella","Kentucky","5099");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("8666 Magnis St.","Salzgitter","Kentucky","856990");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("234-1756 Lorem, St.","Laramie","Kentucky","L2U 9HM");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #345-5121 Bibendum Avenue","Vellore","Kentucky","4042");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("799-8355 Lobortis Rd.","Saint-Prime","Kentucky","28576");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("624-7719 Ultrices Rd.","Selkirk","Kentucky","33348-980");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 617, 9810 Sit Rd.","Casper","North Carolina","46295");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #993-417 Aenean St.","Vedrin","North Carolina","3100");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #229-9260 Erat St.","Newton Abbot","North Carolina","32753");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("630-2706 At Avenue","Haasdonk","North Carolina","2583");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 116, 6829 Interdum. St.","Tambaram","North Carolina","37-498");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #614-2323 Maecenas Av.","Canora","North Carolina","61019");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("998-1893 Senectus St.","Stratford","North Carolina","1294");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #586-8666 Cursus Av.","Joncret","North Carolina","41358");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("754-1540 Magna. Rd.","Villanovafranca","North Carolina","08850");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("205-1262 Fringilla Street","Sydney","North Carolina","65131");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #257-700 Nonummy Ave","Pettineo","Alabama","40000");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("694-814 Sit Rd.","Charny","Alabama","59334");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("5627 Ut Rd.","Raymond","Alabama","1240");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 640, 9548 Sagittis Rd.","Montreal","Alabama","88449");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("1098 Pharetra. St.","Goiânia","Alabama","IW1 9TN");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("8036 Accumsan St.","Tulsa","Alabama","996456");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("4144 Praesent Avenue","Alexandria","Alabama","7264");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("P.O. Box 576, 5327 Metus. Rd.","Cicagna","Alabama","2428OC");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("Ap #567-1991 Nostra, St.","Fochabers","Alabama","3136");
INSERT INTO ADDRESS (Street,City,State,Zip) VALUES ("1583 Massa Rd.","Zwolle","Alabama","FR4Q 6BX");


/************************* CLINIC ****************************/
INSERT INTO CLINIC(ClinicName, AddressID) 
VALUES ("Crazy Co.", 1);

INSERT INTO CLINIC(ClinicName, AddressID) 
VALUES ("Mental Health Care Clinic", 2);

INSERT INTO CLINIC(ClinicName, AddressID)
VALUES ("Remain Insane", 9);


/************************* EMPLOYEE ****************************/
				/***Crazy Co.***/
/**Doctors**/
INSERT INTO EMPLOYEE (Fname,Lname,UserType,ClinicID) 
VALUES ("Xander","Fitzgerald","Doctor","1"),("Anne","Cote","Doctor","1"),("Anne","Kidd","Doctor","1");
/**Nurses**/
INSERT INTO EMPLOYEE (Fname,Lname,UserType,ClinicID) 
VALUES ("Phoebe","Lindsey","Nurse","1"),("Isaiah","Deleon","Nurse","1"),("Penelope","Rosales","Nurse","1");
/**EMs**/
INSERT INTO EMPLOYEE (Fname,Lname,UserType,ClinicID) 
VALUES ("Mira","Wright","EM","1"),("Cairo","Schwartz","EM","1"),("Jena","Dennis","EM","1");
/**ARs**/
INSERT INTO EMPLOYEE (Fname,Lname,UserType,ClinicID) 
VALUES ("Liberty","Rivers","AR","1"),("Wade","Woods","AR","1"),("Iliana","Baird","AR","1");
/**MRSs**/
INSERT INTO EMPLOYEE (Fname,Lname,UserType,ClinicID) 
VALUES ("Carlos","Carr","MRS","1"),("Regan","Garrison","MRS","1"),("Wang","Wiley","MRS","1");


			/***Mental Health Care Clinic***/
/**Doctors**/
INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ("Joe", "the Doc", "Doctor", 2 );
INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Moe", "the Doc", "Doctor", 2 );
INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Doc", "the Doc", "Doctor", 2 );
/**Nurses**/
INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Alice", "the Nurse", "Nurse", 2 );
INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Jen", "Jenson", "Nurse", 2 );
/**MRSs**/
INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Bob", "the MRS", "MRS", 2 );
/**EMs**/
INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Jenny", "the EM", "EM", 2 );
/**ARs**/
INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Mark", "the AR", "AR", 2 );

			/***Remain Insane***/
INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Gunther", "el Doctore", "Doctor", 3 );

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Betsy", "la Secretaria", "Nurse", 3 );

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Clint", "Medwreck", "MRS", 3 );

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Senior", "Boss", "EM", 3 );

INSERT INTO EMPLOYEE(Fname, Lname, UserType, ClinicID)
VALUES ( "Leroy", "Clint's Brother", "AR", 3 );


/***************************PATIENT*************************/
INSERT INTO PATIENT(Fname, Lname, Birthdate, SSN, Sex, AddressID, isSectioned, PatientNum, PhoneNum) 
	SELECT 'Adam', 'Apple', '1970-01-01', 728649680, 'male', ADDRESS.AddressID, 0, 'ABC123', 5555555555
		FROM ADDRESS WHERE Street = '1 Infinite Loop';
    
INSERT INTO PATIENT(Fname, Lname, Birthdate, SSN, Sex, AddressID, isSectioned, PatientNum, PhoneNum) 
	SELECT 'Big', 'Ben', '1994-02-04', 637485918, 'male', ADDRESS.AddressID, 0, 'DEF456', 5555555555
		FROM ADDRESS WHERE Street = 'SW1A Westminster';
    
INSERT INTO PATIENT(Fname, Lname, Birthdate, SSN, Sex, AddressID, isSectioned, PatientNum, PhoneNum) 
	SELECT 'Chris', 'Columbus', '1492-08-03', 202102010, 'male', ADDRESS.AddressID, 1, 'GHI789', 5555555555
		FROM ADDRESS WHERE Street = '0 Wilderness';

INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Gage","Bridges","1980-09-12","261765904","Male",10,"0","O6M 5U8","(331) 738-2422");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Gabriel","Stone","1994-11-05","710893646","Male",11,"0","Q2Z 4W3","(287) 605-0604");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Chiquita","Golden","1963-11-12","898161741","Male",12,"0","E6W 2G5","(133) 767-8020");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Caleb","Bowen","1956-09-27","270438780","Male",13,"0","Y6K 4M0","(975) 655-1221");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Rebekah","Walsh","1979-08-12","075819946","Male",14,"0","Z4P 5S1","(574) 687-7073");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Sydnee","Byers","1987-11-25","714555965","Male",15,"0","D6C 4O9","(837) 379-9352");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Nathaniel","Stout","1954-05-04","803175327","Male",16,"0","R0L 6W8","(584) 394-0708");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Indira","Vargas","1997-01-14","620056098","Male",17,"0","Y7R 1X4","(229) 896-9783");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Barrett","Haynes","1905-02-26","724851290","Male",18,"0","G6R 6C0","(320) 493-1706");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Blake","Lowery","1964-02-29","722959918","Male",19,"0","F4V 0J5","(692) 634-7306");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Barry","Gilmore","1973-03-22","421322458","Male",20,"0","L8D 0N7","(963) 593-3923");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Melissa","Nicholson","1965-01-24","358971757","Male",21,"0","V3Y 4J6","(917) 754-3827");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Kiayada","Gaines","1976-09-01","048395268","Male",22,"0","R4J 3H4","(190) 457-9037");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Scarlet","Calhoun","1948-04-14","664751129","Male",23,"0","B3M 4J3","(338) 265-6635");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Britanni","Holloway","1973-11-02","448261591","Male",24,"0","J5E 6C3","(115) 208-3997");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Rose","Riley","1935-01-21","093990680","Male",25,"0","G7Q 2D2","(751) 755-1699");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Alexander","Martinez","1955-04-26","306794368","Male",26,"0","I0Q 0P1","(995) 535-3333");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Naomi","Perez","1954-02-25","241442612","Male",27,"0","Q9E 2G7","(253) 746-9129");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Coby","Mcclure","1949-04-11","063362036","Male",28,"0","L3V 6X3","(229) 817-2284");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Burton","Merritt","1973-12-25","232635383","Male",29,"0","O5J 9U8","(673) 135-8539");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Kirk","Holden","1998-04-21","559180269","Male",30,"0","U7B 8U5","(809) 985-5645");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Maxine","Short","1954-11-02","658605532","Male",31,"0","D6N 1R2","(108) 499-1421");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Cally","Forbes","1949-09-22","426582471","Male",32,"0","Z3S 8W1","(121) 497-8061");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Stacy","Orr","1968-01-02","682716333","Male",33,"0","J9V 3X3","(690) 500-0959");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Hop","Horton","1965-06-02","097494889","Male",34,"0","Z5B 8Y0","(118) 605-6347");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Boris","Herman","1937-10-06","801976474","Male",35,"0","H5N 0J6","(596) 307-4014");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Tara","Wiggins","1958-08-09","488299285","Male",36,"0","M0W 6V0","(786) 360-2789");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Bertha","Colon","1940-03-29","214225143","Male",37,"0","B6A 9U4","(142) 142-7602");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Quamar","Rhodes","1936-04-18","418984688","Male",38,"0","M3D 1J8","(629) 619-6665");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Elizabeth","Burns","1944-10-05","463719343","Male",39,"0","R7X 5Z9","(657) 177-6842");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Kiayada","Turner","1948-01-06","411994911","Male",40,"0","X6M 7G8","(410) 662-4538");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Sylvester","King","1996-01-07","291534564","Male",41,"0","I5W 6M3","(645) 902-5488");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Maile","Duncan","1983-04-28","014885011","Male",42,"0","M3B 4X6","(605) 306-2829");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Joelle","Velez","1986-04-15","005435008","Male",43,"0","G2C 9L7","(867) 240-3256");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Nathaniel","Forbes","1901-11-09","043590528","Male",44,"0","I0C 5Y0","(308) 535-8239");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Alexander","Whitehead","1982-08-26","516862521","Male",45,"0","H4U 6S5","(849) 573-2386");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Guy","Ayers","1973-01-24","912043448","Male",46,"0","M0P 3X8","(401) 474-2983");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Zane","Hahn","1996-11-24","267294827","Male",47,"0","Q5T 6B0","(608) 332-5515");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Chantale","Page","1997-03-31","823137607","Male",48,"0","B1V 0O1","(677) 391-1085");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Aubrey","Blair","1982-10-18","999370988","Male",49,"0","V6F 7B9","(820) 277-2698");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Tobias","Shepard","1960-05-19","933970297","Male",50,"0","S0R 7F5","(692) 179-4465");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Amaya","Farley","1984-05-20","580558286","Male",51,"0","U8F 6E9","(193) 441-2318");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Kaitlin","Waters","1967-06-23","671618951","Male",52,"0","I3U 5B7","(899) 586-8096");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Edan","Howell","1904-01-10","904834960","Male",53,"0","Z2M 4M1","(165) 499-5779");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Jocelyn","Gaines","1961-01-15","486727052","Male",54,"0","Y7O 8S7","(579) 741-2382");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Avye","Maldonado","1900-08-28","920672438","Male",55,"0","T1K 9K1","(954) 665-9489");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Cheryl","Moore","1987-02-18","631124316","Male",56,"0","Y2D 0D4","(559) 170-8494");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Solomon","Hickman","1964-04-18","550998499","Male",57,"0","A3S 1U9","(651) 815-6034");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Medge","Blankenship","1935-11-03","966713339","Male",58,"0","M0B 2B6","(966) 801-9645");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Ezekiel","Moody","1967-06-30","116919742","Male",59,"0","X9T 8N3","(122) 337-0016");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Tamekah","1902-Estrada","12-73","352055744","Female",60,"0","U9M 4G4","(678) 211-5863");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Harper","Watkins","1986-08-22","521894280","Female",61,"0","B0T 7D1","(887) 275-3307");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Maggie","Jacobson","1961-02-24","237779924","Female",62,"0","N0P 0Q6","(714) 667-8167");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Castor","Soto","1960-05-28","355668056","Female",63,"0","Z0J 8Q5","(122) 863-8061");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Tasha","Lott","1988-11-19","256140629","Female",64,"0","K4C 8Z2","(699) 636-2675");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Damon","Maddox","1964-09-16","341035307","Female",65,"0","W4S 8T1","(448) 512-6992");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Regan","Daniel","1987-05-05","186149621","Female",66,"0","V1P 8R4","(873) 300-1101");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Abigail","Carney","1901-02-06","787531336","Female",67,"0","S2Q 8I0","(716) 752-6980");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Aristotle","Gonzales","1968-07-04","547837300","Female",68,"0","J2E 8B3","(430) 643-4239");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Quynn","Owens","1997-04-03","092259096","Female",69,"0","H8H 4T0","(718) 670-2751");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Kevyn","Allen","1951-09-21","704870881","Female",70,"0","V0E 1U9","(787) 468-2338");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Gregory","Butler","1972-02-08","111797210","Female",71,"0","S2E 7F2","(461) 949-0906");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Aileen","Silva","1958-03-10","596779429","Female",72,"0","B6B 7U7","(771) 525-7091");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Galena","Bird","1943-11-22","124467752","Female",73,"0","D9J 2O4","(847) 723-7333");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Cyrus","Santana","1935-10-12","599903729","Female",74,"0","R6R 4N7","(893) 831-3679");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Genevieve","Davenport","1930-06-07","060385919","Female",75,"0","F0W 4B2","(430) 445-3394");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Zenia","Duncan","1975-09-21","384926485","Female",76,"0","T1P 1T7","(427) 871-1989");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Xena","Sutton","1993-09-18","182042407","Female",77,"0","L6R 0K8","(697) 343-4426");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Felicia","Moreno","1945-07-11","360093588","Female",78,"0","J3M 4I0","(898) 559-6585");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Alfonso","Riggs","1973-06-24","262132906","Female",79,"0","H9O 4U8","(662) 301-0410");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Merritt","Best","1932-08-30","651052114","Female",80,"0","Y4S 0G4","(327) 542-0700");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Cheryl","Mcintyre","1951-12-02","141584805","Female",81,"0","C5G 7A9","(697) 479-9810");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Malachi","Hood","1991-07-14","881097239","Female",82,"0","T2E 7S8","(382) 136-6178");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Hayfa","Rush","1986-10-19","966446245","Female",83,"0","Q5W 0J6","(791) 777-1352");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Frances","Foreman","1986-02-07","080952474","Female",84,"0","I1N 4X5","(690) 506-4418");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Lael","Cantu","1954-09-03","852455100","Female",85,"0","U5Y 8B2","(746) 142-4697");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Malachi","Neal","1972-09-04","182504451","Female",86,"0","T8Z 1S8","(534) 230-3527");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Noble","Acevedo","1941-11-01","429917281","Female",87,"0","Q8D 7Q8","(842) 939-3516");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("India","Sexton","1945-11-26","731932091","Female",88,"0","D2A 0F8","(377) 456-5690");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Nero","Dodson","1945-07-06","452873637","Female",89,"0","I0K 4D7","(108) 531-9557");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Cassandra","Ingram","1989-01-29","121878089","Female",90,"1","I0C 3F9","(853) 863-4490");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Judah","May","1934-11-09","073621338","Female",91,"1","S4I 7Z8","(936) 323-4391");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Heidi","Burns","1930-03-30","620001184","Female",92,"1","A2W 9T8","(881) 348-7380");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Ashely","Benton","1979-08-25","030071976","Female",93,"1","R6Z 0P0","(675) 804-0519");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Dalton","Robinson","1975-07-17","306131090","Female",94,"1","J5J 3E1","(197) 812-1401");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Blaine","Hayden","1951-04-07","561894703","Female",95,"1","W4W 5U4","(147) 717-9845");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Gray","Morgan","1905-07-13","845864169","Female",96,"1","V0K 5K1","(590) 189-0320");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Barbara","Trujillo","1991-04-25","627506248","Female",97,"1","O6I 8I7","(880) 679-0424");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Mercedes","Dillard","1903-08-31","110929263","Female",98,"1","O1W 6L9","(294) 859-7480");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Galena","Craft","1989-05-01","830643441","Female",99,"1","L6A 6N0","(945) 924-6587");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Bruno","Hurst","1980-10-18","641526723","Female",100,"1","X0W 6R1","(988) 625-9426");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Megan","Mcclain","1953-03-13","219594177","Female",101,"1","V3K 0I4","(843) 418-4605");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Igor","Goodman","1949-01-31","167110674","Female",102,"1","B9O 9L8","(739) 208-3575");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Jennifer","Levine","1958-01-29","318527364","Female",103,"1","V7O 0V2","(358) 957-4098");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Sylvia","Roy","1995-05-21","192616418","Female",104,"1","J7A 0L3","(956) 370-2616");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Chase","Hays","1948-07-16","342273416","Female",105,"1","Z8Y 7J2","(573) 965-4447");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Cathleen","Perry","1965-11-12","181382277","Female",106,"1","A2T 4F2","(548) 544-5984");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Latifah","Oconnor","1968-10-25","107399791","Female",107,"1","K6S 6C5","(413) 650-2877");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Beau","Noel","1963-09-16","454730233","Female",108,"1","T2I 2B4","(408) 130-7492");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Clinton","Lowery","1930-03-27","827880947","Female",109,"1","I4A 9R2","(876) 686-1432");
INSERT INTO PATIENT (Fname,Lname,Birthdate,SSN,Sex,AddressID,isSectioned,PatientNum,PhoneNum) VALUES ("Vladmir","Apple","1970-03-27","820080947","Male",110,"0","I8B 172","(876) 680-1002");

   
/************************ TREATMENT *************************/
INSERT INTO TREATMENT(Treats, Diagnosis, Description, Duration, isOngoing, DateDiagnosed, EmployeeID)
	SELECT 'Medication', 'Generic Syndrome', 'A generic condition treatment in which 
    generalities generate recovery.', '1-2 days/weeks', 0, '2015-02-21', EmployeeID 
		FROM EMPLOYEE WHERE Fname = 'Joe' AND ClinicId = 2 AND UserType = 'Doctor';
    
INSERT INTO TREATMENT(Treats, Diagnosis, Description, Duration, isOngoing, DateDiagnosed, EmployeeID)
	SELECT 'On-site Therapy', 'Common Elderly Disorder', 'Medication prescribed to help 
    combat ailments to be taken until symptoms are reduced, combined with weekly checkup.', 
	'2-5 months', 0, '2015-01-01', EmployeeID 
		FROM EMPLOYEE WHERE Fname = 'Joe' AND ClinicId = 2 AND UserType = 'Doctor';
    
/** Printing so I know where I am at */
SELECT * FROM TREATMENT;

/*********************** MEDICATION *************************/
INSERT INTO MEDICATION(MedicationID, CommonName, Side_Effects, Dosage, TimesPerDay)
	VALUES(DEFAULT, 'Cure-It-All', 'bloating; nausea; fatigue', '100mg', 'twice daily');

INSERT INTO MEDICATION(MedicationID, CommonName, Side_Effects, Dosage, TimesPerDay)
	VALUES(DEFAULT, 'The Sanity Pill', 'dementia; depression; anxiety; insanity', '100mg', 'once daily');
    
INSERT INTO MEDICATION(MedicationID, CommonName, Side_Effects, Dosage, TimesPerDay)
	VALUES(DEFAULT, 'Depression Repression', 'smiles; loss of appetite; cerebral amputation', '100mg', 'thrice daily'); 
/**10 inserts per INSERT, random words are substitute for side effects**/
INSERT INTO MEDICATION (CommonName,Side_Effects,Dosage,TimesPerDay) VALUES ("Tricor","felis ullamcorper viverra. Maecenas iaculis aliquet diam. Sed",'5mg',"1-2 times daily"),("Actos","ac mi eleifend egestas. Sed pharetra,",'10mg',"1-2 times daily"),("Amlodipine Besylate","pede. Praesent eu dui.",'15mg',"1-2 times daily"),("Cialis","Duis sit amet",'20mg',"1-2 times daily"),("Albuterol","ut odio vel est tempor bibendum. Donec felis",'25mg',"1-2 times daily"),("Triamterene/Hydrochlorothiazide","Integer vitae nibh. Donec",'30mg',"1-2 times daily"),("Tricor","Curabitur consequat, lectus sit",'35mg',"1-2 times daily"),("Gabapentin","Proin dolor. Nulla semper tellus id",'40mg',"1-2 times daily"),("Suboxone","litora torquent per conubia",'45mg',"1-2 times daily"),("Seroquel","ut aliquam iaculis, lacus",'50mg',"1-2 times daily");
INSERT INTO MEDICATION (CommonName,Side_Effects,Dosage,TimesPerDay) VALUES ("Lovastatin","nisi. Aenean eget metus. In nec orci.",'55mg',"1-3 times daily"),("Simvastatin","tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum",'60mg',"1-3 times daily"),("Sertraline HCl","nulla magna, malesuada vel, convallis in, cursus et, eros.",'65mg',"1-3 times daily"),("Citalopram HBr","vulputate ullamcorper magna. Sed eu",'70mg',"1-3 times daily"),("Omeprazole (Rx)","nisl. Nulla eu",'75mg',"1-3 times daily"),("Levothyroxine Sodium","est arcu ac orci. Ut semper pretium neque. Morbi quis",'80mg',"1-3 times daily"),("Hydrocodone/APAP","Duis cursus, diam at pretium aliquet, metus urna convallis",'85mg',"1-3 times daily"),("Omeprazole (Rx)","libero et tristique pellentesque, tellus sem mollis dui, in sodales",'90mg',"1-3 times daily"),("Oxycodone HCl","nulla ante, iaculis nec,",'95mg',"1-3 times daily"),("Lexapro","est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque",'100mg',"1-3 times daily");
INSERT INTO MEDICATION (CommonName,Side_Effects,Dosage,TimesPerDay) VALUES ("Amlodipine Besylate","scelerisque neque. Nullam",'105mg',"2-3 times daily"),("Amoxicillin","arcu. Vestibulum ut eros non enim",'110mg',"2-3 times daily"),("Enalapril Maleate","a odio semper cursus. Integer",'115mg',"2-3 times daily"),("Famotidine","parturient montes, nascetur ridiculus mus. Proin",'120mg',"2-3 times daily"),("Atenolol","dapibus id, blandit at, nisi.",'125mg',"2-3 times daily"),("Lantus","lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu",'130mg',"2-3 times daily"),("Tamsulosin HCl","in consectetuer ipsum nunc",'135mg',"2-3 times daily"),("Lantus","eget laoreet posuere, enim nisl elementum purus, accumsan interdum libero",'140mg',"2-3 times daily"),("Furosemide","ultrices posuere cubilia Curae; Donec tincidunt. Donec vitae erat vel",'145mg',"2-3 times daily"),("Metformin HCl","at augue id ante dictum cursus.",'150mg',"2-3 times daily");
INSERT INTO MEDICATION (CommonName,Side_Effects,Dosage,TimesPerDay) VALUES ("Gianvi","placerat eget, venenatis a, magna. Lorem",'155mg',"3-5 times daily, or as needed"),("Nuvaring","non dui nec urna",'160mg',"3-5 times daily, or as needed"),("Flovent HFA","Quisque porttitor eros nec tellus. Nunc lectus",'165mg',"3-5 times daily, or as needed"),("Nasonex","Fusce mi lorem,",'170mg',"3-5 times daily, or as needed"),("Amoxicillin Trihydrate/Potassium Clavulanate","nisl. Quisque fringilla euismod enim. Etiam gravida molestie",'175mg',"3-5 times daily, or as needed"),("Warfarin Sodium","egestas. Duis ac arcu. Nunc",'180mg',"3-5 times daily, or as needed"),("Azithromycin","lorem ipsum sodales purus, in molestie tortor nibh",'185mg',"3-5 times daily, or as needed"),("Prednisone","non sapien molestie orci tincidunt adipiscing. Mauris molestie",'190mg',"3-5 times daily, or as needed"),("Alprazolam","In at pede. Cras vulputate velit eu",'195mg',"3-5 times daily, or as needed"),("Potassium Chloride","gravida non, sollicitudin",'200mg',"3-5 times daily, or as needed");
INSERT INTO MEDICATION (CommonName,Side_Effects,Dosage,TimesPerDay) VALUES ("Omeprazole (Rx)","sit amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing",'205mg',"5-7 times daily, or as needed"),("Omeprazole (Rx)","sociis natoque penatibus et magnis dis parturient montes,",'210mg',"5-7 times daily, or as needed"),("Potassium Chloride","luctus felis purus ac tellus. Suspendisse",'215mg',"5-7 times daily, or as needed"),("Lisinopril","lacus. Mauris non dui nec urna suscipit nonummy.",'220mg',"5-7 times daily, or as needed"),("Fluticasone Propionate","nisi magna sed dui. Fusce",'225mg',"5-7 times daily, or as needed"),("Clindamycin HCl","dolor dolor, tempus non, lacinia at, iaculis quis, pede.",'230mg',"5-7 times daily, or as needed"),("Paroxetine HCl","lorem, luctus ut, pellentesque eget, dictum placerat,",'235mg',"5-7 times daily, or as needed"),("Omeprazole (Rx)","risus. Donec egestas. Duis",'240mg',"5-7 times daily, or as needed"),("Triamcinolone Acetonide","egestas a, dui. Cras pellentesque.",'245mg',"5-7 times daily, or as needed"),("Prednisone","neque sed dictum eleifend, nunc risus varius orci, in",'250mg',"5-7 times daily, or as needed");
INSERT INTO MEDICATION (CommonName,Side_Effects,Dosage,TimesPerDay) VALUES ("Zetia","faucibus ut, nulla. Cras eu tellus",'255mg',"1-3 times daily, not to exceed 2 doses in 6 hours"),("Lexapro","gravida non, sollicitudin a, malesuada id, erat. Etiam",'260mg',"1-3 times daily, not to exceed 2 doses in 6 hours"),("Lisinopril","commodo tincidunt nibh. Phasellus nulla.",'265mg',"1-3 times daily, not to exceed 2 doses in 6 hours"),("Tamsulosin HCl","senectus et netus et malesuada",'270mg',"1-3 times daily, not to exceed 2 doses in 6 hours"),("Loestrin 24 Fe","at pretium aliquet,",'275mg',"1-3 times daily, not to exceed 2 doses in 6 hours"),("Paroxetine HCl","Sed eget lacus. Mauris non dui nec urna suscipit",'280mg',"1-3 times daily, not to exceed 2 doses in 6 hours"),("Vyvanse","feugiat. Sed nec metus",'285mg',"1-3 times daily, not to exceed 2 doses in 6 hours"),("Pantoprazole Sodium","Morbi quis urna. Nunc quis arcu",'290mg',"1-3 times daily, not to exceed 2 doses in 6 hours"),("Nexium","non, bibendum sed, est. Nunc laoreet lectus quis",'295mg',"1-3 times daily, not to exceed 2 doses in 6 hours"),("Alendronate Sodium","tempus mauris erat eget ipsum. Suspendisse sagittis. Nullam vitae diam.",'300mg',"1-3 times daily, not to exceed 2 doses in 6 hours");
INSERT INTO MEDICATION (CommonName,Side_Effects,Dosage,TimesPerDay) VALUES ("Amlodipine Besylate","porttitor scelerisque neque. Nullam nisl. Maecenas malesuada",'305mg',"2-4 times daily, not to exceed 3 doses in 12 hours"),("Amlodipine Besylate","tincidunt orci quis lectus. Nullam suscipit, est",'310mg',"2-4 times daily, not to exceed 3 doses in 12 hours"),("Amoxicillin","malesuada. Integer id magna et ipsum cursus vestibulum. Mauris",'315mg',"2-4 times daily, not to exceed 3 doses in 12 hours"),("Amlodipine Besylate","luctus sit amet, faucibus ut, nulla. Cras eu tellus",'320mg',"2-4 times daily, not to exceed 3 doses in 12 hours"),("Folic Acid","Proin ultrices. Duis volutpat nunc sit amet",'325mg',"2-4 times daily, not to exceed 3 doses in 12 hours"),("Nuvaring","et ipsum cursus",'330mg',"2-4 times daily, not to exceed 3 doses in 12 hours"),("Hydrochlorothiazide","ligula elit, pretium et, rutrum non, hendrerit id, ante. Nunc",'335mg',"2-4 times daily, not to exceed 3 doses in 12 hours"),("Promethazine HCl","mauris sagittis placerat. Cras dictum ultricies",'340mg',"2-4 times daily, not to exceed 3 doses in 12 hours"),("Hydrocodone/APAP","tincidunt, nunc ac mattis",'345mg',"2-4 times daily, not to exceed 3 doses in 12 hours"),("Carisoprodol","sapien. Aenean massa. Integer vitae",'350mg',"2-4 times daily, not to exceed 3 doses in 12 hours");
INSERT INTO MEDICATION (CommonName,Side_Effects,Dosage,TimesPerDay) VALUES ("Premarin","est tempor bibendum. Donec felis orci, adipiscing non,",'355mg',"8-9 times daily"),("Triamterene/Hydrochlorothiazide","ligula eu enim.",'360mg',"8-9 times daily"),("Pantoprazole Sodium","a purus. Duis",'365mg',"8-9 times daily"),("Simvastatin","semper auctor. Mauris vel",'370mg',"8-9 times daily"),("Levoxyl","Nulla eget metus eu erat semper rutrum. Fusce dolor quam,",'375mg',"8-9 times daily"),("Fluconazole","a, enim. Suspendisse",'380mg',"8-9 times daily"),("Clindamycin HCl","aliquet, metus urna convallis erat, eget",'385mg',"8-9 times daily"),("Fluticasone Propionate","tellus lorem eu metus. In lorem. Donec elementum, lorem ut",'390mg',"8-9 times daily"),("Diovan HCT","eget metus eu erat semper rutrum. Fusce dolor quam,",'395mg',"8-9 times daily"),("Glipizide","natoque penatibus et magnis dis parturient montes,",'400mg',"8-9 times daily");
INSERT INTO MEDICATION (CommonName,Side_Effects,Dosage,TimesPerDay) VALUES ("Vytorin","consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus",'405mg',"3-7 times daily"),("Meloxicam","nec ante blandit viverra. Donec tempus, lorem fringilla ornare",'410mg',"3-7 times daily"),("Alprazolam","urna. Nunc quis arcu vel quam",'415mg',"3-7 times daily"),("Ciprofloxacin HCl","ac mattis ornare, lectus ante dictum mi, ac",'420mg',"3-7 times daily"),("Promethazine HCl","consectetuer ipsum nunc id enim. Curabitur massa.",'425mg',"3-7 times daily"),("Cyclobenzaprin HCl","mauris erat eget ipsum. Suspendisse sagittis. Nullam vitae diam. Proin",'430mg',"3-7 times daily"),("Alprazolam","Quisque ornare tortor",'435mg',"3-7 times daily"),("Carvedilol","convallis in, cursus et, eros. Proin ultrices. Duis volutpat",'440mg',"3-7 times daily"),("Clonazepam","dictum. Phasellus in felis. Nulla tempor augue ac",'445mg',"3-7 times daily"),("Allopurinol","fames ac turpis egestas. Aliquam fringilla cursus purus. Nullam scelerisque",'450mg',"3-7 times daily");
INSERT INTO MEDICATION (CommonName,Side_Effects,Dosage,TimesPerDay) VALUES ("Fluticasone Propionate","vehicula et, rutrum eu, ultrices sit amet, risus. Donec",'455mg',"10-15 times daily, not to exceed 4 doses in 6-8 hours"),("Clonazepam","ut mi. Duis risus odio, auctor vitae,",'460mg',"10-15 times daily, not to exceed 4 doses in 6-8 hours"),("Spiriva Handihaler","vel lectus. Cum sociis natoque penatibus et magnis dis parturient",'465mg',"10-15 times daily, not to exceed 4 doses in 6-8 hours"),("Amlodipine Besylate","nec quam. Curabitur vel lectus. Cum sociis",'470mg',"10-15 times daily, not to exceed 4 doses in 6-8 hours"),("Klor-Con M20","Donec felis orci, adipiscing",'475mg',"10-15 times daily, not to exceed 4 doses in 6-8 hours"),("Furosemide","arcu imperdiet ullamcorper. Duis",'480mg',"10-15 times daily, not to exceed 4 doses in 6-8 hours"),("Amoxicillin Trihydrate/Potassium Clavulanate","luctus vulputate, nisi sem semper erat, in",'485mg',"10-15 times daily, not to exceed 4 doses in 6-8 hours"),("Amoxicillin","arcu. Sed et libero.",'490mg',"10-15 times daily, not to exceed 4 doses in 6-8 hours"),("Nasonex","non enim commodo hendrerit. Donec porttitor tellus non magna. Nam",'495mg',"10-15 times daily, not to exceed 4 doses in 6-8 hours"),("Alprazolam","arcu iaculis enim, sit",'500mg',"10-15 times daily, not to exceed 4 doses in 6-8 hours");


/************************ ALLERGY ***************************/
INSERT INTO ALLERGY(AllergyID, AllergyName, Severity)
	VALUES(DEFAULT, 'Penicillin', 'mild');
    
INSERT INTO ALLERGY(AllergyID, AllergyName, Severity)
	VALUES(DEFAULT, 'Sulfa', 'severe');
    
INSERT INTO ALLERGY(AllergyID, AllergyName, Severity)
	VALUES(DEFAULT, 'Latex', 'medium');
/**20 inserts per INSERT**/
INSERT INTO ALLERGY (AllergyName,Severity) VALUES ("Ibuprofen (Rx)","mild"),("Carvedilol","medium"),("Singulair","severe"),("Namenda","mild"),("Metoprolol Succinatee","medium"),("Pravastatin Sodium","severe"),("Zolpidem Tartrate","mild"),("Fluticasone Propionate","medium"),("Digoxin","severe"),("Methylprednisolone","mild"),("Hydrochlorothiazide","medium"),("Symbicort","severe"),("Lisinopril","mild"),("Atenolol","medium"),("Fluoxetine HCl","severe"),("Alprazolam","mild"),("Alendronate Sodium","medium"),("Lorazepam","severe"),("Fluoxetine HCl","mild"),("Alendronate Sodium","medium");
INSERT INTO ALLERGY (AllergyName,Severity) VALUES ("Methylprednisolone","severe"),("Tramadol HCl","mild"),("Pravastatin Sodium","medium"),("Nuvaring","severe"),("Hydrochlorothiazide","mild"),("Oxycodone HCl","medium"),("Lisinopril","severe"),("Ranitidine HCl","mild"),("Vyvanse","medium"),("Amphetamine Salts","severe"),("Amitriptyline HCl","mild"),("Citalopram HBR","medium"),("Prednisone","severe"),("Prednisone","mild"),("Proair HFA","medium"),("Oxycontin","severe"),("Lisinopril","mild"),("Amoxicillin Trihydrate/Potassium Clavulanate","medium"),("Folic Acid","severe"),("Alprazolam","mild");
INSERT INTO ALLERGY (AllergyName,Severity) VALUES ("Ibuprofen (Rx)","medium"),("Lisinopril","severe"),("Sertraline HCl","mild"),("Penicillin VK","medium"),("Warfarin Sodium","severe"),("Clonazepam","mild"),("Plavix","medium"),("Namenda","severe"),("Amoxicillin","mild"),("Glipizide","medium"),("Warfarin Sodium","severe"),("Pantoprazole Sodium","mild"),("Amoxicillin","medium"),("Ranitidine HCl","severe"),("Cheratussin AC","mild"),("Atenolol","medium"),("Tamsulosin HCl","severe"),("Sertraline HCl","mild"),("Seroquel","medium"),("Ventolin HFA","severe");
INSERT INTO ALLERGY (AllergyName,Severity) VALUES ("Omeprazole (Rx)","mild"),("Lisinopril/Hydrochlorothiazide","medium"),("Vitamin D (Rx)","severe"),("Doxycycline Hyclate","mild"),("Hydrocodone/APAP","medium"),("TriNessa","severe"),("Tamsulosin HCl","mild"),("Furosemide","medium"),("Gabapentin","severe"),("Atenolol","mild"),("Hydrocodone/APAP","medium"),("Enalapril Maleate","severe"),("Lorazepam","mild"),("Azithromycin","medium"),("Lipitor","severe"),("Cephalexin","mild"),("Potassium Chloride","medium"),("Metformin HCl","severe"),("Lisinopril","mild"),("Metformin HCl","medium");
INSERT INTO ALLERGY (AllergyName,Severity) VALUES ("Ciprofloxacin HCl","severe"),("Klor-Con M20","mild"),("Carisoprodol","medium"),("Carvedilol","severe"),("Tri-Sprintec","mild"),("Oxycodone/APAP","medium"),("Celebrex","severe"),("Hydrochlorothiazide","mild"),("Metformin HCl","medium"),("Penicillin VK","severe"),("Metoprolol Tartrate ","mild"),("Glyburide","medium"),("Warfarin Sodium","severe"),("Glyburide","mild"),("Lorazepam","medium"),("Diazepam","severe"),("Carvedilol","mild"),("Fluoxetine HCl","medium"),("Glyburide","severe"),("Simvastatin","mild");
    

/*********************** APPOINTMENT ************************/
INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-31 8:00:00", 2, PatientID, (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE Fname = 'Joe' AND Lname = 'the Doc')
		FROM PATIENT 
			WHERE Fname = 'Adam' AND Lname = 'Apple';
            
INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-31 10:00:00", 2, PatientID, (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE Fname = 'Joe' AND Lname = 'the Doc')
		FROM PATIENT
			WHERE Fname = 'Big' AND Lname = 'Ben';
        
INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-31 13:00:00", 2, PatientID, (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE Fname = 'Joe' AND Lname = 'the Doc')
		FROM PATIENT
			WHERE Fname = 'Chris' AND Lname = 'Columbus';
            
INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-03-31 15:00:00", 2, PatientID, (
		SELECT EmployeeID 
			FROM EMPLOYEE 
				WHERE Fname = 'Joe' AND Lname = 'the Doc')
		FROM PATIENT 
			WHERE Fname = 'Blake' AND Lname = 'Lowery';
            
INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID)
	SELECT "2015-04-01 10:00:00", 2, PatientID, (
		SELECT EmployeeID
			FROM EMPLOYEE
				WHERE Fname = 'Joe' AND Lname = 'the Doc')
		FROM PATIENT
			WHERE Fname = 'Vladmir' AND Lname = 'Apple';
        

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
INSERT INTO SECTIONED(RoomNumber, DateSectioned, PatientID, ClinicID, EmployeeID) SELECT 13, "2015-03-17", PatientID, (SELECT ClinicID	FROM CLINIC		WHERE ClinicID = 2), (SELECT EmployeeID	FROM EMPLOYEE WHERE EmployeeID = 1) FROM PATIENT	WHERE IsSectioned = 1;

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



