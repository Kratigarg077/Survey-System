<?php
include 'config/connection.php';
include 'controllers/usercontroller.php';
include 'nav.php';

$user = new user;

//fetch user data
$qry = $user->fetch_data($_SESSION['id']);
$row = mysqli_fetch_array($qry);
?>
<link href="css/profile.css" rel="stylesheet">

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <?php if ($_SESSION['role'] == 'User') { ?>
                    <li class="breadcrumb-item">Users</a></li>
                <?php
                } else if ($_SESSION['role'] == 'Admin') { ?>
                    <li class="breadcrumb-item">Admin</a></li>
                <?php } else { ?>
                    <li class="breadcrumb-item">Management</a></li>
                <?php } ?>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="col-xl-6 " style="margin:auto;">
            <?php if (@$_SESSION['update_user'] == 1) {
            ?>
                <div id="msg1" class="alert alert-success" role="alert" style="width:80%;">
                    User Updated Successfully!!
                </div>
            <?php
                $_SESSION['update_user'] = 0;
            } ?>
            <div class="card bgcolor" style="width:80%; border-top:4px solid #585656;">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active ylwcolor" id="nav-profile-overview" data-toggle="tab" href="#profile-overview" role="tab" aria-selected="false"><span class="labelcolor">Overview</span></button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview" style="margin-left:20%;" role="tabpanel" aria-labelledby="nav-profile-overview">
                            <h5 class="card-title">Profile Details</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label "><b>Name:</b></div>
                                <div class="col-lg-9 col-md-8 labelcolor"><?php echo $row['User_name']; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label"><b>Role:</b></div>
                                <div class="col-lg-9 col-md-8 labelcolor"><?php echo $row['User_role']; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label"><b>Email:</b></div>
                                <div class="col-lg-9 col-md-8 labelcolor"><?php echo $row['User_email']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label"><b>Gender:</b></div>
                                <div class="col-lg-9 col-md-8 labelcolor"><?php echo $row['User_gender']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label"><b>Contact No.:</b></div>
                                <div class="col-lg-9 col-md-8 labelcolor"><?php echo $row['Contact_number']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script>
        setTimeout(() => {
            $('#msg1').css('display', 'none');
        }, 3500);
    </script>
    <?php
    include_once 'nav_bottom.php';
    ?>