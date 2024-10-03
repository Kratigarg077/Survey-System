
<?php
include_once('config/connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PhpMailer/Exception.php');
require('PhpMailer/PHPMailer.php');
require('PhpMailer/SMTP.php');

class user
{
    // Database connection
    public function __construct()
    {
        $db = new db;
        $this->con = $db->con;
    }

    // Login Credientials
    public function check_login($email)
    {
        $sql = "SELECT User_email FROM users WHERE User_email = '$email'";
        $query = $this->con->query($sql);
        $res = mysqli_num_rows($query);
        if ($res > 0) {
            return $query;
        } else {
            $_SESSION['checkemail'] = 1;
        }
    }

    public function get_data($email, $password)
    {
        $sql = "SELECT * FROM users WHERE User_email = '$email' AND User_password = '$password'";
        $query = $this->con->query($sql);
        $res = mysqli_fetch_array($query);

        if ($res > 0) {
            $_SESSION['name'] = $res['User_name'];
            $_SESSION['email'] = $res['User_email'];
            $_SESSION['role'] = $res['User_role'];
            $_SESSION['gender'] = $res['User_gender'];
            $_SESSION['contact'] = $res['Contact_number'];
            $_SESSION['id'] = $res['User_id'];

            header("location:dashboard.php?success==1");
            return $query;
        } else {
            // $_SESSION['message'] = 'Invalid username or password';
            $_SESSION['auth'] = 1;
            // echo "<script>alert('Invalid Username OR Password. Please try again');</script>";
        }
    }

    // User Credentials
    public function check_email($email)
    {
        $sql = "SELECT User_email FROM users WHERE User_email = '$email'  && u_status='Active'";
        $query = $this->con->query($sql);
        $res = mysqli_fetch_assoc($query);
        if ($email == isset($res['User_email'])) {
            $_SESSION['emailflag'] = 1;
        } else {
            $_SESSION['emailflag'] = 0;
            return $query;
        }
    }

    public function create_user($id, $name, $gender, $email, $contact, $role)
    {
        date_default_timezone_set('Asia/Kolkata'); // set your timezone
        $todaydate = date("Y-m-d H:i:s");

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
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            $psw1 = implode($pass);
            // echo ($psw1);
            $psw = md5($psw1);
            $mail->addAddress($email);    //Reciever's email

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Login Credentials!!';
            $mail->Body    = "Below are your Login Details:<br> <b>Username: </b> $email <br> <b>Password: </b> $psw1";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // $pass = sha1(trim($psw));

        $sql = "INSERT INTO `users`(`User_id`, `User_name`, `Contact_number`, `User_email`, `User_gender`, `User_role`, `User_password`,`User_created_by`,`User_updated_by`,`User_updated_date`) VALUES (NULL, '$name', '$contact', '$email', '$gender', '$role', '$psw','$id','$id','$todaydate')";
        $query = $this->con->query($sql);
        $_SESSION['new_user'] = 1;
        if ($query) {
            echo "<script>
            window.location.href='user_list.php?success=1';
            </script>";
            return $query;
        } else {
            echo "Cannot create User!!";
        }
    }

    public function fetch_data($id)
    {
        $result = $this->con->query("SELECT * FROM users WHERE `User_id`='$id'");
        return $result;
    }

    public function user_data(){
        $result = $this->con->query("SELECT * FROM users WHERE `u_status`='Active'");
        return $result;
    }

    public function update($hid, $name, $email, $gender, $contact, $type)
    {
        date_default_timezone_set('Asia/Kolkata'); // set your timezone
        $todaydate = date("Y-m-d H:i:s");
        $result = $this->con->query("UPDATE `users` SET `User_name`='$name',`User_gender`='$gender',`Contact_number`='$contact',`User_role`='$type',`User_email`='$email',`User_updated_by`='$hid',`User_updated_date`='$todaydate' WHERE `User_id` = '$hid'");
        if ($result) {
            $_SESSION['update_user'] = 1;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $type;
            $_SESSION['gender'] = $gender;
            $_SESSION['contact'] = $contact;
            echo "<script>
            window.location.href='admin_profile.php';
            </script>";
            return $result;
        } else {
            echo "<script>alert('Failed to update Data')</script>";
        }
    }

    public function delete($id)
    {
        $result = $this->con->query("UPDATE `users` SET `u_status` = 'Deleted' WHERE `User_id`= '$id'");
        $_SESSION['delete_user'] = 1;
        if ($result) {
            header("location:user_list.php?success==1");
            return $result;
        }
    }

    public function check_pass($email, $password)
    {
        $sql = "SELECT `User_password` FROM users WHERE User_email='$email'";
        $result = $this->con->query($sql);
        $arr = mysqli_fetch_array($result);
        $oldpass = $arr['User_password'];
        if ($oldpass == $password) {
            return $result;
        } else {
            $_SESSION['passmsg'] = 1;
        }
    }
    public function change_pass($id, $email, $password)
    {
        date_default_timezone_set('Asia/Kolkata'); // set your timezone
        $todaydate = date("Y-m-d H:i:s");

        $sql = "UPDATE `users` SET `User_password`='$password',`User_updated_by`='$id',`User_updated_date`='$todaydate' WHERE `User_email` = '$email'";
        $result = $this->con->query($sql);

        if ($result) {
            $_SESSION['pass_reset'] = 1;
            echo "<script>window.location.href='login.php';
            </script>";
            return $result;
        } else {
            echo "<script>alert('Failed to update Password ');
            window.location.href='changepass.php';
            </script>";
        }
    }

    public function user_count()
    {
        $qry = $this->con->query("SELECT count(User_id) as user_count, SUM(u_status='Active') as a_user_count FROM `users`");
        $arr = mysqli_fetch_array($qry);
        return $arr;
    }    

}
