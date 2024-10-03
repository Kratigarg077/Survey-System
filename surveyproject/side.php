

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side-bar</title>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/"> -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/side.css">
    <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>
<body style= "background-color: #96c9d9;">


<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height:30px;">
  <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <li><a href="logout.php" style ="color:white;"><i class='bx bx-log-out'></i> Logout</a></li>
  </ul>
  <i class='bx bx-log-out'></i>
</nav> -->

<div id="wrapper">

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: #11101d;">

<ul class="nav navbar-right top-nav">           
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['admin_name']; ?> </a>
        <ul class="dropdown-menu">
            <li><a href="admin_profile.php"><i class="fa fa-fw fa-user"></i>View Profile</a></li>
            <!-- <li><a href="#"><i class="fa fa-fw fa-cog"></i> Change Password</a></li> -->
            <li class="divider"></li>
           <li><a href="logout.php"><i class='bx bx-log-out'></i> Logout</a></li>
        </ul>
    </li>
</ul>
</nav>
</div>

    <div class="sidebar" >
      <div class="logo_content">
        <div class="logo">
          <i class='bx bxs-group'></i>
          <div class="logo_name">Survey</div>
        </div>
        <i class='bx bx-menu' id="btn"></i>
      </div>
      <ul class="nav_list">
        <li>
          <i class='bx bx-search' ></i>
          <input type="text" placeholder="Search...">
          <span class="tooltip">Search</span>
        </li>
      <!-- <li>
        <a href="new_user.php">
        <i class='bx bx-user'></i>
        <span class="link_names">Users</span>
        </a>
        <span class="tooltip">Users</span>
      </li> -->
      <li class=" dropdown">
        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class='bx bx-user'></i><span class="link_names">Users</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="new_user.php">New User</a>
          <a class="dropdown-item" href="user_list.php">User List</a>
        </div>
        <span class="tooltip">Users</span>
      </li>


      <li>
        <a href="side.php">
        <i class='bx bx-grid-alt'></i>
        <span class="link_names">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>

      <li class=" dropdown ">
        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class='bx bx-user'></i><span class="link_names">Survey</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="newsurvey.php">New Survey</a>
          <a class="dropdown-item" href="survey_list.php">Survey List</a>
        </div>
        <span class="tooltip">Survey</span>
      </li>


      <li>
        <a href="#">
        <i class='bx bx-notepad'></i>
        <span class="link_names">Questions</span>
        </a>
        <span class="tooltip">Questions</span>
      </li>

      <li>
        <a href="#">
        <i class='bx bxs-report'></i>
        <span class="link_names">Report</span>
        </a>
        <span class="tooltip">Report</span>
      </li>
    </ul>
</div>
    <!-- <div class="profile_content">
      <div class="profile">
        <div class="profile_details">
        <i class='bx bxs-user-account'></i>
          <div class="name_job">
            <div class="name">A</div>
            <div class="job">B</div>
          </div>
        </div>
        <i class='bx bx-log-out' id="log_out"></i>
      </div>
    </div>
</div> -->

    <div class="home_content">
      <div class="text"> 

    </div>
  </div>

    <script>
      let btn = document.querySelector("#btn");
      let sidebar = document.querySelector(".sidebar");
      let searchBtn = document.querySelector(".bx-search");

      btn.onclick = function(){
        sidebar.classList.toggle("active");
      }

      searchBtn.onclick = function(){
        sidebar.classList.toggle("active");
      }
    </script> 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
require_once('config.php');
?>