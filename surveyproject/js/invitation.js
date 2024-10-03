function validateForm() {

    var name = document.getElementById('name').value;
    var msg = document.getElementById('msg').value;
    var subject = document.getElementById('subject').value;
    var email = document.getElementById('email').value;
    var ValidateFlag = true;
    var validateName = /^[A-z ]+$/;
    var validateEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    $("#f_name").html("");
    $("#f_msg").html("");
    $("#f_email").html("");
    $("#f_subject").html("");

    if (name == '') {
        $("#f_name").html("**Please enter Name");
        ValidateFlag = false;
    } else {
        var result1 = name.split(/,|;/);
        var len1= result1.length;
        var arr = [];
        for (var i = 0; i < len1; i++) {
            if (!validateName.test(result1[i])) {
                arr.push(result1[i]);
                $("#f_name").html("**Name should not contain Number or special Characters: " + arr);
                ValidateFlag = false;
            }
        }
    }

    if (email == '') {
        $("#f_email").html("**Please enter Email");
        ValidateFlag = false;
    } else {
        var result = email.replace(/\s/g, "").split(/,|;/);   // \s means "one space" but /g flag (replace all occurrences) and replacing with the empty string and convert into array.
        var len2= result.length;
        var arr = [];
        for (var i = 0; i < len2; i++) {
            if (!validateEmail.test(result[i])) { 
                arr.push(result[i] ); 
                $("#f_email").html("**Invalid Email: " + arr);
                ValidateFlag = false;
            } 
            // else {
            //     ValidateFlag = true;
            // }
        }
    }
    if(len1>len2){
        $("#f_email").html("**Count of emails should be same as names entered");
        ValidateFlag = false;
    }
    else if(len1<len2){
        $("#f_name").html("**Count of names should be same as emails entered");
        ValidateFlag = false;
    }
    if (msg == '') {
        $("#f_msg").html("**Please enter message");
        ValidateFlag = false;
    }
    if (subject == '') {
        $("#f_subject").html("**Subject field should not be empty");
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