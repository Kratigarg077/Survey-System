function validateForm() {

  var question = document.getElementById('question').value;
  var type = document.getElementById('drop').value;
  var ValidateFlag = true;

  $('.text-danger').html("");
  $("#f_question").html("");

  if (question == '') {
    // alert(1);
    $("#f_question").html("**Please enter Question");
    ValidateFlag = false;
  }
  if (type == '') {
    // alert(2);
    $("#f_type").html("**Please select Question Type");
    ValidateFlag = false;
  }
  if (type == 'mcq') {
    $('.emptymcq').each(function (index) {
      // alert(3);
      // alert( $(this).val() );
      var mcq_val = $(this).val();
      if (mcq_val == '') {
        $(this).parent().siblings('span').html("**Please enter Option");
        ValidateFlag = false;
      }
    });
  }
  if (type == 'mcq_comment') {
    $('.emptymcq_comment').each(function (index) {
      // alert(4);
      // alert( $(this).val() );
      var mcqcom_val = $(this).val();
      if (mcqcom_val == '') {
        $(this).parent().siblings('span').html("**Please enter Option");
        ValidateFlag = false;
      }
    });
  }
  if (type == 'radio') {
    $('.emptyradio').each(function (index) {
      // alert(5);
      // alert( $(this).val() );
      var radio_val = $(this).val();
      if (radio_val == '') {
        $(this).parent().siblings('span').html("**Please enter Option");
        ValidateFlag = false;
      }
    });
  }
  if (type == 'radio_comment') {
    $('.emptyradio_comment').each(function (index) {
      // alert(6);
      // alert( $(this).val() );
      var radiocom_val = $(this).val();
      if (radiocom_val == '') {
        $(this).parent().siblings('span').html("**Please enter Option");
        ValidateFlag = false;
      }
    });
  }
  // alert(ValidateFlag); die;
  // exit();
  return ValidateFlag;
}