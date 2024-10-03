function validateForm() {

    var question = document.getElementById('question').value;
    var type = document.getElementById('from_type').value;
    var ValidateFlag = true;
  
    $('.text-danger').html("");
  
    if (question == '') {
      $("#f_question").html("**Please enter Question");
      ValidateFlag = false;
    }
    if (type == 'mcq') {
      $('.emptymcq').each(function (index) {
        // alert( $(this).val() );
        var mcq_val = $(this).val();
        if (mcq_val == '') {
          $(this).parent().siblings('span').html("**Please enter Option");
          // alert(3);
          ValidateFlag = false;
        }
      });
    }
    if (type == 'mcq_comment') {
      $('.emptymcq_comment').each(function (index) {
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
        // alert( $(this).val() );
        var radio_val = $(this).val();
        if (radio_val == '') {
          $(this).parent().siblings('span').html("**Please enter Option");
          // alert(5);
          ValidateFlag = false;
        }
      });
    }
    if (type == 'radio_comment') {
      $('.emptyradio_comment').each(function (index) {
       var radiocom_val = $(this).val();
        if (radiocom_val == '') {
          // alert($(this).parent().siblings('span').attr("id"));
          $(this).parent().siblings('span').html("**Please enter Option");
          // $(this).parent().siblings('span')[id].html("**Please enter Option");
          // alert(6);
          ValidateFlag = false;
        }
      });
    }
    return ValidateFlag;
  }