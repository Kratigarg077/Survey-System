<?php
include 'config/connection.php';
include 'controllers/usercontroller.php';
include 'controllers/surveycontroller.php';

call_user_func($_GET['f']);

function ajax_updateques(){
    
    // $a = "Test Hi";
    // echo json_encode([ 'message' => $a]);
$survey = new survey;
$details= $_REQUEST;
$qid= $details['question_id']; 
// $options_id= $details['options_id']; 
@$options_id= explode(',', $details['options_id']);
// var_dump($options_id); die;
$question = $_REQUEST['newques'];
$type= $_REQUEST['type1'];
$comp = isset($_REQUEST['comp']) ? "Yes" : "No";
// echo $comp;
if(@$type == 'radio' || @$type == 'radio_comment' || @$type == 'mcq_comment' || @$type == 'mcq'){
    $des = $_REQUEST['add'][$type];
}
else{
$des = $_REQUEST['add'];
}
$des = array_filter($des);
$query = $survey->questionUpdate($question, $type, $comp, $des, $qid, $options_id);
echo $query; die;

}
