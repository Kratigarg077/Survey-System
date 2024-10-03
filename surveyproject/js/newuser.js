function validateForm() {
     $('#saveBtn').attr('disabled','disabled');
    var first = document.getElementById('firstname').value;
    var contact = document.getElementById('contact').value;
    var email = document.getElementById('email').value;
    var role = document.getElementById('role').value;
    var gender = document.getElementById('gender').value;
    var ValidateFlag = true;

    var regEmail=/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/g;                          
    var name1=/^[A-z ]+$/; 
    var phone = /^\d{10}$/;

    $("#f_firstname").html("");
    $("#f_contact").html("");
    // $("#f_contact1").html("");
    $("#f_email").html("");
    $("#f_gender").html("");
    $("#f_role").html("");

    if (first=='') {
        $("#f_firstname").html("**Please enter your Name");
        ValidateFlag = false;
    }
    else if(!name1.test(first)){
        // document.getElementById('f_name').innerHTML="**Name should not contain Number or special Characters";
        $("#f_firstname").html("**Name should not contain Number or special Characters");
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

    if (contact=='') {
        $("#f_contact").html("**Please enter Contact No.");
        ValidateFlag =  false;
    }
    else if (contact.length< 10 || contact.length>10  ) {
        $("#f_contact").html("**Contact No. should be 10 digits long.");
        ValidateFlag =  false;
    }
    else if(!phone.test(contact)){
        $("#f_contact").html("**Contact Number should not contain alphabets and special character.");
        ValidateFlag =  false;
    }
    if (gender=='') {
        $("#f_gender").html("**Please select Gender.");
        ValidateFlag =  false;
    }
    if (role=='') {
        $("#f_role").html("**Please select Role.");
        ValidateFlag =  false;
    }
    if(!ValidateFlag){
        $('#saveBtn').removeAttr('disabled');
    }
    return ValidateFlag;
}

function saveForm(){
var error = validateForm();
if(error){
  $('#overlay').css('display','block');
}else{
    $('#overlay').css('display','none');
}
return error;
}