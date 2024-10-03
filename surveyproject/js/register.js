function validateForm() {

    var user = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var ValidateFlag = true;

    var regEmail=/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/g;                          
    var name1=/^[A-z ]+$/; 
    // var name1= /^[a-zA-Z][a-zA-Z ]{2,}/;
    var pass = /[A-Z]/;
    var pass1=/[a-z]/;
    var pass2=/[0-9]/;
    var pass3=/[~`!@#$%^&*()\[\]\\.,;:\s@"\-\\_+={}<>?]/;
   
    $("#f_name").html("");
    $("#f_email").html("");
    $("#f_password").html("");
    $("#f_password1").html("");
    $("#f_password2").html("");
    $("#f_password3").html("");
    $("#f_password4").html("");


    if (user=='') {
        $("#f_name").html("**Please enter your Name");
        ValidateFlag = false;
    }
    else if(!name1.test(user)){
        // document.getElementById('f_name').innerHTML="**Name should not contain Number or special Characters";
        $("#f_name").html("**Name should not contain Number or special Characters");
        ValidateFlag =  false;
    }


    if (email=='') {
        document.getElementById('f_email').innerHTML ="**Please enter your Email";
        ValidateFlag = false;
    }
    else if(!regEmail.test(email)){
        document.getElementById('f_email').innerHTML="**Enter the valid email Address";
        ValidateFlag =  false;
    }

    if (password=='') {
        $("#f_password").html("**Please enter your Password");
        ValidateFlag =  false;
    }

    else{

        if (password.length< 5 || password.length> 15) {
            $("#f_password").html("**Length of password should be more than 5");
            ValidateFlag =  false;
        }

        if(!pass.test(password)){
            $("#f_password").html("**Password must contain At least One Upper case<br>");
            ValidateFlag =  false;
        }

        if(!pass1.test(password)){
            $("#f_password1").html("**Password must contain At least One Lower case<br>");
            ValidateFlag =  false;
        }

        if(!pass2.test(password)){
            $("#f_password2").html("**Password must contain At least one digit<br>");
            ValidateFlag =  false;
        }

        if(!pass3.test(password)){
            $("#f_password").html("**Password must contain At least one special character<br>");
            ValidateFlag =  false;
        }
    
    }
    return ValidateFlag;
}
