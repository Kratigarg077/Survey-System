<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';
session_start();
$survey = new survey;

$o_id = $_GET['opt_id'];
$qry = $survey->deleteOption($o_id);
?>