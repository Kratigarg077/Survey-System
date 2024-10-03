<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['name']) ||(trim ($_SESSION['name']) == '')){
	header('location:index/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <title>Dashboard</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="/css/side.css">
  <link href="css/profile.css" rel="stylesheet">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

  <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</head>

<body style="background-color: #e3e1e1;">
  <div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: #11101d;">
      <ul class="nav navbar-right top-nav" >
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name']; ?></a>
          <ul class="dropdown-menu" style="background-color: #e3e1e1; border-radius:12px;">
            <li><a href="admin_profile.php"><i class="fa fa-fw fa-user"></i> View Profile</a></li>
            <!-- <li><a href="admin_profile.php?admin_id=<?php echo $row['User_id']; ?>"><i class="fa fa-fw fa-user"></i> View Profile</a></li> -->
            <li class="divider"></li>
            <li><a href="update_user.php"><i class='bx bx-edit-alt' ></i> Edit Profile</a></li>
            <li class="divider"></li>
            <li><a href="changepass.php"><i class='bx bx-reset'></i> Reset Password</a></li>
            <li class="divider"></li>
            <li><a href="logout.php"><i class='bx bx-log-out'></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>

  <div class="sidebar">
    <div class="logo_content">
      <div class="logo">
        <i class='bx bxs-group'></i>
        <div class="logo_name" >Survey</div>
      </div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav_list" id="myList">
      <li>
        <i class='bx bx-search'></i>
        <input type="text" id="myInput" placeholder="Search...">
        <span class="tooltip">Search</span>
      </li>
      <li>
        <a href="dashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="link_names">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <?php
      if ($_SESSION['role'] == 'Admin') { ?>
        <li class="dropdown">
          <a class="" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class='bx bx-user'></i><span class="link_names">Users</span>
          </a>
          <div class="dropdown-menu" style="background-color: #e3e1e1; border-radius:12px;" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="new_user.php">New User</a>
            <a class="dropdown-item" href="user_list.php">User List</a>
          </div>
          <span class="tooltip">Users</span>
        </li>
      <?php
      }
      ?>
    <?php if ($_SESSION['role'] != 'Management') { ?> 
      <li class=" dropdown ">
        <a class="" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class='bx bx-highlight'></i><span class="link_names" >Survey</span>
        </a>
        <div class="dropdown-menu" style="background-color: #e3e1e1; border-radius:12px;" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="newsurvey.php">New Survey</a>
          <a class="dropdown-item" href="survey_list.php">Survey List</a>
        </div>
        <span class="tooltip">Survey</span>
      </li>
      <?php } ?>
      <li>
        <a href="report.php">
          <i class='bx bxs-report'></i>
          <span class="link_names">Report</span>
        </a>
        <span class="tooltip">Report</span>
      </li>
    </ul>
  </div>
  <div class="home_content">
    <div class="text">