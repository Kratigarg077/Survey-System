<?php
include_once('config/connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PhpMailer/Exception.php');
require('PhpMailer/PHPMailer.php');
require('PhpMailer/SMTP.php');

class invitation
{
    // Database connection
    public function __construct()
    {
        $db = new db;
        $this->con = $db->con;
    }
    public function inviteUser($hid, $name, $email, $title, $description, $message, $invited_by)
    {
        $flag = false;
        // Create an instance(object) of PHPMailer class; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'kratigarg077@gmail.com';               //SMTP username
            $mail->Password   = 'mpgsaawgusphzvuh';                       //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption; PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 587;                                    //TCP port to connect to; use 465 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_SMTPS`

            //Recipients
            $mail->setFrom('kratigarg077@gmail.com', 'Krati');
            $lnk = md5($email . time());
            $url = "192.168.1.100/survey_form.php?survey_id=$hid&invite_key=$lnk";
            $link = "<a href='$url'> Click Here </a>";
            $query = $this->con->query("INSERT INTO `invitations`(`Survey_Id`, `invitation_to_name`, `invitation_to_email`, `invitation_link`, `invited_by`, `invitation_subject`, `invitation_message`) VALUES ('$hid','$name','$email','$lnk','$invited_by','$title','$message')");
            $flag = true;

            $mail->addAddress($email);
            // Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $title;
            $mail->Body = "<div style='background-color:#e3e1e1; padding:20px;'> 
                <p>$message </p>
                <p><b>$title: </b> $description</p>
                <p>Below is your invitation link to fill the Survey:<br> $link</p>";
            $mail->send();
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
        }
        if ($flag) {
            $_SESSION['invite_user'] = 1;
        }
    }

    public function fetchDataFromInvitation($invite_key)
    {
        $qry = $this->con->query("SELECT * FROM `invitations` WHERE invitation_link='$invite_key'");
        return $qry;
    }

    public function InvitedUsers($id)
    {
        $qry = $this->con->query("SELECT * FROM `invitations` WHERE Survey_Id='$id'");
        $data = $qry->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function checkEmail($hid, $email)
    {
        $sql = "SELECT `invitation_to_email` FROM `invitations` WHERE `invitation_to_email`='$email' && `survey_id`='$hid'";
        $query = $this->con->query($sql);
        $res = mysqli_fetch_assoc($query);
        if ($email == isset($res['invitation_to_email'])) {
            return true;
        } else {
            return false;
        }
    }
    public function emailInAnswers($id,$email){
        $qry = $this->con->query("SELECT distinct(answer_submitted_email) FROM `answers` WHERE `answer_submitted_email`='$email' AND `Survey_Id`='$id'");
        $res = mysqli_fetch_assoc($qry);
        if ($email == isset($res['answer_submitted_email'])) {
            return true;
        } else {
            return false;
        }
    }

    public function fetchAnswers($email,$id){
        $qry = $this->con->query("SELECT * FROM `answers` WHERE `answer_submitted_email`='$email' AND `Survey_Id`='$id'");
        $data = $qry->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
}
