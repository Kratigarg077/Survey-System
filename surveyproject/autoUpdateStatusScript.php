<?php

include 'config/connection.php';
include 'controllers/surveycontroller.php';

$survey = new survey;
$survey->updateStatusAuto();
exit();
?>