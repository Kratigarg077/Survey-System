<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';

$survey = new survey;
$status= $_POST['status']; 
$id= $_POST['id'];

$qry = $survey->updateStatusQues($id,$status);
// print_r($qry); die;
?>