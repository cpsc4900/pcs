
updateClock = function() {

	timeout = setTimeout('updateClock()', 1000);

	//get time
	var d = new Date();
	var month = d.getMonth()+1;
	var day = d.getDate();
	var hour = d.getHours();
	var minute = d.getMinutes();
	var second = d.getSeconds();

	//get AM or PM
	var ampm = "AM";
	if (hour >= 12) {
		hour -= 12;
		ampm = "PM";
	}

	//get month name
	switch(month) {
	case 1:
		month = "January";
		break;
	case 2:
		month = "February";
		break;
	case 3:
		month = "March";
		break;
	case 4:
		month = "April";
		break;
	case 5:
		month = "May";
		break;
	case 6:
		month = "June";
		break;
	case 7:
		month = "July";
		break;
	case 8:
		month = "August";
		break;
	case 9:
		month = "September";
		break;
	case 10:
		month = "October";
		break;
	case 11:
		month = "November";
		break;
	case 12:
		month = "December";
		break;
	default:
		break;
	}

	//America Dating Scheme
	var dateLayout = month + " " + (day<10 ? '0' : '') + day + ", " + d.getFullYear();
	var timeLayout = (hour<10 ? '0' : '') + hour + ":" + (minute<10 ? '0' : '') + minute + ":" + (second<10 ? '0' : '') + second + " " + ampm;
	var output = dateLayout + "<br>" + timeLayout;

	//Display Clocks
	$('#pcsClock').html(output);

	//debug
	//console.log(output);

}

//run script only when page has fully loaded
$( document ).ready(function() {
	console.log( "ready!");   //debug
	updateClock()
});
