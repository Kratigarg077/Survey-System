<?php
//start session
session_start();

include 'config/connection.php';
include 'controllers/usercontroller.php';

$user = new user;

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $query = $user->check_login($email);
  if ($query) {
    $result = $user->get_data($email, $password);
  }
}
if (!empty($_POST["remember"])) {
  //COOKIES for username
  setcookie("user_login", $_POST["email"], time() + (10 * 365 * 24 * 60 * 60));
  //COOKIES for password
  setcookie("userpassword", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
} else {
  if (isset($_COOKIE["user_login"])) {
    setcookie("user_login", "");
    if (isset($_COOKIE["userpassword"])) {
      setcookie("userpassword", "");
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="/css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="/img.jpg" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1" style="margin-top:10%;">
          <form method="post" onsubmit="return validateForm();">
            <?php
            if (@$_SESSION['pass_reset'] == 1) {
            ?>
              <div class="alert alert-success" role="alert">
                Password changed successfully, Please Login Again!!
              </div>
            <?php
            }
            unset($_SESSION['pass_reset']);
            if (@$_SESSION['auth'] == 1) {
              ?>
                <div class="alert alert-warning" role="alert">
                Invalid Username OR Password. Please try again!!
                </div>
              <?php
              }
              unset($_SESSION['auth']);
              if (@$_SESSION['checkemail'] == 1) {
                ?>
                  <div class="alert alert-warning" role="alert">
                  Email Not Registered !!
                  </div>
                <?php
                }
                unset($_SESSION['checkemail']);
            ?>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
              <label class="form-label" for="email">Email address:</label>
              <br><input type="email" name="email" id="email" class=" form-control-lg" placeholder="Enter a valid email address" style="width: 67vh;" value="<?php if (isset($_COOKIE["user_login"])) {
                                                                                                                                                                echo $_COOKIE["user_login"];
                                                                                                                                                              } ?>" />

              <span id="f_email" class="text-danger"></span>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
              <label class="form-label" for="password">Password:</label>
              <br> <input type="password" name="password" id="password" class=" form-control-lg" placeholder="Enter password" style="width: 67vh;" value="<?php if (isset($_COOKIE["userpassword"])) {
                                                                                                                                                            echo $_COOKIE["userpassword"];
                                                                                                                                                          } ?>" />
              <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
              <span id="f_password" class="text-danger"></span>
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" name="remember" id="remember" <?php if (isset($_COOKIE["user_login"])) { ?> checked <?php } ?> type="checkbox" + />
                <label class="form-check-label" for="remember">
                  Remember me
                </label>
              </div>
              <!-- <a href="forgot.php" class="text-body">Forgot password?</a><br><br> -->
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" name="login" class="btn btn-light btn-lg btn-outline-dark">Login</button>
              <!-- <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="register.php" class="link-success">Register</a></p> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="/js/login.js"></script>
  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>

</html>