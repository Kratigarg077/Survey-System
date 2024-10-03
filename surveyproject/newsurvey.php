<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';
include 'nav.php';

$survey = new survey;
if (!empty($_POST)) {
	extract($_POST);
	if ($title) {
		$query = $survey->check_title($title);
		if ($query) {
			$result = $survey->create_survey($_SESSION['id'], $title, $description, $start_date, $end_date);
		}
	}
}
?>
<link rel="stylesheet" href="/css/loader.css">
<link rel="stylesheet" href="/css/newsurvey.css">
<div class="heading">
	<h1 style="text-align:center">Add New Survey</h1>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body bgcolor">
			<?php if (@$_SESSION['titleflag'] == 1) {
			?>
				<div id="msg" class="alert alert-warning" role="alert" style="margin-top:10px;">
					Title Already Exists !!
				</div>
			<?php
				$_SESSION['titleflag'] = 0;
			}
			?>
			<form action="" id="manage_survey" style="margin-top:30px;" method="post" onsubmit="return saveForm();">
				<div id="overlay">
					<div class="w-100 d-flex justify-content-center align-items-center">
						<div class="spinner"></div>
					</div>
				</div>
				<!-- <input type="hidden" name="status"> -->
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">Title</label>
							<span class="requiredques">*</span>
							<input type="text" name="title" value="<?php echo isset($_POST["title"]) ? $_POST["title"] : ''; ?>" id="title" class="form-control form-control-sm fsize">
							<span id="f_title" class="text-danger"></span>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Start</label>
							<span class="requiredques">*</span>
							<input type="date" name="start_date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo isset($_POST["start_date"]) ? $_POST["start_date"] : ''; ?>" id="start_date" class="form-control form-control-sm fsize">
							<span id="f_start_date" class="text-danger"></span>
						</div>
						<div class="form-group">
							<label for="" class="control-label">End</label>
							<input type="date" name="end_date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo isset($_POST["end_date"]) ? $_POST["end_date"] : ''; ?>" id="end_date" class="form-control form-control-sm fsize">
							<span style="font-size:medium; color:#6e6e6e;">If end date is not selected, survey will not expire!</span><br>
							<span id="f_end_date" class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Description</label>
							<span class="requiredques">*</span>
							<textarea name="description" id="description" cols="30" rows="4" class="form-control fsize "><?php echo isset($_POST["description"]) ? $_POST["description"] : ''; ?></textarea>
							<span id="f_description" class="text-danger"></span>
						</div>
					</div>
				</div>
				<br>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex" style="margin-top:3vh;">
					<button type="submit" class="btn greencolor mr-2" name="create">Save</button>
					<button class="btn redcolor" type="button" onclick="location.href = 'survey_list.php'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- <script>
var today = new Date();
today.setHours(0,0,0,0);
alert(today);

var fullDate = [today.getDate()+"/"+(today.getMonth()+1)+"/"+today.getFullYear()];
if(start_date.value > fullDate){
alert('Date is bigger than today');
}
</script> -->

<script src="/js/newsurvey.js"></script>
<script>
	setTimeout(() => {
			$('#msg').css('display', 'none');
		}, 3500);
</script>
<?php
include 'nav_bottom.php';
?>