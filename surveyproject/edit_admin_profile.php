<?php
include 'config.php';
include_once 'nav.php';


if(isset($_POST['update_form'])){
    // $hid= $_SESSION['id'];
	extract($_POST);
	$query= "UPDATE `users` SET `User_name`='$name',`User_email`='$email' WHERE `User_id` = '$hid'";
	$data= mysqli_query($con, $query);

	if($data){
		header("location:admin_profile.php");
	}
	else{
		echo "<script>alert('Failed to update data')</script>";
	}
}

?>


<link href="css/profile.css" rel="stylesheet">

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item "><a href="admin_profile.php">Profile</a></li>
                <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="col-xl-6" style="margin:auto;">

            <div class="card">
                <div class="card-body pt-3">

                    <h2>Name</h2>


                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                        <li class="nav-item">
                            <button class="nav-link active" id="nav-profile-edit" data-toggle="tab" href="#profile-edit" role="tab" aria-selected="false">Edit Profile</button>
                        </li>


                    </ul>

                    <!-- Profile Edit Form -->

                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit" role="tabpanel" aria-labelledby="nav-profile-edit">
                            <form>
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text" class="form-control" id="fullName" value="<?php echo $_SESSION['name'];?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Role</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="job" type="text" class="form-control" id="Job" value="Admin">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email" value="<?php echo $_SESSION['email'];?>">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="update_form">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <?php
    include_once 'nav_bottom.php';
    ?>