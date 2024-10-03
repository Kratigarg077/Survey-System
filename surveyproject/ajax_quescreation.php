<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';

$survey = new survey;
$question = $_REQUEST['question'];
$type = $_REQUEST['type'];
$survey_id= $_REQUEST['survey_id'];
$comp = isset($_REQUEST['comp']) ? "Yes" : "No";
if ($type == "radio_comment" || $type == "mcq_comment" || $type == "mcq" || $type == "radio") {
    $des = $_POST['add'][$type];
    $des = array_filter($des);
    $query1 = $survey->addQuestion($survey_id,$question, $type, $comp, $des);
    if($query1){
        $result= ['status'=> "success" , "message"=> "Question Created successfully !"];
        }else{
            $result = ['status'=>'failed'];
        }
        echo json_encode($result);
} else {
    $query2 = $survey->addQuestion($survey_id,$question, $type, $comp);
    if($query2){
    $result= ['status'=> "success" , "message"=> "Question Created successfully !"];
    }else{
        $result = ['status'=>'failed'];
    }
    echo json_encode($result);
    // echo "exec";
    // print_r ($query2['status']);
    // if($query2['status'] == "success"){
    //     $_SESSION['add_question_success'] = $query2['message'];
    // }
    // echo $_SESSION['add_question_success'];
}
?>