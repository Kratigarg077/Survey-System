<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';
include 'nav.php';

$sid = $_GET['survey_id'];
$survey = new survey;

//fetch survey data
$qry = $survey->fetchSurvey_data($sid);
$row = mysqli_fetch_array($qry);
//  print_r($row); die;

if (isset($_POST['update_form'])) {
	extract($_POST);

	$query = $survey->update($_SESSION['id'],$sid, $title, $description, $start_date, $end_date);
}
?>
<div class="heading">
	<h1 style="text-align:center">Update Survey</h1>
</div>
<div class="col-lg-12">
	<div class="card" style="width: 800px; margin: 30px auto;">
		<div class="card-body bgcolor">
			<form action="" id="manage_survey" style="margin-top:30px;" method="post" onsubmit="return validateForm();">
				<input type="hidden" name="id">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">Title</label>
							<span class="requiredques">*</span>
							<input type="text" style="font-size:14px;" name="title" id="title" class="form-control form-control-sm" value="<?php echo $row['survey_title']; ?>">
							<span id="f_title" class="text-danger"></span>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Start</label>
							<span class="requiredques">*</span>
							<input type="date" style="font-size:14px;" name="start_date" id="start_date" min="<?php echo date("Y-m-d"); ?>" class="form-control form-control-sm" value="<?php echo $row['survey_start_date']; ?>">
							<span id="f_start_date" class="text-danger"></span>
						</div>
						<div class="form-group">
							<label for="" class="control-label">End</label>
							<input type="date" style="font-size:14px;" name="end_date" id="end_date" min="<?php echo date("Y-m-d"); ?>" class="form-control form-control-sm" value="<?php echo $row['survey_end_date']; ?>">
							<span style="font-size:medium; color:#6e6e6e;">If end date is not selected, survey will not expire!</span><br>
							<span id="f_end_date" class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Description</label>
							<span class="requiredques">*</span>
							<textarea name="description" style="font-size:14px;" id="description" cols="30" rows="4" class="form-control"><?php echo $row['survey_description']; ?></textarea>
							<span id="f_description" class="text-danger"></span>
						</div>
					</div>
				</div>
				<br>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex mt-5">
					<button class="btn greencolor mr-2" name="update_form" type="submit">Update</button>
					<button class="btn redcolor" type="button" onclick="location.href = 'survey_list.php'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="/js/newsurvey.js"></script>
<?php
include 'nav_bottom.php';
?>