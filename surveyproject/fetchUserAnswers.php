<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';

$survey = new survey;
$sid = $_REQUEST['survey_id'];
$email = $_REQUEST['email'];

$result = $survey->generateReport($sid, $email);
echo json_encode($result);
?>