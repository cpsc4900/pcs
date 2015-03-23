<?php
include "../control/global_query.php";

// request to searchby SSN | Lname | patID
if(isset($_POST['searchBy'])  && isset($_POST['searchValue'])) {
   $result = search_for_patient_id($_POST['searchBy'], $_POST['searchValue']);

   echo json_encode($result);

// request for medical records
} else if(isset($_POST['patid'])) {
    $pat_id = $_POST['patid'];
    $primary_record = search_for_patient_primary('patid', $pat_id);
    $allergies = get_allergy_records_by_id($pat_id);
    $treatments = get_treatments_records_by_id($pat_id);
    $medications = get_medication_records_by_id($pat_id);

    // Return all records as one json
    $full_pat_med_rec = array_merge($primary_record, $allergies, $treatments, $medications);

    echo json_encode($full_pat_med_rec);

/**
 *  Example of json return: Patient Primary & Allergyies & Treatment & Medication
 * [
 *   {
 *     "PatientID": "1",
 *     "Fname": "Adam",
 *     "Lname": "Apple",
 *     "SSN": "728649680",
 *     "Birthdate": "1970-01-01",
 *     "Sex": "male",
 *     "isSectioned": "0",
 *     "AddressID": "6",
 *     "PatientNum": "ABC123",
 *     "PhoneNum": "5555555555",
 *     "Street": "1 Infinite Loop",
 *     "City": "Cupertino",
 *     "State": "California",
 *     "Zip": "53647"
 *   },
 *   {
 *     "AllergyID": "1",
 *     "AllergyName": "Penicillin",
 *     "Severity": "mild"
 *   },
 *   {
 *     "AllergyID": "2",
 *     "AllergyName": "Sulfa",
 *     "Severity": "severe"
 *   },
 *   {
 *     "TreatmentID": "1",
 *     "Treats": "Generic Syndrome",
 *     "Description": "A generic condition treatment in which \n    generalities generate recovery.",
 *     "Duration": "1-2 days\/weeks",
 *     "DateDiagnosed": null,
 *     "EmployeeID": "1"
 *   },
 *   {
 *     "TreatmentID": "2",
 *     "Treats": "Common Elderly Disorder",
 *     "Description": "Medication prescribed to help \n    combat ailments to be taken until symptoms are reduced, combined with weekly checkup.",
 *     "Duration": "2-5 months",
 *     "DateDiagnosed": null,
 *     "EmployeeID": "1"
 *   },
 *   {
 *     "MedicationID": "1",
 *     "CommonName": "Cure-It-All",
 *     "Side Effects": "Side Effects",
 *     "Dosage": "100"
 *   }
 * ]
 */

}


?>
