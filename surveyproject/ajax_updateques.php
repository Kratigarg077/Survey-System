<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';

$survey = new survey;
$details= $_REQUEST;
$qid= $details['question_id']; 
@$options_id= explode(',', $details['options_id']);
// var_dump($options_id); die;
$question = $_REQUEST['newques'];
$type= $_REQUEST['type1'];
$comp = isset($_REQUEST['comp']) ? "Yes" : "No";
$query = $survey->questionUpdate($question, $type, $comp, $qid, $options_id);

if($query){
    $result= ['status'=> "success" , "message"=> "Question Updated successfully !"];
    }else{
        $result = ['status'=>'failed'];
    }
    echo json_encode($result);
?>