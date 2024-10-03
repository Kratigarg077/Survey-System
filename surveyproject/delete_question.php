<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';
session_start();
$survey = new survey;

$q_id = $_GET['ques_id'];
$qry = $survey->deletequestion($q_id);
?>
