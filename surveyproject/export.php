<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';
session_start();

$hid = $_REQUEST['survey_id'];
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
$survey = new survey;
if (!empty($email)) {
    $result = $survey->downloadReprt($hid, $email);
} else {
    $result = $survey->downloadReprt($hid);
}
?>