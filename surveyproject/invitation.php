<?php
include 'config/connection.php';
include 'nav.php';
include 'controllers/surveycontroller.php';
include 'controllers/invitationcontroller.php';

@$hid = $_GET['survey_id'];

$survey = new survey;
$invite = new invitation;

@$name = $_POST['name'];
@$email = $_POST['email'];
@$message = $_POST['msg'];

//fetch survey data
$qry = $survey->fetchSurvey_data($hid);
$row = mysqli_fetch_array($qry);
$title = $row['survey_title'];
$description = $row['survey_description'];

if (isset($_POST['invite'])) {
    $email = explode(",", $_POST['email'] . "," . $_POST['name']);
    $len = count($email);
    $len_email = $len / 2;
    $flag_mail = 0;
    $arr= array();
    for ($i = 0; $i < $len_email; $i++) {
        $mail_exist = $invite->checkEmail($hid, $email[$i]);
        if ($mail_exist) {
            $arr[]= $email[$i];
            $flag_mail= 1;
        } 
    }
    if(!$flag_mail){
        // $len = count($email);
        for ($i = 0; $i < $len_email; $i++) {
            $em = [$email[$i]];
            $em1 = implode($em);
            $name =  $email[$len / 2 + $i];
            $query = $invite->inviteUser($hid, $name, $em1, $title, $description, $message, $_SESSION['id']);
        }
    }
}
?>
<link rel="stylesheet" href="/css/loader.css">
<div class="container">
    <div class=" text-center mt-5 ">
        <h1 class="mb-5">Invitation Form</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <?php
            if (@$_SESSION['invite_user'] == 1) {
            ?>
                <div id="msg1" class="alert alert-success" role="alert" style="margin-top:10px; width: 120%;">User Invited Successfully!!</div>
            <?php
                $_SESSION['invite_user'] = 0;
            }
            if (@$flag_mail == 1) {
            ?>
                <div id="msg2" class="alert alert-warning" role="alert" style="margin-top:10px; width: 120%;">
                    Already Invited :  <?php echo implode(", ", $arr); ?>
                </div>
            <?php
            }
            ?>
            <div class="card mt-2 mx-auto p-4 bgcolor" style="height: 110%; width: 120%;">
            <ul style="color:black; margin-left:10px;">
                <li style=" font-size:12px;">For multiple names and emails, enter values in a comma-seperated format i.e., (name1, name2) / (email1, email2)</li>
                <li style=" font-size:12px;">Number of emails should be equal to number of names.</li>
                <li style=" font-size:12px;">Emails and Names should be entered in the proper sequence.</li>
            </ul>
                <div class="card-body bgcolor" style="margin-top: 40px;">

                    <form id="contact-form" role="form" method="post" onsubmit="return saveForm();">
                        <div class="container">
                            <div id="overlay">
                                <div class="w-100 d-flex justify-content-center align-items-center">
                                    <div class="spinner"></div>
                                </div>
                            </div>
                            <div class="controls">
               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name(s)</label>
                                            <span class="requiredques">*</span>
                                            <input id="name" type="text" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>" style="font-size:14px;" class="form-control" placeholder="Please enter name *">
                                            <span id="f_name" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="msg">Message </label>
                                            <span class="requiredques">*</span>
                                            <textarea id="msg" type="text" name="msg" class="form-control" rows="2" style="font-size:14px;"><?php echo isset($_POST["msg"]) ? $_POST["msg"] : ''; ?></textarea>
                                            <span id="f_msg" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject">Subject </label>
                                            <span class="requiredques">*</span>
                                            <input id="subject" type="text" name="subject" style="font-size:14px;" class="form-control" value="<?php echo $title; ?>">
                                            <span id="f_subject" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email(s) </label>
                                            <span class="requiredques">*</span>
                                            <input id="email" type="text" name="email" style="font-size:14px;" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" class="form-control" placeholder="Please enter email *">
                                            <span id="f_email" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <input type="submit" class="btn greencolor btn-send  pt-2 mt-5 btn-block" style="text-transform: uppercase; letter-spacing: 0.2em;" name="invite" value="Invite">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/invitation.js"> </script>
<script>
    setTimeout(() => {
        $('#msg1').css('display', 'none');
    }, 3500);
    setTimeout(() => {
        $('#msg2').css('display', 'none');
    }, 3500);
</script>

<?php
include 'nav_bottom.php';
?>