<?php

include 'config/connection.php';
include 'controllers/surveycontroller.php';
session_start();
$survey = new survey;
$id = $_GET['survey_id'];
$qry = $survey->delete($id);
?>