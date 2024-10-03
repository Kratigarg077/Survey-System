<?php
include 'config/connection.php';
include 'controllers/usercontroller.php';
include 'nav.php';

$user = new user;

if (isset($_POST['Submit'])) {
    $oldpass = md5($_POST['opwd']);
    $useremail = $_SESSION['email'];
    $newpassword = md5($_POST['npwd']);

    $query = $user->check_pass($useremail, $oldpass);
    if ($query) {
        $result = $user->change_pass($_SESSION['id'], $useremail, $newpassword);
    }
}
?>
<style>
    .table-bordered th,
    td {
        border-style: none !important;
    }
</style>

<div class="col-xl-5" style="margin:auto;">
    <div class="card" style="height: 50vh; margin: 80px 30px;">
        <div class="card-body pt-3 bgcolor">
            <?php
            if (@$_SESSION['passmsg'] == 1) {
            ?>
                <p id="msg" style="color:red; width:50%;">**Old Password not match !!</p>
            <?php
                $_SESSION['passmsg'] = 0;
            }
            ?>
            <form name="chngpwd" action="" method="post" onSubmit="return valid();">
                <table>
                    <tr height="50" style="border:none;">
                        <td style="border:none;"><b>Old Password :</b>
                            <span class="requiredques">*</span>
                        </td>
                        <td><input type="password" name="opwd" id="opwd">
                            <i class="far fa-eye" id="togglePassword" style=" cursor: pointer;" value="<?php echo isset($_POST["opwd"]) ? $_POST["opwd"] : ''; ?>"></i>
                        </td>
                        <span id="f_opwd" class="text-danger"></span>
                    </tr>
                    <tr height="50">
                        <td><b>New Password :</b>
                            <span class="requiredques">*</span>
                        </td>
                        </td>
                        <td><input type="password" name="npwd" id="npwd" value="<?php echo isset($_POST["npwd"]) ? $_POST["npwd"] : ''; ?>">
                            <i class="far fa-eye" id="togglePassword1" style=" cursor: pointer;"></i>
                        </td>
                        <span id="f_npwd" class="text-danger"></span>
                        <span id="f_password" class="text-danger"></span>
                    </tr>
                    <tr height="55">
                        <td><b>Confirm Password :</b>
                            <span class="requiredques">* &nbsp;</span>
                        </td>
                        <td><input type="password" name="cpwd" id="cpwd" class="password" value="<?php echo isset($_POST["cpwd"]) ? $_POST["cpwd"] : ''; ?>">
                            <i class="far fa-eye" id="togglePassword2" style=" cursor: pointer;"></i>
                        </td>
                        <span id="f_cpwd" class="text-danger"></span>
                    </tr>

                    <br>
                    <ul style="margin-left:2vh;">
                        <li style=" font-size:12px;">Length of password should be more than 4.</li>
                        <li style=" font-size:12px;">Password must contain At least One Upper case.</li>
                        <li style=" font-size:12px;">Password must contain At least One Lower case.</li>
                        <li style=" font-size:12px;">Password must contain At least one digit.</li>
                        <li style=" font-size:12px;">Password must contain At least one special character.</li>
                    </ul>
                    <tr>
                        <td><br><button class="btn mr-2" type="submit" name="Submit" style=" font-size:small; color:white; background-color: #347243;">Change Password</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function valid() {
        $("#f_password").html("");
        $("#f_opwd").html("");
        $("#f_npwd").html("");
        $("#f_cpwd").html("");

        var pass = /[A-Z]/;
        var pass1 = /[a-z]/;
        var pass2 = /[0-9]/;
        var pass3 = /[~`!@#$%^&*()\[\]\\.,;:\s@"\-\\_+={}<>?]/;

        if (document.chngpwd.opwd.value == "") {
            $("#f_opwd").html("**Old Password Filed is Empty !!");
            // alert("Old Password Filed is Empty !!");
            document.chngpwd.opwd.focus();
            return false;
        } else if (document.chngpwd.npwd.value == "") {
            $("#f_npwd").html("**New Password Filed is Empty !!");
            // alert("New Password Filed is Empty !!");
            document.chngpwd.npwd.focus();
            return false;
        } else if (document.chngpwd.cpwd.value == "") {
            $("#f_cpwd").html("**Confirm Password Filed is Empty !!");
            // alert("Confirm Password Filed is Empty !!");
            document.chngpwd.cpwd.focus();
            return false;
        } else if (document.chngpwd.npwd.value != document.chngpwd.cpwd.value) {
            $("#f_cpwd").html("**Password and Confirm Password Field do not match  !!");
            // alert("Password and Confirm Password Field do not match  !!");
            document.chngpwd.cpwd.focus();
            return false;
        } else if (document.chngpwd.npwd.value.length < 5) {
            $("#f_password").html("**Length of password should be more than 4");
            return false;
        } else if (!pass.test(document.chngpwd.npwd.value)) {
            $("#f_password").html("**Password must contain At least One Upper case<br>");
            return false;
        } else if (!pass1.test(document.chngpwd.npwd.value)) {
            $("#f_password").html("**Password must contain At least One Lower case<br>");
            return false;
        } else if (!pass2.test(document.chngpwd.npwd.value)) {
            $("#f_password").html("**Password must contain At least one digit<br>");
            return false;
        } else if (!pass3.test(document.chngpwd.npwd.value)) {
            $("#f_password").html("**Password must contain At least one special character<br>");
            return false;
        }
        return true;
    }

    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#opwd');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
    const togglePassword1 = document.querySelector('#togglePassword1');
    const password1 = document.querySelector('#npwd');

    togglePassword1.addEventListener('click', function(e) {
        // toggle the type attribute
        const type1 = password1.getAttribute('type') === 'password' ? 'text' : 'password';
        password1.setAttribute('type', type1);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
    const togglePassword2 = document.querySelector('#togglePassword2');
    const password2 = document.querySelector('#cpwd');

    togglePassword2.addEventListener('click', function(e) {
        // toggle the type attribute
        const type2 = password2.getAttribute('type') === 'password' ? 'text' : 'password';
        password2.setAttribute('type', type2);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

    setTimeout(() => {
        $('#msg').css('display', 'none');
    }, 3500);
</script>
<?php
include 'nav_bottom.php';
?>