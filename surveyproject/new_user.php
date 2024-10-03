<?php
include 'config/connection.php';
include 'controllers/usercontroller.php';
include 'nav.php';

$user = new user;

if (!empty($_POST)) {
	extract($_POST);
	if ($email) {
		$query = $user->check_email($email);
		// print($query); die;
		if ($query) {
			$result = $user->create_user($_SESSION['id'], $name, $gender, $email, $contact, $role);
		}
	}
}	
?>
<link rel="stylesheet" href="/css/loader.css">
<div class="heading">
	<h1 style="text-align:center; margin-top:50px;"> New User</h1>
</div>
<div class="col-lg-12">
	<div class="card" style="width: 800px; margin: 30px auto;">
		<div class="card-body bgcolor">
			<?php if (@$_SESSION['emailflag'] == 1) {
			?>
				<div id="msg" class="alert alert-warning" role="alert" style="margin-top:10px;">
					Email Already Exists !!
				</div>
			<?php
				$_SESSION['emailflag'] = 0;
			}
			?>
			<form action="" id="user_profile" style="margin-top:20px;" method="post" onsubmit="return saveForm();">
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
							<label for="" class="control-label"> Name</label>
							<span class="requiredques">*</span>
							<input type="text" name="name" id="firstname"  value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>" class="form-control form-control-sm fsize" value="<?php echo isset($firstname) ? $firstname : '' ?>">
							<span id="f_firstname" class="text-danger"></span>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Contact No.</label>
							<span class="requiredques">*</span>
							<input type="text"name="contact" id="contact" class="form-control form-control-sm fsize" value="<?php echo isset($contact) ? $contact : '' ?>">
							<span id="f_contact" class="text-danger"></span>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Gender</label>
							<span class="requiredques">*</span>
							<select name="gender" id="gender" class="custom-select custom-select-sm" style="height: fit-content;">
								<option value="" disabled="" selected="">Please Select here</option>
								<option value="Male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
								<option value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
							</select>
							<span id="f_gender" class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-6">
						<b class="text-muted">System Credentials</b>
				
						<div class="form-group">
							<label for="" class="control-label">User Role</label>
							<span class="requiredques">*</span>
							<select name="role" id="role" class="custom-select custom-select-sm" style="height: fit-content;">
								<option value="" disabled="" selected="">Please Select here</option>
								<option value="User" <?php echo (isset($_POST['role']) && $_POST['role'] == 'User') ? 'selected' : ''; ?>>User</option>
								<option value="Admin" <?php echo (isset($_POST['role']) && $_POST['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
								<option value="Management" <?php echo (isset($_POST['role']) && $_POST['role'] == 'Management') ? 'selected' : ''; ?>>Management</option>
							</select>
							<span id="f_role" class="text-danger"></span>
						</div>

						<div class="form-group">
							<label class="control-label">Email</label>
							<span class="requiredques">*</span>
							<input type="text" class="form-control form-control-sm fsize" name="email" id="email" value="<?php echo isset($email) ? $email : '' ?>">
							<span id="f_email" class="text-danger"></span>
							<small id="#msg"></small>
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
				<button type="submit" class="btn mr-2 greencolor" id="saveBtn" name="save">Save</button>
				<button class="btn redcolor" type="button" onclick="location.href = 'user_list.php'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="/js/newuser.js"></script>
<script>
	setTimeout(() => {
		$('#msg').css('display', 'none');
	}, 3500);

</script>
<?php
include_once 'nav_bottom.php';
?>