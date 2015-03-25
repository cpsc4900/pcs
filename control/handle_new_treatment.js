var treatType = "";

$(document).ready(function(){
    $('#main-medication-form-group').hide();


      // Handles the search by option
    $('#treat-options').children().click(function() {
        treatType = $(this).attr('id');                  // get search by value
        console.log(treatType);
        // toggle medication field if treatment is for med.
        if (treatType == 'medication') {
            $('#main-medication-form-group').show('fast');
        } else {
            $('#main-medication-form-group').hide('fast');
        }
        // change whats displayed in the button
        var displayValue = $(this).children().html();
        $('#treat-options-btn').html(displayValue + "<span class=\"caret\"></span>");
    });
    
});

