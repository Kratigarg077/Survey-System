<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';
include 'nav.php';

$hid = $_GET['survey_id'];
$survey = new survey;

//fetch survey data
$qry = $survey->fetchSurvey_data($hid);
$row = mysqli_fetch_array($qry);
$taken = $survey->taken_count($hid);
?>
<style>
	#msg2 {
		display: none;
	}

	#msg3 {
		display: none;
	}
</style>
<link rel="stylesheet" href="/css/switch.css">
<link rel="stylesheet" href="/css/rating.css">
<link rel="stylesheet" href="/css/modal.css">
<div class="col-lg-12">
	<div id="msg3" class="alert alert-success" role="alert" style="width:66%; margin-left:34%; text-align:center;">
	</div>
	<div class="row">
		<div class="col-md-4 ">
			<div class="card card-outline " style="border-top:4px solid #585656;">
				<div class="card-header bgcolor">
					<h3 class="card-title cardcolor"><b>Survey Details</b>
						<?php if ($row['survey_status'] == 'ACTIVE') { ?>
							<!-- <div class="col-md-4" style="margin-left:85%;"> -->
							<a href="invitation.php?survey_id=<?php echo $hid; ?>" class="da" style="margin-left:55%;"><i
									class='bx bx-share-alt' style="font-size:1.25em;" title="Invite"></i></a>
							<a href="survey_form.php?survey_id=<?php echo $hid; ?>" class="da"><i
									class='bx bx-show card-title' style="font-size:1.35em;"
									title="View Survey Form"></i></a>
							<!-- </div> -->
						<?php } else if ($row['survey_status'] == 'INACTIVE') { ?>
								<a href="survey_form.php?survey_id=<?php echo $hid; ?>" class="da" style="margin-left:70%;"><i
										class='bx bx-show card-title' style="text-shadow: 0 0 3px #28789f;"
										title="View Survey Form"></i></a>
						<?php }
						?>
					</h3>
				</div>
				<div class="card-body p-0 py-2 bgcolor">
					<div class="container-fluid">
						<p class="labelcolor"><b>Title: </b><?php echo $row['survey_title']; ?></p>
						<small>
							<p class="labelcolor"><b>Description:</b>
								<?php echo $row['survey_description']; ?>
							</p>
						</small>
						<p class="labelcolor"><b>Start:</b> <?php echo $row['survey_start_date']; ?> </p>
						<p class="labelcolor"><b>End:</b>
							<?php echo $row['survey_end_date']; ?>
						</p>
						<p class="labelcolor"><b>Have Taken:</b>
							<?php echo $taken; ?>
						</p>
					</div>
					<hr>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-outline card-success" style="border-top:4px solid #585656;">
				<div class="card-header bgcolor">
					<div class="row">
						<div class="col-11">
							<?php
							if (@$_SESSION['delete_question'] == 1) {
								?>
								<div id="msg1" class="alert alert-danger" role="alert"
									style="width:110%; text-align:center;">
									Question Deleted Successfully!!
								</div>
								<?php
								$_SESSION['delete_question'] = 0;
							}
							?>
							<div id="msg2" class="alert alert-success" role="alert"
								style=" width:110%; text-align:center;">
								Question Created Successfully..
							</div>
							<h3 class="card-title cardcolor" style="margin-bottom:20px;"><b>Survey Questionaire</b></h3>
						</div>
					</div>
					<div class="card-tools">
						<?php
						if ($row['survey_status'] == 'ACTIVE' || $row['survey_status'] == 'INACTIVE') {
							?>
							<button type="button" class="btn btn-block btn-sm btn-default btn-flat new_question ylwcolor"
								style="height:30px; margin-bottom:20px;" data-toggle="modal" data-target="#myModal">
								<i class="bx bx-plus"></i> Add New Question</button>

						<?php } ?>
						<?php
						$data8 = $survey->displayQuestion($hid);
						// echo "<pre>";
						// print_r($data8);
						// echo "</pre>";
						foreach ((array) @$data8 as $ques => $option) {
							foreach ($option as $k => $v) {
								// $status=  $v['quesStatus'];
								$compulsory = $v['iscompulsory'];
							} ?>
							<div style="border:2px solid #666; padding:10px; border-radius:10px;"
								class="newClass <?php if ($v['quesStatus'] == 'Inactive')
									echo "faded" ?>">
									<span class='labelcolor'><b> Question: <?php if ($compulsory == "Yes") { ?>
											<span class="requiredques">*</span>
										<?php } ?>
									</b></span><span class='labelcolor'><?php echo $ques ?></span><br><br>
								<?php $len = count($option); ?>
								<?php
								$j = 0;
								foreach ($option as $key => $val) {
									$j++;
									if ($val['type'] == 'mcq') { ?>
										<div class="input_check"><input type="checkbox"> &nbsp;<span class="optdata">
												<?php echo $val['options']; ?>
											</span></div>
									<?php } elseif ($val['type'] == 'mcq_comment') { ?>
										<div class="input_check"><input type="checkbox"> &nbsp;<span class="optdata labelcolor">
												<?php echo $val['options']; ?>
											</span></div>
										<?php if ($j == $len) { ?>
											<div class="input-group mb-3" style="width:29vh;">
												<div class="input-group-prepend"><span class="input-group-text">Comment</span></div>
												<textarea class="form-control" aria-label="With textarea" rows="4" cols="50"
													placeholder="Enter reason here!!"></textarea>
											</div>
										<?php }
									} elseif ($val['type'] == 'radio') { ?>
										<div class="input_check"><input type="radio" name="radio1"> &nbsp;<span class="optdata">
												<?php echo $val['options']; ?></span></div>
									<?php } elseif ($val['type'] == 'radio_comment') { ?>
										<div class="input_check"><input type="radio" name="radio1"> &nbsp; <span
												class="optdata labelcolor">
												<?php echo $val['options']; ?>
											</span></div>
										<?php if ($j == $len) { ?>
											<div class="input-group mb-3" style="width:29vh;">
												<div class="input-group-prepend"><span class="input-group-text">Comment</span></div>
												<textarea class="form-control" aria-label="With textarea" rows="4" cols="50"
													placeholder="Enter reason here!!"></textarea>
											</div>
										<?php }
									}
								}
								if ($val['type'] == 'text') { ?>
									<div class="mb-3" style="width:29vh;"><textarea class="form-control"
											aria-label="With textarea" rows="4" cols="5" style="font-size:14px;"></textarea>
									</div><br>
								<?php } elseif ($val['type'] == 'email') { ?>
									<div class="input-group mb-3" style="width:29vh;">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="bx bx-at"><label type="email"
														aria-label="Email for following text input" name="email" disabled></i>
											</div>
										</div>
										<input type="email" name="add[]" class="form-control" aria-label="Text input with email"
											disabled>
									</div><br>
								<?php } elseif ($val['type'] == 'one_word') { ?>
									<div class="input-group mb-3" style="width: 29vh">
										<div class="input-group-prepend"><span class="input-group-text">Single Word</span></div>
										<input class="form-control input-sm" id="inputsm" type="text">
									</div><br>
								<?php } elseif ($val['type'] == 'file') { ?>
									<div class="mb-3" style="width:29vh">
										<label for="formFile" class="form-label optdata">Upload file</label>
										<input class="form-control form-control-lg" type="file" id="formFile">
									</div><br>
								<?php } elseif ($val['type'] == 'date') { ?>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Date/Time:</span>
										</div>
										<input type="datetime-local" style="width: 29vh;" id="datetime" name="datetime">
									</div>
								<?php } elseif ($val['type'] == 'rating') { ?>
									<label style="margin-left:30%; color:#805417;">Star Rating (Choose between 1 to 5 star):</label>
									<div class="rating" id="rating_<?php echo $val['id']; ?>">
										<input type="radio" name="rating[<?php echo $val['id']; ?>]" value="5"
											id="5_<?php echo $val['id']; ?>"><label for="5_<?php echo $val['id']; ?>">☆</label>
										<input type="radio" name="rating[<?php echo $val['id']; ?>]" value="4"
											id="4_<?php echo $val['id']; ?>"><label for="4_<?php echo $val['id']; ?>">☆</label>
										<input type="radio" name="rating[<?php echo $val['id']; ?>]" value="3"
											id="3_<?php echo $val['id']; ?>"><label for="3_<?php echo $val['id']; ?>">☆</label>
										<input type="radio" name="rating[<?php echo $val['id']; ?>]" value="2"
											id="2_<?php echo $val['id']; ?>"><label for="2_<?php echo $val['id']; ?>">☆</label>
										<input type="radio" name="rating[<?php echo $val['id']; ?>]" value="1"
											id="1_<?php echo $val['id']; ?>"><label for="1_<?php echo $val['id']; ?>">☆</label>
									</div><br>
									<?php
								}
								?>
								<span class="dropleft float-right">
									<?php
									$arr = $survey->QuestionIdInAnser($hid, $val['id']);
									if (@$arr['question_id'] == $val['id'] && ($row['survey_status'] != 'EXPIRED') && ($val['type'] == 'radio' || $val['type'] == 'radio_comment' || $val['type'] == 'mcq' || $val['type'] == 'mcq_comment')) {
										?>

										<a
											href="update_surveyques.php?s_id=<?php echo $hid; ?>&ques_id=<?php echo $val['id']; ?>">
											<i class='bx bxs-edit' title="Edit Question"
												style="color:green; margin-right:10px;"></i></a>
										<?php
									} else if ((@$arr['question_id'] != $val['id']) && ($row['survey_status'] != 'EXPIRED')) {
										?>
											<a
												href="update_surveyques.php?s_id=<?php echo $hid; ?>&ques_id=<?php echo $val['id']; ?>">
												<i class='bx bxs-edit' title="Edit Question"
													style="color:#347243; margin-right:10px;"></i></a>
											<a href="delete_question.php?ques_id=<?php echo $val['id'] ?>" class="delete-confirm"
												data-toggle="modal" data-target="#exampleModal"><i class='bx bxs-trash'
													title="Delete Question" style="color: #b43d3d; margin-right:10px;"></i></a>
											<div class="material-switch pull-right">
												<input id="<?php echo $val['id']; ?>" value="<?= $val['quesStatus'] ?>" name="check"
													type="checkbox" <?php if ($val['quesStatus'] == 'Active') {
														echo "checked";
													}
													?> />
												<label for="<?php echo $val['id']; ?>" class="label-primary"></label>
											</div>
										<?php
									}
									?>
								</span><br>
							</div><br>
							<?php
						}
						?>

						<!-- The Modal -->
						<div class="modal fade" id="myModal">
							<div class="modal-dialog modal-lg modal-dialog-centered">
								<div class="modal-content bgcolor">
									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title"></h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>

									<!-- Modal body -->
									<form id="myform" method="post">
										<div class="modal-body bgcolor">
											<div class="container-fluid">
												<div class="col-lg-12">
													<div class="row">
														<input type="hidden" value="<?php echo $hid ?>"
															name="survey_id">
														<div class="col-sm-6 border-right">
															<div class="form-group">
																<label for=""
																	class="control-label labelcolor">Question</label>
																<span class="requiredques">*</span>
																<textarea name="question" id="question" cols="40"
																	rows="8" class="form-control fsize"></textarea>
																<span id="f_question" class="text-danger"></span>
															</div>
															<div class="form-group">
																<label for="" class="control-label labelcolor">Question
																	Answer Type</label>
																<span class="requiredques">*</span>

																<select name="type" id="drop"
																	class="custom-select custom-select-sm"
																	style="height: fit-content;">
																	<option value="" disabled="" selected="">Please
																		Select here</option>
																	<option value="radio">Single Answer/Radio Button
																	</option>
																	<option value="radio_comment">Single Answer/Radio
																		Button and Comment</option>
																	<option value="mcq">Multiple Answer/Check Boxes
																	</option>
																	<option value="mcq_comment">Multiple Answer/Check
																		Boxes and Comment</option>
																	<option value="text">Descriptive</option>
																	<option value="file">File</option>
																	<option value="rating">Rating</option>
																	<option value="date">Date/Time</option>
																	<option value="one_word">Short Text</option>
																	<option value="email">E-mail</option>
																</select>
																<span id="f_type" class="text-danger"></span>
															</div>
														</div>

														<div class="col-sm-6 labelcolor">
															<b>Preview</b>
															<div class="preview">
																<div class="data1 labelcolor"
																	style="text-align:center;">
																	<b>Select Question Answer type first.</b>
																</div>
																<div class="data" id="mcq">
																	<div id="dynamic_field1">
																		<div class="input-group mb-3"
																			style="width:35vh;">
																			<div class="input-group-prepend">
																				<div class="input-group-text">
																					<input type="checkbox"
																						aria-label="Checkbox for following text input"
																						id="check1" disabled>
																				</div>
																			</div>
																			<input type="text" name="add[mcq][]"
																				class="form-control emptymcq fsize"
																				aria-label="Text input with checkbox">
																		</div>
																		<span class="text-danger"></span>
																	</div>
																	<div>
																		<button class="btn bluecolor mb-3" type="button"
																			id="add_btn1"
																			style="width:14vh !important;">Add
																			options</button>
																		<input id="comp1" type="checkbox"
																			class="comp-border" name="comp">
																		<label for="comp1"
																			class="checkbox-inline">Question
																			Compulsory</label>
																	</div>
																</div>

																<div class="data" id="mcq_comment">
																	<div id="dynamic_field2">
																		<div class="input-group mb-3"
																			style="width:35vh;">
																			<div class="input-group-prepend">
																				<div class="input-group-text">
																					<input type="checkbox"
																						aria-label="Checkbox for following text input"
																						disabled>
																				</div>
																			</div>
																			<input type="text" name="add[mcq_comment][]"
																				class="form-control emptymcq_comment fsize"
																				aria-label="Text input with checkbox">
																		</div>
																		<span class="text-danger"></span>
																	</div>
																	<div>
																		<button class="btn bluecolor mb-3" type="button"
																			id="add_btn2"
																			style="width:14vh !important;">Add
																			options</button>
																		<input id="comp2" type="checkbox"
																			class="comp-border" name="comp">
																		<label for="comp2"
																			class="checkbox-inline">Question
																			Compulsory</label>
																	</div>
																	<div class="input-group mb-3" style="width:35vh;">
																		<div class="input-group-prepend">
																			<span
																				class="input-group-text">Comment</span>
																		</div>
																		<textarea class="form-control"
																			aria-label="With textarea" rows="4"
																			cols="50" readonly></textarea>
																	</div>
																</div>

																<div class="data" id="radio">
																	<div id="dynamic_field3">
																		<div class="input-group mb-3"
																			style="width:35vh;">
																			<div class="input-group-prepend">
																				<div class="input-group-text">
																					<input type="radio"
																						aria-label="Radio button for following text input"
																						name="radio" disabled>
																				</div>
																			</div>
																			<input type="text" name="add[radio][]"
																				class="form-control emptyradio fsize"
																				aria-label="Text input with radio button">
																		</div>
																		<span class="text-danger"></span>
																	</div>
																	<div>
																		<button class="btn bluecolor mb-3" type="button"
																			id="add_btn3"
																			style="width:14vh !important;">Add
																			options</button>
																		<input id="comp3" type="checkbox"
																			class="comp-border" name="comp">
																		<label for="comp3"
																			class="checkbox-inline">Question
																			Compulsory</label>
																	</div>
																</div>

																<div class="data" id="radio_comment">
																	<div id="dynamic_field4">
																		<div class="input-group mb-3"
																			style="width:35vh;">
																			<div class="input-group-prepend">
																				<div class="input-group-text">
																					<input type="radio"
																						aria-label="Radio button for following text input"
																						name="radio" disabled>
																				</div>
																			</div>
																			<input type="text"
																				name="add[radio_comment][]"
																				class="form-control emptyradio_comment fsize"
																				aria-label="Text input with radio button">
																		</div>
																		<span class="text-danger"></span>
																	</div>
																	<div>
																		<button class="btn bluecolor mb-3" type="button"
																			id="add_btn4"
																			style="width:14vh !important;">Add
																			options</button>
																		<input id="comp4" type="checkbox"
																			class="comp-border" name="comp">
																		<label for="comp4"
																			class="checkbox-inline">Question
																			Compulsory</label>
																	</div>

																	<div class="input-group mb-3" style="width:35vh;">
																		<div class="input-group-prepend">
																			<span
																				class="input-group-text">Comment</span>
																		</div>
																		<textarea class="form-control"
																			aria-label="With textarea" rows="4"
																			cols="50" readonly></textarea>
																	</div>
																</div>


																<div class="data" id="text">
																	<div class="input-group mb-3" style="width:35vh;">
																		<div class="input-group-prepend">
																			<span
																				class="input-group-text">Descriptive</span>
																		</div>
																		<textarea class="form-control"
																			aria-label="With textarea" rows="8"
																			cols="50" disabled></textarea>
																	</div>
																	<input id="comp5" type="checkbox"
																		class="comp-border" name="comp">
																	<label for="comp5" class="checkbox-inline">Question
																		Compulsory</label>
																</div>

																<div class="data" id="one_word">
																	<div class="input-group mb-3" style="width:35vh;">
																		<div class="input-group-prepend">
																			<span class="input-group-text">Single
																				Word</span>
																		</div>
																		<input class="form-control input-sm"
																			id="inputsm" type="text" disabled>
																	</div>
																	<input id="comp6" type="checkbox"
																		class="comp-border" name="comp">
																	<label for="comp6" class="checkbox-inline">Question
																		Compulsory</label>
																</div>

																<div class="data" id="date">
																	<div class="input-group mb-3">
																		<div class="input-group-prepend">
																			<span class="input-group-text">Date and
																				Time:</span>
																		</div>
																		<input type="datetime-local" id="datetime"
																			name="datetime" style="width:35vh;"
																			disabled>
																	</div>
																	<input id="comp7" type="checkbox"
																		class="comp-border" name="comp">
																	<label for="comp7" class="checkbox-inline">Question
																		Compulsory</label>
																</div>

																<div class="data" id="rating">
																	<div class="rate py-3 text-white mt-3"
																		style="background-color:#dbdddf;">
																		<label class='mt-2' style="margin-left:18%; color:black;" for='vol'>Star Rating (1 to 5 star):</label>
																		<div class="rating"> <input type="radio"
																				name="rating" value="5" id="5"
																				disabled><label for="5">☆</label> <input
																				type="radio" name="rating" value="4"
																				id="4" disabled><label for="4">☆</label>
																			<input type="radio" name="rating" value="3"
																				id="3" disabled><label for="3">☆</label>
																			<input type="radio" name="rating" value="2"
																				id="2" disabled><label for="2">☆</label>
																			<input type="radio" name="rating" value="1"
																				id="1" disabled><label for="1">☆</label>
																		</div>
																	</div>
																	<input id="comp8" type="checkbox"
																		class="comp-border" name="comp">
																	<label for="comp8" class="checkbox-inline">Question
																		Compulsory</label>
																	<!-- <div class='col-12 ms-2'>
																		<label class='mt-2' for='vol'>Rate us (between 0 and 5):</label>
																		<input type='range' id='vol' min='0' max='5' name='options[<?php echo $b['ques_id'] ?>][]' style='width:100%;height:7vh;'>
																	</div> -->
																</div>

																<div class="data" id="file">
																	<div class="mb-3" style="width:35vh;">
																		<label for="formFile" class="form-label">Upload
																			file</label>
																		<input class="form-control form-control-lg"
																			type="file" id="formFile" disabled>
																	</div>
																	<input id="comp9" type="checkbox"
																		class="comp-border" name="comp">
																	<label for="comp9" class="checkbox-inline">Question
																		Compulsory</label>
																</div>
															</div>

															<div class="data" id="email">
																<div class="input-group mb-3" style="width:35vh;">
																	<div class="input-group-prepend">
																		<div class="input-group-text">
																			<i class='bx bx-at'><label type="email"
																					aria-label="Email for following text input"
																					name="email" disabled></i>
																		</div>
																	</div>
																	<input type="email" class="form-control"
																		aria-label="Text input with email" disabled>
																</div>
																<input id="comp10" type="checkbox" class="comp-border"
																	name="comp">
																<label for="comp10" class="checkbox-inline">Question
																	Compulsory</label>
															</div>
														</div>
													</div>
												</div>
												<!-- Modal footer -->
												<div class="modal-footer">
													<button id="save" class="btn greencolor" type="submit"
														name="save-details">Save</button>
													<button type="button" class="btn redcolor"
														data-dismiss="modal">Close</button>
												</div>

											</div>
										</div>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-confirm" role="document">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<h4 class="modal-title" id="exampleModalLabel">Are you sure?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Do you really want to delete the question? This process cannot be undone.
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn bluecolor" data-dismiss="modal">Cancel</button>
				<a class="delete-yes" href="deletesurvey.php"><button type="button"
						style="font-size:small;  background-color: #b43d3d !important; color: white; width: 8vh; height: 4vh; border:none; border-radius:5px;">Delete</button></a>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
	integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
	crossorigin="anonymous"></script>
