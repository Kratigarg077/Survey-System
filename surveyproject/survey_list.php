<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';
include 'nav.php';
$todaydate = date("Y-m-d");
$survey = new survey;

if (isset($_POST['save']) && !empty($_POST['filter'])) {
	// if (!empty($_POST['filter'])) {
	$selected = $_POST['filter'];
	if ($_SESSION['role'] == 'User') {
		$data = $survey->filterSurvey_data($selected, $_SESSION['id']);
	} else if ($_SESSION['role'] == 'Admin') {
		$data = $survey->filterSurvey_data($selected);
	}
} else {
	if ($_SESSION['role'] == 'User') {
		$data = $survey->getDatabasedonUser($_SESSION['id']);
	} else if ($_SESSION['role'] == 'Admin') {
		$data = $survey->getDatabasedonUser();
	}
}
?>
<link rel="stylesheet" href="/css/switch.css">
<link rel="stylesheet" href="/css/modal.css">
<link rel="stylesheet" href="/css/button.css">
<style>
	#msg4 {
		display: none;
	}
</style>
<div class="col-lg-12">
	<?php
	if (@$_SESSION['new_survey'] == 1) {
	?>
		<div id="msg" class="alert alert-success" role="alert" style="text-align:center;">
			Survey Created Successfully!!
		</div>
	<?php
		$_SESSION['new_survey'] = 0;
	}
	if (@$_SESSION['update_survey'] == 1) {
	?>
		<div id="msg1" class="alert alert-success" role="alert" style="text-align:center;">
			Survey Updated Successfully!!
		</div>
	<?php
		$_SESSION['update_survey'] = 0;
	}
	if (@$_SESSION['delete_survey'] == 1) {
	?>
		<div id="msg2" class="alert alert-danger" role="alert" style="text-align:center;">
			Survey Deleted Successfully!!
		</div>
	<?php
		$_SESSION['delete_survey'] = 0;
	}
	if (@$_SESSION['expire_survey'] == 1) {
	?>
		<div id="msg3" class="alert alert-danger" role="alert" style="text-align:center;">
			Survey Expired Successfully!!
		</div>
	<?php
		$_SESSION['expire_survey'] = 0;
	}
	?>
	<div id="msg4" class="alert alert-success" role="alert" style="text-align:center;">
	</div>
	<div class="card card-outline card-primary bgcolor" style="margin: auto;">
		<div class="card-header bgcolor" style="margin-bottom: 30px;">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat ylwcolor" href="newsurvey.php"><b><i class="bx bx-plus"></i> Add New Survey</b></a>
			</div>
		</div>
		<div class="card-body">
			<!-- <div class="container"> -->
			<form action="" id="filterForm" method="post">
				<div class="col-md-5 mb-2" style="float:right;">

					<div class="input-group">
						<select id="listsearch" name="filter" class="form-control selecttype" style="width:80px; height:3em;">
							<option value="0" disabled="" selected="" class="selectdown">Select Filter</option>
							<option value="ACTIVE" <?php echo (isset($_POST['filter']) && $_POST['filter'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
							<option value="INACTIVE" <?php echo (isset($_POST['filter']) && $_POST['filter'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
							<option value="EXPIRED" <?php echo (isset($_POST['filter']) && $_POST['filter'] == 'EXPIRED') ? 'selected' : ''; ?>>Expired</option>
						</select>
						<button type="submit" class="btn mr-2 ml-2 greencolor" id="saveBtn" name="save">Save</button>
						<button class="btn bluecolor" value="reset" id="reset" type="submit">Reset</button>
					</div>

				</div>
			</form>
			<!-- </div> -->
			<!--Container Ends Here-->
			<table id="dt" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
				<thead class="tablehead">
					<tr>
						<th class="text-center">#</th>
						<th class="th-sm">Title

						</th>
						<th class="th-sm">Description

						</th>
						<th class="th-sm">Start

						</th>
						<th class="th-sm">End

						</th>
						<th class="th-sm">Total Questions

						</th>
						<th class="th-sm">Status

						</th>
						<th class="th-sm">Action

						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					if (!empty($data)) {
						foreach ($data as $row) {
							$qry = $survey->surveyIdInAnswer($row['survey_id']);
							$arr = mysqli_fetch_array($qry);
							$qry1 = $survey->surveyIdInInvitation($row['survey_id']);
							$arr1 = mysqli_fetch_array($qry1);
							$count= $survey->quesCount($row['survey_id']);
					?>
							<tr>
								<th class="text-center labelcolor <?php if ($row['survey_status'] == 'EXPIRED') echo "faded" ?>"><?php echo $i++ ?></th>
								<td class="labelcolor <?php if ($row['survey_status'] == 'EXPIRED') echo "faded" ?>"><?php echo ucwords($row['survey_title']) ?></td>
								<td class="labelcolor <?php if ($row['survey_status'] == 'EXPIRED') echo "faded" ?>"><?php echo $row['survey_description'] ?></td>
								<td class="labelcolor <?php if ($row['survey_status'] == 'EXPIRED') echo "faded" ?>"><?php echo date("M d, Y", strtotime($row['survey_start_date'])) ?></td>
								<?php if ($row['survey_end_date'] == '0000-00-00') { ?>
									<td><b><?php echo "No Expiry Date" ?></td>
								<?php } else { ?>
									<td class="labelcolor <?php if ($row['survey_status'] == 'EXPIRED') echo "faded" ?>"><?php echo date("M d, Y", strtotime($row['survey_end_date'])) ?></td>
								<?php
								} ?>
								<td class="labelcolor <?php if ($row['survey_status'] == 'EXPIRED') echo "faded" ?>"><?php echo $count; ?></td>
								<td class="labelcolor <?php if ($row['survey_status'] == 'EXPIRED') echo "faded" ?>">
									<?php
									if (($row['survey_status']) == "EXPIRED") {
										echo "Expired";
									} else {
									?>
										<div class="material-switch ">
											<input id="<?php echo $row['survey_id']; ?>" name="check" type="checkbox" value="<?= $row['survey_status'] ?>" <?php if ($row['survey_status'] == 'ACTIVE') {
																																								echo "checked";
																																							}
																																							?> />
											<label for="<?php echo $row['survey_id']; ?>" class="label-primary" id="toggle-event"></label>
										</div>
									<?php
									}
									?>
								</td>
								<td class="text-center <?php if ($row['survey_status'] == 'EXPIRED') echo "faded1" ?>">
									<button type="button" class="btn btn-default btn-sm btn-flat wave-effect text-info dropdown-toggle btncolor" data-toggle="dropdown" aria-expanded="true">
										Action
									</button>
									<div class="dropdown-menu" style="background-color: #e3e1e1; border-radius:12px;">
										<a class="dropdown-item view_user" href="viewsurvey.php?survey_id=<?php echo $row['survey_id']; ?>">View</a>
										<?php if (($row['survey_status']) != "EXPIRED" && (@$arr['Survey_Id']) != $row['survey_id']) {
										?>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="update_survey.php?survey_id=<?php echo $row['survey_id']; ?>">Edit</a>
										<?php }  ?>
										<?php if (($row['survey_status']) == "ACTIVE") { ?>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item invite" href="invitation.php?survey_id=<?php echo $row['survey_id']; ?>">Invite</a>
										<?php
										} else if (($row['survey_status']) == "INACTIVE" || ((($row['survey_status']) == "EXPIRED") && (@$arr1['Survey_Id']) != $row['survey_id'])) { ?>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item delete-confirm" href="deletesurvey.php?survey_id=<?php echo $row['survey_id']; ?>" data-toggle="modal" data-target="#deleteModal">Delete</a>
										<?php
										}
										?>
										<?php if (($row['survey_status']) != "EXPIRED") { ?>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item expire-confirm" href="expiresurvey.php?survey_id=<?php echo $row['survey_id']; ?>" data-toggle="modal" data-target="#expireModal">Expire</a>
										<?php } ?>

									</div>
								<?php
							} ?>
								</td>
							</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>#
						</th>
						<th>Title
						</th>
						<th>Description
						</th>
						<th>Start
						</th>
						<th>End
						</th>
						<th>Total Questions
						</th>
						<th>Status
						</th>
						<th>Action
						</th>
					</tr>
				</tfoot>
			<?php } else { ?>
				<tr>
					<td colspan=7>
						<p style="font-weight: bold; margin-left: 50vh;">No Survey Created!!</p>
					</td>
				</tr>
			<?php
					};
			?>
			</table>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-confirm" role="document">
			<div class="modal-content">
				<div class="modal-header flex-column">
					<h4 class="modal-title" id="exampleModalLabel">Are you sure?</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Do you really want to delete the survey? This process cannot be undone.
				</div>
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn bluecolor" data-dismiss="modal" style="font-size:small;">Cancel</button>
					<a class="delete-yes" href=""><button type="button" class="btn btn-danger" style="font-size:small;  background-color: #b43d3d !important; color: white; width: 8vh; height: 4vh; border:none; border-radius:5px;">Delete</button></a>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="expireModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-confirm" role="document">
			<div class="modal-content">
				<div class="modal-header flex-column">
					<h4 class="modal-title" id="exampleModalLabel">Are you sure?</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Do you really want to expire the survey? This process cannot be undone.
				</div>
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn bluecolor" data-dismiss="modal" style="font-size:small;">Cancel</button>
					<a class="expire-yes" href="expiresurvey.php"><button type="button" class="btn btn-danger" style="font-size:small;  background-color: #b43d3d !important; color: white; width: 8vh; height: 4vh; border:none; border-radius:5px;">Expire</button></a>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#dt').DataTable();
		});

		$("#reset").on("click", function() {
			$("#listsearch").val('all');
		});

		$('.delete-confirm').click(function() {
			$('#deleteModal').modal('show');
			var deleteUrl = $(this).attr('href');
			$(".delete-yes").attr('href', deleteUrl);
			return false;
		});
		$('.expire-confirm').click(function() {
			$('#expireModal').modal('show');
			var expireUrl = $(this).attr('href');
			$(".expire-yes").attr('href', expireUrl);
			return false;
		});

		$('input[name=check]').click(function() {
			var id = $(this).attr('id');
			var status = $(this).val();
			if (status == 'ACTIVE') {
				status = 'INACTIVE';
			} else {
				status = 'ACTIVE';
			}
			$.ajax({
				url: "updatestatus",
				type: "POST",
				data: {
					status: status,
					id: id
				},

				success: function(data) {
					// $('#msg4').hide().fadeIn(500, function() {
					// 	$("#msg4");
					// }).fadeOut(3000);
					$('#msg4').html("Status Changed Successfully!!").fadeIn('slow') //also show a success message 
					$('#msg4').delay(1000).fadeOut('slow');
					setTimeout(function() {
						window.location.reload(1);
					}, 2000);
				},
				error: function() {
					alert("error");
				}
			});
		});

		setTimeout(() => {
			$('#msg').css('display', 'none');
		}, 3500);

		setTimeout(() => {
			$('#msg1').css('display', 'none');
		}, 3500);
		setTimeout(() => {
			$('#msg2').css('display', 'none');
		}, 3500);
		setTimeout(() => {
			$('#msg3').css('display', 'none');
		}, 3500);
	</script>
	<?php
	include 'nav_bottom.php';
	?>