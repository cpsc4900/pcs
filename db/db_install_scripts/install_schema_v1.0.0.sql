SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema pcs_db
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `pcs_db` ;
CREATE SCHEMA IF NOT EXISTS `pcs_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
SHOW WARNINGS;
USE `pcs_db` ;

-- -----------------------------------------------------
-- Table `pcs_db`.`ADDRESS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`ADDRESS` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`ADDRESS` (
  `AddressID` INT NOT NULL AUTO_INCREMENT,
  `Street` VARCHAR(45) NOT NULL,
  `City` VARCHAR(45) NOT NULL,
  `State` VARCHAR(45) NOT NULL,
  `Zip` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`AddressID`),
  UNIQUE INDEX `AddressID_UNIQUE` (`AddressID` ASC))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`PATIENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`PATIENT` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`PATIENT` (
  `PatientID` INT NOT NULL AUTO_INCREMENT,
  `Fname` VARCHAR(45) NOT NULL,
  `Lname` VARCHAR(45) NOT NULL,
  `SSN` BIGINT NOT NULL,
  `Birthdate` DATE NOT NULL,
  `Sex` VARCHAR(6) NOT NULL,
  `isSectioned` TINYINT(1) NOT NULL DEFAULT 0,
  `AddressID` INT NOT NULL,
  `PatientNum` VARCHAR(6) NOT NULL,
  PRIMARY KEY (`PatientID`),
  INDEX `fk_PATIENT_ADDRESS_idx` (`AddressID` ASC),
  UNIQUE INDEX `SSN_UNIQUE` (`SSN` ASC),
  UNIQUE INDEX `PatientID_UNIQUE` (`PatientID` ASC),
  CONSTRAINT `fk_PATIENT_ADDRESS1`
    FOREIGN KEY (`AddressID`)
    REFERENCES `pcs_db`.`ADDRESS` (`AddressID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`CLINIC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`CLINIC` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`CLINIC` (
  `ClinicID` INT NOT NULL AUTO_INCREMENT,
  `ClinicName` VARCHAR(45) NOT NULL,
  `AddressID` INT NOT NULL,
  INDEX `fk_CLINIC_ADDRESS1_idx` (`AddressID` ASC),
  PRIMARY KEY (`ClinicID`),
  UNIQUE INDEX `ClinicID_UNIQUE` (`ClinicID` ASC),
  CONSTRAINT `fk_CLINIC_ADDRESS1`
    FOREIGN KEY (`AddressID`)
    REFERENCES `pcs_db`.`ADDRESS` (`AddressID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`EMPLOYEE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`EMPLOYEE` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`EMPLOYEE` (
  `EmployeeID` INT NOT NULL AUTO_INCREMENT,
  `Fname` VARCHAR(45) NOT NULL,
  `Lname` VARCHAR(45) NOT NULL,
  `UserType` SET('AR', 'EM', 'Doctor', 'Nurse', 'MRS') NOT NULL,
  `ClinicID` INT NOT NULL,
  PRIMARY KEY (`EmployeeID`),
  INDEX `fk_EMPLOYEE_CLINIC1_idx` (`ClinicID` ASC),
  CONSTRAINT `fk_EMPLOYEE_CLINIC1`
    FOREIGN KEY (`ClinicID`)
    REFERENCES `pcs_db`.`CLINIC` (`ClinicID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`APPOINTMENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`APPOINTMENT` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`APPOINTMENT` (
  `AppointmentID` INT NOT NULL AUTO_INCREMENT,
  `AppTime` DATETIME NOT NULL,
  `ShowedUp` TINYINT(1) NULL DEFAULT 0,
  `ClinicID` INT NOT NULL,
  `PatientID` INT NOT NULL,
  `EmployeeID` INT NOT NULL,
  PRIMARY KEY (`AppointmentID`),
  INDEX `fk_APPOINTMENT_CLINIC1_idx` (`ClinicID` ASC),
  INDEX `fk_APPOINTMENT_PATIENT1_idx` (`PatientID` ASC),
  INDEX `fk_APPOINTMENT_EMPLOYEE1_idx` (`EmployeeID` ASC),
  CONSTRAINT `fk_APPOINTMENT_CLINIC1`
    FOREIGN KEY (`ClinicID`)
    REFERENCES `pcs_db`.`CLINIC` (`ClinicID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_APPOINTMENT_PATIENT1`
    FOREIGN KEY (`PatientID`)
    REFERENCES `pcs_db`.`PATIENT` (`PatientID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_APPOINTMENT_EMPLOYEE1`
    FOREIGN KEY (`EmployeeID`)
    REFERENCES `pcs_db`.`EMPLOYEE` (`EmployeeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`MED_RECORD`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`MED_RECORD` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`MED_RECORD` (
  `RecordID` INT NOT NULL AUTO_INCREMENT,
  `PatientID` INT NOT NULL,
  PRIMARY KEY (`RecordID`),
  INDEX `fk_RECORD_PATIENT1_idx` (`PatientID` ASC),
  CONSTRAINT `fk_RECORD_PATIENT1`
    FOREIGN KEY (`PatientID`)
    REFERENCES `pcs_db`.`PATIENT` (`PatientID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`ALLERGY`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`ALLERGY` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`ALLERGY` (
  `AllergyID` INT NOT NULL AUTO_INCREMENT,
  `AllergyName` VARCHAR(45) NOT NULL,
  `Severity` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`AllergyID`),
  UNIQUE INDEX `AllergyID_UNIQUE` (`AllergyID` ASC))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`MEDICATION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`MEDICATION` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`MEDICATION` (
  `MedicationID` INT NOT NULL AUTO_INCREMENT,
  `CommonName` VARCHAR(45) NOT NULL,
  `Side Effects` TEXT NOT NULL,
  `Dosage` VARCHAR(20) NOT NULL,
  `TimesPerDay` VARCHAR(45) NOT NULL,
  `ActiveRx` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`MedicationID`, `CommonName`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`MED_RECORD_has_ALLERGY`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`MED_RECORD_has_ALLERGY` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`MED_RECORD_has_ALLERGY` (
  `RecordID` INT NOT NULL,
  `AllergyID` INT NOT NULL,
  PRIMARY KEY (`RecordID`, `AllergyID`),
  INDEX `fk_MED_RECORD_has_ALLERGY_ALLERGY1_idx` (`AllergyID` ASC),
  INDEX `fk_MED_RECORD_has_ALLERGY_MED_RECORD1_idx` (`RecordID` ASC),
  CONSTRAINT `fk_MED_RECORD_has_ALLERGY_MED_RECORD1`
    FOREIGN KEY (`RecordID`)
    REFERENCES `pcs_db`.`MED_RECORD` (`RecordID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MED_RECORD_has_ALLERGY_ALLERGY1`
    FOREIGN KEY (`AllergyID`)
    REFERENCES `pcs_db`.`ALLERGY` (`AllergyID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`TREATMENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`TREATMENT` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`TREATMENT` (
  `TreatmentID` INT NOT NULL AUTO_INCREMENT,
  `Diagnosis` TINYTEXT NOT NULL,
  `Description` TEXT NOT NULL COMMENT 'Description of the treatment',
  `Duration` VARCHAR(45) NOT NULL COMMENT 'Duration of the treatment',
  `Ongoing?` TINYINT(1) NOT NULL COMMENT 'Is it an ongoing treatment?',
  `DateDiagnosed` DATE NULL,
  PRIMARY KEY (`TreatmentID`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`TREATMENT_has_MEDICATION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`TREATMENT_has_MEDICATION` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`TREATMENT_has_MEDICATION` (
  `TREATMENT_TreatmentID` INT NOT NULL,
  `MEDICATION_MedicationID` INT NOT NULL,
  `MEDICATION_CommonName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`TREATMENT_TreatmentID`, `MEDICATION_MedicationID`, `MEDICATION_CommonName`),
  INDEX `fk_TREATMENT_has_MEDICATIONS_MEDICATIONS1_idx` (`MEDICATION_MedicationID` ASC, `MEDICATION_CommonName` ASC),
  INDEX `fk_TREATMENT_has_MEDICATIONS_TREATMENT1_idx` (`TREATMENT_TreatmentID` ASC),
  CONSTRAINT `fk_TREATMENT_has_MEDICATIONS_TREATMENT1`
    FOREIGN KEY (`TREATMENT_TreatmentID`)
    REFERENCES `pcs_db`.`TREATMENT` (`TreatmentID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TREATMENT_has_MEDICATIONS_MEDICATIONS1`
    FOREIGN KEY (`MEDICATION_MedicationID` , `MEDICATION_CommonName`)
    REFERENCES `pcs_db`.`MEDICATION` (`MedicationID` , `CommonName`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`LOGIN`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`LOGIN` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`LOGIN` (
  `Username` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(65) NOT NULL,
  `EMPLOYEE_EmployeeID` INT NOT NULL,
  PRIMARY KEY (`Username`),
  UNIQUE INDEX `Username_UNIQUE` (`Username` ASC),
  UNIQUE INDEX `Password_UNIQUE` (`Password` ASC),
  INDEX `fk_LOGIN_EMPLOYEE1_idx` (`EMPLOYEE_EmployeeID` ASC),
  CONSTRAINT `fk_LOGIN_EMPLOYEE1`
    FOREIGN KEY (`EMPLOYEE_EmployeeID`)
    REFERENCES `pcs_db`.`EMPLOYEE` (`EmployeeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`SECTIONED`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`SECTIONED` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`SECTIONED` (
  `SectionID` INT NOT NULL AUTO_INCREMENT,
  `PatientID` INT NOT NULL,
  `ClinicID` INT NOT NULL,
  `EmployeeID` INT NOT NULL COMMENT '				',
  `DateSectioned` DATETIME NOT NULL,
  `DateReleased` DATETIME NULL,
  `RoomNumber` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`SectionID`),
  INDEX `fk_SECTIONED_EMPLOYEE1_idx` (`EmployeeID` ASC),
  INDEX `fk_SECTIONED_PATIENT1_idx` (`PatientID` ASC),
  INDEX `fk_SECTIONED_CLINIC1_idx` (`ClinicID` ASC),
  CONSTRAINT `fk_SECTIONED_CLINIC1`
    FOREIGN KEY (`ClinicID`)
    REFERENCES `pcs_db`.`CLINIC` (`ClinicID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SECTIONED_EMPLOYEE1`
    FOREIGN KEY (`EmployeeID`)
    REFERENCES `pcs_db`.`EMPLOYEE` (`EmployeeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SECTIONED_PATIENT1`
    FOREIGN KEY (`PatientID`)
    REFERENCES `pcs_db`.`PATIENT` (`PatientID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`ACTIVITY_LOG`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`ACTIVITY_LOG` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`ACTIVITY_LOG` (
  `LogID` INT NOT NULL AUTO_INCREMENT,
  `ActivityType` SET('AllergyEdit', 'UserLogin','UserAdded','Treatment') NOT NULL,
  `EmployeeID` INT NOT NULL,
  `AllergyID` INT NULL,
  `TimeStamp` DATETIME NOT NULL,
  `TreatmentID` INT NULL,
  PRIMARY KEY (`LogID`),
  UNIQUE INDEX `LogID_UNIQUE` (`LogID` ASC))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `pcs_db`.`MED_RECORD_has_TREATMENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pcs_db`.`MED_RECORD_has_TREATMENT` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `pcs_db`.`MED_RECORD_has_TREATMENT` (
  `MED_RECORD_RecordID` INT NOT NULL,
  `TREATMENT_TreatmentID` INT NOT NULL,
  PRIMARY KEY (`MED_RECORD_RecordID`, `TREATMENT_TreatmentID`),
  INDEX `fk_MED_RECORD_has_TREATMENT_TREATMENT1_idx` (`TREATMENT_TreatmentID` ASC),
  INDEX `fk_MED_RECORD_has_TREATMENT_MED_RECORD1_idx` (`MED_RECORD_RecordID` ASC),
  CONSTRAINT `fk_MED_RECORD_has_TREATMENT_MED_RECORD1`
    FOREIGN KEY (`MED_RECORD_RecordID`)
    REFERENCES `pcs_db`.`MED_RECORD` (`RecordID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MED_RECORD_has_TREATMENT_TREATMENT1`
    FOREIGN KEY (`TREATMENT_TreatmentID`)
    REFERENCES `pcs_db`.`TREATMENT` (`TreatmentID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
