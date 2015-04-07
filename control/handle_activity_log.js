var act_log = ""; // Holds the JSON objects of activities

$(document).ready(function(){

    // ----- Initial loading of the activity table
    act_log = get_activities();
    createActivityTable(act_log);

    // ------       Organize Table By Functions    ---------------
    $('.act-log-order').click(function(event) {
        var orderType = this.id;
        console.log("This id = " + orderType);
        switch (orderType) {
            case "activity-log-id":
                sort_by(act_log, "LogID");
                break;
            case "activity-activity-type":
                sort_by(act_log, "ActivityType");
                break;
            case "activity-emp-id":
                sort_by(act_log, "EmployeeID");
                break;
            case "activity-allergy-id":
                sort_by(act_log, "LogID");
                break;
            case "activity-timestamp":
                sort_by(act_log, "TimeStamp");
                break;
            case "activity-treat-id":
                sort_by(act_log, "TreatmentID");
                break;
            case "activity-pat-rec-id":
                sort_by(act_log, "PatientRecID");
                break;
        }
        createActivityTable(act_log);
    });
    // ------   End Organize Table By Functions    ---------------

});  //-- end of document ready


/**
 * Displays all the activites from the ACTIVITY_LOG table and places it in
 * the tbody with id = 'activity-table'
 */
function createActivityTable(act_log) {
    console.dir(act_log);
    var act_table = "";
    for(var log in act_log) {
        act_table += "<tr>"
        act_table += "<td>"+act_log[log].LogID+"</td>";
        act_table += "<td>"+act_log[log].ActivityType+"</td>";
        act_table += "<td>"+act_log[log].TimeStamp+"</td>";
        act_table += "<td>"+act_log[log].EmployeeID+"</td>";
        act_table += "<td>"+act_log[log].AllergyID+"</td>";
        act_table += "<td>"+act_log[log].TreatmentID+"</td>";
        act_table += "<td>"+act_log[log].PatientRecID+"</td>";
        act_table += "</tr>";
    }
    $('#activity-table').html(act_table);
}


/**
 * Performs the AJAX request for the activity logs
 * @param  {String} st_time  the datetime to get all activities greater than
 * @param  {String} end_time the datetime to get all activities less than
 * @return {JSON Obj}          a JSON format of all the logs between the two
 *                           supplied dates
 * @default [no params]      Returns all activities.
 */
function get_activities(st_time = "1970-01-01 00:00:01", 
                        end_time = "2038-01-19 03:14:07") {
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "https://pcs/control/handle_activity_log.php", false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("start_time=" + st_time + "&end_time=" + end_time);
    var response = JSON.parse(xmlhttp.responseText);
    return response;
}

/**
 * Sorts an array of arrays (or JSON Objects).
 * @param  {array/JSON Obj} jsonObj An array of arrays or a JSON Object containing
 *                          JSON Objects
 * @param  {String} keyType The key of the key => value tuple to compare each
 *                          object by.
 * @postcondition   the supplied array (or JSON object) is re-ordered in descending
 *                  order according to the keyType used.
 */
function sort_by(jsonObj, keyType = "PatientRecID") {
    console.log("keyType = " + keyType);
    quickSort(jsonObj, 0, jsonObj.length - 1, keyType);
}



/**
 * Sorts an array of JSON objects in descending order
 * @param  {array} array   an array of JSON Objets OR arrays 
 * @param  {int} l_idx   left index (recursive)
 * @param  {int} r_idx   right index (recursive)
 * @param  {string} keyType the key=> value to sort by.  The keytype must
 * belong to the JSON Objects (or the arrays) being used.
 * @postcondition the supplied array is sorted according to the keyType in
 * descending order
 */
function quickSort (array, l_idx, r_idx, keyType) {
    if (l_idx < r_idx) {
        var pivot_idx = partition(array, l_idx, r_idx, keyType);
        quickSort(array, l_idx, pivot_idx - 1, keyType);
        quickSort(array, pivot_idx + 1, r_idx, keyType);
    }
}

/**
 * Private: partitions an array into two segments.  Then, orders each segment
 *          in descending order. Used by quickSort
 * @param  {array} array   the array to partition
 * @param  {int} l_idx   left index
 * @param  {int} r_idx   right index
 * @param  {n/a} keyType the key value to compare elements of an array by.
 *               Possiblities for an acitivity log array are:
 *               LogID, PatientRecID, TimeStamp, TreatmentID, EmployeeID, 
 *               AllergyID, or ActivityType
 * @return {int} leftwall the index point where the greatest element has been 
 *               swapped.  Everything up to leftwall is in descending order.
 */
function partition(array, l_idx, r_idx, keyType) {
    var is_int = false;
    if (keyType != 'ActivityType'  && keyType != 'TimeStamp') {
        var pivot_val = parseInt(array[l_idx][keyType]);
        if (isNaN(pivot_val)) {
            pivot_val = 65535;
        }
        is_int = true;
    } else {
        var pivot_val = array[l_idx][keyType];
    }

    var left_wall = l_idx;
    // -------    main loop: while left index is less than right index
    for(var i = l_idx + 1; i <= r_idx; i++) {
        var to_compare;
        // are we comparing ints or strings?
        if (is_int) {                                   // ints, so parse
            to_compare = parseInt(array[i][keyType]);
            if (isNaN(to_compare)) {                   // if null, set to max int
                to_compare = 65535;
            } 
            
        } else {                                       // strings, no worries
            to_compare = array[i][keyType];
        }
        // is the left value greater than the current pivot point?
        if ( to_compare < pivot_val) {
            left_wall = left_wall + 1;                          // yes, so swap
            swap(array, i, left_wall);
        }
    }
    swap(array, l_idx, left_wall);          // final swap
    return left_wall;
}

/**
 * Private: Used by partition() to swap two elements
 * @param  {array} array the array in which two elements need to be swapped.
 * @param  {int} l_idx one of the index positions which needs to be swapped
 *                  with the element at r_idx
 * @param  {int} r_idx one of the index positions which needs to be swapped
 *                  with the element at l_idx
 * @postcondition array with elements at l_idx and r_idx swapped
 */
function swap(array, l_idx, r_idx) {
    var temp = array[l_idx];
    array[l_idx] = array[r_idx];
    array[r_idx] = temp;
}

function testQuickSort() {
    var myArray = [10, 30, 5, 6];
    quickSort(myArray, 0, myArray.length - 1);

    console.dir(myArray);

}