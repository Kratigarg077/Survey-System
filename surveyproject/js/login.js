function validateForm() {

    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    document.getElementById('f_email').innerHTML="";
    document.getElementById('f_password').innerHTML="";
   
    if (email=='' && password=='') {
        document.getElementById('f_email').innerHTML ="Please enter your Email";
        document.getElementById('f_password').innerHTML ="Please enter your Password";
        // document.getElementById('f_email').style.display="none";
        return false;
    }

    else if (email=='') {
        document.getElementById('f_email').innerHTML ="Please enter your Email";
        return false;
  }
    else if (password=='') {
        document.getElementById('f_password').innerHTML ="Please enter your Password";
        return false;
}
}