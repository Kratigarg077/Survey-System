<?php
require_once('config.php');

@$name = $_POST['name'];
@$email = $_POST['Email'];
@$password = md5($_POST['Password']);
//extract($_POST);

if(isset($_POST['signup']))
{

    $query1= "SELECT `User_email` FROM `Users` WHERE `User_email` = '$email' ";
    $data1= mysqli_query($con, $query1);

    if(!(mysqli_num_rows($data1)>0)){

     $query2 = "INSERT INTO `users`( `User_name`,  `User_email`, `User_password`, `User_role`) VALUES ('$name','$email','$password','Admin')";
     $data2= mysqli_query($con,$query2);

     if($data2){
      header('location:login.php');

     //echo "<script>alert('Registered Successfully')</script>";

     }

    //  header('location:login.php');
     
    else{
     echo "<script>alert('Unsuccessful')</script>";
    }
  }
  else{
    echo "<script>alert('Email already registered')</script>";
  }
}
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SURVEY SIGN UP</title>
   
    

<!-- CSS only -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-1">Sign up</p>
      
                      <form class="mx-1 mx-md-4" action="" method="post" onsubmit="return validateForm();">
                        <label class="form-label" for="name">&nbsp &nbsp &nbsp &nbsp &nbsp Name</label>
                        <div class="d-flex flex-row align-items-center mb-4">
                              
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input name ="name" type="text" id="name" class="form-control" s/>
                            <span id="f_name" class="text-danger"></span>
                          </div>
                        </div>
                        <label class="form-label" for="email">&nbsp &nbsp &nbsp &nbsp &nbsp Email</label>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input name="Email" type="text" id="email" class="form-control" />
                            <span id="f_email" class="text-danger"></span>
                          </div>
                        </div>
                        <label class="form-label" for="password">&nbsp &nbsp &nbsp &nbsp &nbsp Password</label>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input name="Password" type="password" id="password" class="form-control"  />
                            <span id="f_password" class="text-danger"></span>
                            <span id="f_password1" class="text-danger"></span>
                            <span id="f_password2" class="text-danger"></span>
                            <span id="f_password3" class="text-danger"></span>
                            <span id="f_password4" class="text-danger"></span>
                          </div>
                        </div>
                        <!--
                        <label class="form-label" for="form3Example4cd">&nbsp &nbsp &nbsp &nbsp &nbsp Repeat your password</label>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="form3Example4cd" class="form-control" required/>
                          </div>
                        </div>-->
      
                        <div class="form-check d-flex justify-content-center mb-5">
                          <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c"  />
                          <label class="form-check-label" for="form2Example3">
                            I agree all statements in <a href="#!">Terms of service</a>
                          </label>
                        </div>
      
                        <!-- <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <input type="submit" name="submit" class="btn btn-light btn-lg btn-outline-dark" value="Submit">
                        </div> -->

                        <div class="text-center text-lg-start mt-4 pt-2">
                          <input type="submit" name="signup" class="btn btn-light btn-lg btn-outline-dark mx-5"  value="Register">
                            <p class="small fw-bold mt-2 pt-1 mb-0 mx-2">Already Registered? <a href= "login.php"
                                class="link-success">Login</a></p>
                          </div>
      
                      </form>
      
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
      
                      <img src="https://www.pcma.org/wp-content/uploads/2021/03/Survey.jpeg"
                        class="img-fluid" alt="Sample image">
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      

    
<!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> 
<!-- <script src="<?=$SITEURL;?>/js/register.js"></script> -->
<script src="/js/register.js"></script>
</body>
</html>