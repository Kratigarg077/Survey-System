function validateForm() {

    var title = document.getElementById('title').value;
    var start = document.getElementById('start_date').value;
    // var varDate = new Date(start);
    var end = document.getElementById('end_date').value;
    var desc = document.getElementById('description').value;

    var today = new Date();
    today.setHours(0, 0, 0, 0);
    var ValidateFlag = true;

    $("#f_title").html("");
    $("#f_start_date").html("");
    $("#f_end_date").html("");
    $("#f_description").html("");

    if (title == '') {
        $("#f_title").html("**Please enter Survey Title");
        ValidateFlag = false;
    }
    if (start == '') {
        document.getElementById('f_start_date').innerHTML = "**Please enter Start Date";
        ValidateFlag = false;
    }
    if (end != '') {
        if (start > end) {
            $("#f_end_date").html("**End Date should be greater than or equal to Start date");
            ValidateFlag = false;
        }
    }

    if (desc == '') {
        document.getElementById('f_description').innerHTML = "**Please enter Survey Description";
        ValidateFlag = false;
    }

    return ValidateFlag;

}

function saveForm() {
    var error = validateForm();
    if (error) {
        $('#overlay').css('display', 'block');
    } else {
        $('#overlay').css('display', 'none');
    }
    return error;
}