<?php
include 'config/connection.php';
include 'controllers/usercontroller.php';
include 'nav.php';

$user = new user;

//fetch user data
$qry = $user->fetch_data($_SESSION['id']);
$row = mysqli_fetch_array($qry);

if (isset($_POST['update_form'])) {
	extract($_POST);

	$query = $user->update($_SESSION['id'], $name, $email, $gender, $contact, $type);
}
?>
<link rel="stylesheet" href="/css/loader.css">
<div class="heading">
	<h1 style="text-align:center; margin-top:50px;"> Update User</h1>
</div>
<div class="col-lg-12">
	<div class="card" style="width: 800px; margin: 30px auto;">
		<div class="card-body bgcolor">
			<form action="" id="update_user_profile" style="margin-top:20px;" method="post" onsubmit="return saveForm();">
				<div id="overlay">
					<div class="w-100 d-flex justify-content-center align-items-center">
						<div class="spinner"></div>
					</div>
				</div>
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<b class="text-muted">Personal Information</b>
						<div class="form-group">
							<label for="" class="control-label">Name</label>
							<span class="requiredques">*</span>
							<input type="text" name="name" id="firstname" class="form-control form-control-sm fsize" value="<?php echo $row['User_name']; ?>">
							<span id="f_firstname" class="text-danger"></span>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Contact No.</label>
							<span class="requiredques">*</span>
							<input type="text" name="contact" id="contact" class="form-control form-control-sm fsize" value="<?php echo $row['Contact_number']; ?>">
							<span id="f_contact" class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-6">
						<!-- <b class="text-muted">System Credentials</b> -->
						<div class="form-group">
							<label for="gender" class="control-label">Gender</label>
							<span class="requiredques">*</span>
							<select name="gender" id="gender" class="custom-select custom-select-sm" style="height: fit-content;">
								<?php
								$a = "<option selected>Female</option> <option>Male</option>";
								$b = "<option>Female</option> <option selected>Male</option>";
								echo ($row['User_gender'] == "Female") ? ($a) : ($b);
								?>
							</select>
							<!-- <?php echo $row['User_gender']; ?> -->
						</div>
						<div class="form-group">
							<label for="type" class="control-label">User Role</label>
							<span class="requiredques">*</span>
							<select name="type" id="type" class="custom-select custom-select-sm" style="height: fit-content;">
								<?php
								$a = "<option selected>User</option> <option>Admin</option> <option>Management</option>";
								$b = "<option>User</option> <option selected>Admin</option> <option>Management</option>";
								$c = "<option>User</option> <option>Admin</option> <option selected>Management</option>";
								if ($row['User_role'] == "User") {
									echo $a;
								} else if ($row['User_role'] == "Admin") {
									echo $b;
								} else {
									echo $c;
								}
								?>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Email</label>
							<span class="requiredques">*</span>
							<input type="text" class="form-control form-control-sm fsize" name="email" id="email" value="<?php echo $row['User_email']; ?>" readonly>
							<span id="f_email" class="text-danger"></span>
							<small id="#msg"></small>
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn greencolor mr-2" name="update_form">Update</button>
					<button class="btn redcolor" type="button">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="/js/update_user.js"></script>
<?php
include 'nav_bottom.php';
?>