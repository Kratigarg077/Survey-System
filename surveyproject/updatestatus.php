<?php

include 'config/connection.php';
include 'controllers/surveycontroller.php';

$survey = new survey;
 $id= $_POST['id'];
 $status= $_POST['status']; 

$qry = $survey->updateStatus($id,$status);
// print_r($qry); die;
?>