<script>
	$(document).ready(function () {
		$("#drop").change(function () {
			$(".data").hide();
			// $("#add_btn").show();
			$(".data1").hide();
			$("#" + $(this).val()).show();
		});
	});
	$('.new_question').click(function () {
		$('#myModal').modal('show');
		return false;
	});

	$('.delete-confirm').click(function () {
		$('#exampleModal').modal('show');
		var deleteUrl = $(this).attr('href');
		//  alert(deleteUrl);
		$(".delete-yes").attr('href', deleteUrl);
		return false;
	});

	$(document).ready(function () {
		var i = 1;
		$('#add_btn1').click(function () {
			i++;
			$('#dynamic_field1').append('<div class="form-row" id="row1' + i + '"><div class ="col"> <div class="input-group mb-3" style="width:305px;"><div class="input-group-prepend"><div class="input-group-text"><input type="checkbox" aria-label="Checkbox for following text input" disabled></div></div><input type="text" name="add[mcq][]" class="form-control emptymcq fsize" aria-label="Text input with checkbox"></div><span class="text-danger"></span></div> <div class="col"> <td><button type="button" name="add" class="btn btn-danger btn_remove"  style="background-color: #b43d3d" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
		});
		$(document).on('click', '.btn_remove', function () {
			var button_id = $(this).attr("id");

			$('#row1' + button_id + '').remove();
		});

		$('#add_btn2').click(function () {
			i++;
			$('#dynamic_field2').append('<div class="form-row" id="row2' + i + '"><div class ="col"> <div class="input-group mb-3" style="width:305px;"><div class="input-group-prepend"><div class="input-group-text"><input type="checkbox" aria-label="Checkbox for following text input" disabled></div></div><input type="text" name="add[mcq_comment][]" class="form-control emptymcq_comment fsize" aria-label="Text input with checkbox"></div><span class="text-danger"></span></div> <div class="col"> <td><button type="button" name="add" class="btn btn-danger btn_remove" style="background-color: #b43d3d" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
		});
		$(document).on('click', '.btn_remove', function () {
			var button_id = $(this).attr("id");

			$('#row2' + button_id + '').remove();
		});

		$('#add_btn3').click(function () {
			i++;
			$('#dynamic_field3').append('<div class="form-row" id="row3' + i + '"><div class ="col"> <div class="input-group mb-3" style="width:305px;"><div class="input-group-prepend"><div class="input-group-text"><input type="radio" aria-label="Radio button for following text input" name="radio" disabled></div></div><input type="text" name="add[radio][]" class="form-control emptyradio fsize" aria-label="Text input with radio button"></div><span class="text-danger"></span></div> <div class="col"> <button type="button" name="add" class="btn btn-danger btn_remove" style="background-color: #b43d3d" id="' + i + '"><i class="fa fa fa-trash"></i></button></div> </div>');
		});
		$(document).on('click', '.btn_remove', function () {
			var button_id = $(this).attr("id");

			$('#row3' + button_id + '').remove();
		});

		$('#add_btn4').click(function () {
			i++;
			$('#dynamic_field4').append('<div class="form-row" id="row4' + i + '"><div class ="col"> <div class="input-group mb-3" style="width:305px;"><div class="input-group-prepend"><div class="input-group-text"><input type="radio" aria-label="Radio button for following text input" name="radio" disabled></div></div><input type="text" name="add[radio_comment][]" class="form-control emptyradio_comment fsize" aria-label="Text input with radio button"></div><span class="text-danger"></span></div> <div class="col"> <td><button type="button" name="add" class="btn btn-danger btn_remove" style="background-color: #b43d3d" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
		});
		$(document).on('click', '.btn_remove', function () {
			var button_id = $(this).attr("id");

			$('#row4' + button_id + '').remove();
		});

		setTimeout(() => {
			$('#msg1').css('display', 'none');
		}, 3000);

	});

	$('input[name=check]').click(function () {
		var id = $(this).attr('id');
		var status = $(this).val();
		if (status == 'Active') {
			status = 'Inactive';
		} else {
			status = 'Active';
		}
		$.ajax({
			url: "updatestatusQues",
			type: "POST",
			data: {
				status: status,
				id: id
			},
			success: function (data) {
				$('#msg3').html("Status Changed Successfully!!").fadeIn('slow') //also show a success message 
				$('#msg3').delay(2000).fadeOut('slow');
				setTimeout(function () {
					window.location.reload(1);
				}, 2000);
			},
			error: function () {
				alert("error");
			}
		});
	});

	var form = $('#myform');
	form.submit(function (e) {
		e.preventDefault();
		var error_flag = validateForm();
		// alert(error_flag); 
		if (error_flag) {
			var data = form.serialize();
			$.ajax({
				url: "ajax_quescreation",
				type: "POST",
				data: data,
				cache: false,
				success: function (data) {
					var obj = JSON.parse(data);
					// console.log(obj);
					if (obj.status == "success") {
						$("#myModal").modal("hide");
						$("#msg2").show();
						setTimeout(function () {
							window.location.reload(1);
						}, 3000);
					} else {
						console.log('error');
					}
				},
				error: function () {
					alert("error");
				}
			});
		} else {
			return error_flag;
		}
	});
</script>
<script src="/js/newquestion.js"></script>
<?php
include 'nav_bottom.php';
?>