<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';
include 'controllers/invitationcontroller.php';

session_start();
@$hid = $_GET['survey_id'];
@$invite_key = $_GET['invite_key'];
$survey = new survey;
$invite = new invitation;

//fetch survey data
$qry = $survey->fetchSurvey_data($hid);
$row = mysqli_fetch_array($qry);

//fetch invitation data
$qry1 = $invite->fetchDataFromInvitation($invite_key);
$arr = mysqli_fetch_array($qry1);

$title = isset($arr['invitation_to_name']) ? $arr['invitation_to_name'] : "";
$email = isset($arr['invitation_to_email']) ? $arr['invitation_to_email'] : "";
if (@$arr['status'] == "submitted") {
    header("location:thankyou.php?survey_id=$hid");
}

if (isset($_POST['save'])) {
    extract($_POST);
    $query = $survey->getAnswer($hid, $name, $email);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Form</title>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/rating.css">
    <link rel="stylesheet" href="/css/side.css">
</head>

<body style="background-color: #e3e1e1;">
    <div class="mx-0 mx-sm-auto">
        <div class="card bgcolor" style="width:55rem; margin:10px; margin:auto; padding:10px; border-radius:10px;">
            <?php if (@$row['survey_status'] != 'EXPIRED') { ?>
                <div class="card-header" style="background-color: #595656; border-radius:10px; margin:5px;">
                    <h5 class="card-title text-white mt-2" style="text-align:center;" id="exampleModalLabel">SURVEY FORM</h5>
                    <p style="text-align:center; color:white; font-size:13px;">
                        Your opinion matters
                        <br>Please take a moment to fill out this survey.
                    </p>
                </div>
            <?php } ?>
            <div class="card-body">
                <!-- SUrvey Information -->
                <div style=" text-align:center; border:2px solid #666; padding:10px; margin:5px; border-radius:10px;">
                    <h3><?= @$row['survey_title']; ?> </h3>
                    <hr>
                    <p><?= @$row['survey_description']; ?></p>
                </div>
                <?php if (@$row['survey_status'] == 'EXPIRED') { ?>
                    <!-- <div class="bgcolor" style="width:40%; margin: 10% auto;"> -->
                    <div style=" text-align:center; border:2px solid #666; padding:50px; margin:5px; border-radius:10px; color:#b51f19;">
                        <p style="margin:auto; font-size:30px;">Survey has expired!!</p>
                        <br>
                        <p style="margin:auto; font-size:25px;">We are no longer accepting responses !!
                        </p>
                    </div>
                <?php } else { ?>
                    <form action="" method="post" id="surveyForm" enctype="multipart/form-data">
                        <!-- User Details -->
                        <div style="border:2px solid #666; padding:10px; margin:5px; border-radius:10px;">
                            <div class="mb-2 row">
                                <label for="name" class="col-sm-2 col-form-label labelcolor">NAME:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-50 mb-1" id="name" name="name" value="<?php echo $title; ?>" readonly>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label for="email" class="col-sm-2 col-form-label labelcolor">EMAIL:</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control w-50 mb-1" id="email" name="email" value="<?php echo $email; ?>" readonly>
                                </div>
                            </div>
                            <div style="color:black; margin-left:10px;">
                                <p style="color:#ca1919; font-size:18px; font-weight:bolder;">All questions marked with (*) are compulsory to fill.</p>
                            </div>
                        </div>
                        <?php
                        $data2 = $survey->viewQuestion($hid);
                        // echo "<pre>";
                        // print_r($data2);
                        // echo "</pre>";
                        ?>
                        <div>
                            <?php
                            foreach ((array)@$data2 as $ques => $option) {
                                foreach ($option as $k => $v) {
                                    @$compulsory = $v['iscompulsory'];
                                } ?>
                                <div style="border:2px solid #666; padding:10px; border-radius:10px; margin:5px;">
                                    <span class='labelcolor'><b> Question: <?php if ($compulsory == "Yes") { ?>
                                                <span class="requiredques">*</span>&nbsp;
                                            <?php } ?>
                                        </b></span><span class='labelcolor'><?php echo $ques ?></span><br><?php if ($compulsory == "Yes") { ?>
                                        <div class="error_msg" style="color:#ca1919;"></div>
                                    <?php } ?><br>
                                    <?php $len = count($option);
                                    $j = 0;
                                    foreach ($option as $key => $val) {
                                        $required = $compulsory == "Yes" ? "required" : "";
                                        if ($val['type'] == 'mcq') { ?>
                                            <div class="input_check"><input type="checkbox" id= "<?php echo $val['ques_id']; ?>" class="checkboxes<?php echo $val['ques_id']; ?>" name="answer[<?php echo $val['ques_id']; ?>][]" value="<?php echo $val['options']; ?>" <?php echo $required ?>> &nbsp;<span class="optdata"><?php echo $val['options']; ?></span></div><br>
                                        <?php } elseif ($val['type'] == 'radio') { ?>
                                            <div class="input_check"><input type="radio" name="answer[<?php echo $val['ques_id']; ?>][]" value="<?php echo $val['options']; ?>" <?php echo $required ?>> &nbsp;<span class="optdata"> <?php echo $val['options']; ?></span></div><br>
                                        <?php } elseif ($val['type'] == 'mcq_comment') {
                                            if ($j <= $len) {  ?>
                                                <div class="input_check"><input type="checkbox"  name="answer[<?php echo $val['ques_id']; ?>][<?php echo $val['type']; ?>][]" value="<?php echo $val['options']; ?>" class="checkboxes<?php echo $val['ques_id']; ?>" <?php echo $required ?>> &nbsp;<span class="optdata"> <?php echo $val['options']; ?></span></div>
                                           <?php }
                                            $j++;
                                        } elseif ($val['type'] == 'radio_comment') {
                                            if ($j <= $len) { ?>
                                                <div class="input_check"><input type="radio" name="answer[<?php echo $val['ques_id']; ?>][<?php echo $val['type']; ?>][]" class="checkboxes<?php echo $val['ques_id']; ?>" value="<?php echo $val['options']; ?>" <?php echo $required ?>> &nbsp; <span class="optdata"><?php echo $val['options']; ?></span></div>
                                           <?php }
                                            $j++;
                                        } elseif ($val['type'] == 'text') { ?>
                                            <div class="mb-3" style="width:350px;"><textarea class="form-control" name="answer[<?php echo $val['ques_id']; ?>][<?php echo $val['type']; ?>][]" aria-label="With textarea" rows="4" cols="5" style="font-size:14px;" <?php echo $required ?>></textarea></div> <br>
                                        <?php } elseif ($val['type'] == 'email') { ?>
                                            <div class="input-group mb-3" style="width:350px;">
										<div class="input-group-prepend">
											<div class="input-group-text"  style="height:43px;">
												<i class="bx bx-at"><label type="email" aria-label="Email for following text input" name="email" disabled></i>
											</div>
										</div>
										<input type="email" name="answer[<?php echo $val['ques_id']; ?>][]" <?php echo $required ?> class="form-control" aria-label="Text input with email">
									</div><br>
                                       <?php } elseif ($val['type'] == 'one_word') { ?>
                                            <div class="input-group mb-3" style="width: 350px;"><div class="input-group-prepend"><span class="input-group-text">Single Word</span></div><input class="form-control input-sm" id="inputsm" type="text" name="answer[<?php echo $val['ques_id']; ?>][<?php echo $val['type']; ?>][]" <?php echo $required ?>></div><br>
                                       <?php } elseif ($val['type'] == 'file') { ?>
                                            <div class="mb-3" style="width:370px;">
                                    <label for="file" class="form-label">Upload file</label>
                                    <input type="hidden" name="answer[<<?php echo $val['ques_id']; ?>][<<?php echo $val['type']; ?>][]">
                                    <input class="form-control form-control-lg" type="file" name="file"  id="file" <?php echo $required ?>>
                                </div><br>
                                        <?php } elseif ($val['type'] == 'date') { ?>
                                            <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Date and Time</span>
                                    </div>
                                    <input type="datetime-local" style="width: 220px;" id="datetime" name="answer[<?php echo $val['ques_id'] ?>][<?php echo $val['type'] ?>][]" <?php echo $required ?>>
                                    </div>
                                       <?php } elseif ($val['type'] == 'rating') { ?>
                                            <label style="margin-left:30%; color:#805417;">Star Rating (Choose between 1 to 5 star):</label>
                                            <div class="rating" name="rating[<?php echo $val['ques_id'] ?>]" id="rating_<?php echo $val['ques_id'] ?>" <?php echo $required ?>>
									<input type="radio" name="answer[<?php echo $val['ques_id'] ?>][<?php echo $val['type'] ?>][]" value="5" id="5_<?php echo $val['ques_id'] ?>"><label for="5_<?php echo $val['ques_id'] ?>" >☆</label>
									<input type="radio" name="answer[<?php echo $val['ques_id'] ?>][<?php echo $val['type'] ?>][]" value="4" id="4_<?php echo $val['ques_id'] ?>"><label for="4_<?php echo $val['ques_id'] ?>">☆</label>
									<input type="radio" name="answer[<?php echo $val['ques_id'] ?>][<?php echo $val['type'] ?>][]" value="3" id="3_<?php echo $val['ques_id'] ?>"><label for="3_<?php echo $val['ques_id'] ?>">☆</label>
									<input type="radio" name="answer[<?php echo $val['ques_id'] ?>][<?php echo $val['type'] ?>][]" value="2" id="2_<?php echo $val['ques_id'] ?>"><label for="2_<?php echo $val['ques_id'] ?>">☆</label>
									<input type="radio" name="answer[<?php echo $val['ques_id'] ?>][<?php echo $val['type'] ?>][]" value="1" id="1_<?php echo $val['ques_id'] ?>"><label for="1_<?php echo $val['ques_id'] ?>">☆</label>
								</div><br>
                                       <?php }
                                    }
                                    if ($val['type'] == 'radio_comment' || $val['type'] == 'mcq_comment') { ?>
                                        <div class="mb-3" style="width:350px;"><textarea class="form-control" name="answer[<?php echo $val['ques_id'] ?>][cmt]" aria-label="With textarea" rows="4" cols="5" style="font-size:14px;" placeholder="Enter reason here!!" <?php echo $required ?>></textarea></div> <br>
                                    <?php }
                                    ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="card-footer text-end mt-2 ">
                            <button type="submit" name="save" id="btnSubmit" class="btn mt-2" style="background-color:#347243; color:white;" <?php echo @$disabled; ?>>Submit</button>
                            <button type="submit" name="Clear Form" id="btnReset" value="reset" class="btn mt-2" style="background-color:#1f64ca; color:white;" <?php echo @$disabled; ?> onclick="return confirm('Are you sure you want to clear the form?');">Clear Form</button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $('input[type=checkbox]').change(function() {

            var checkClass = $(this).attr('class');
            if ($('.' + checkClass + ':checked').length > 0) {
                $('.' + checkClass).prop('required', false);
            } else {
                $('.' + checkClass).prop('required', true);
            }
        });

        $('#btnSubmit').on("click", function() {
            let valid = true;
            $('.error_msg').html("");
            $('[required]').each(function() {
                if ($(this).is(':invalid') || !$(this).val()) {
                    $(this).parent().siblings('span').next().next().html("**This question is required");
                    valid = false;
                }
            })
        });
    </script>

</body>

</html>