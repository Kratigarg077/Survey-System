<?php
include_once('config/connection.php');

class survey
{
    // Database connection
    public function __construct()
    {
        $db = new db;
        $this->con = $db->con;
    }

    public function check_title($title)
    {
        $sql = "SELECT survey_title FROM surveyinfodata WHERE survey_title='$title'";
        $query = $this->con->query($sql);
        $res = mysqli_fetch_assoc($query);
        if ($title == isset($res['survey_title'])) {
            $_SESSION['titleflag'] = 1;
        } else {
            return $query;
        }
    }

    public function create_survey($id, $title, $description, $start_date, $end_date)
    {
        $todaydate = date("Y-m-d");

        if ($start_date == $todaydate) {
            $status = "ACTIVE";
        } else {
            $status = "INACTIVE";
        }
        $sql = "INSERT INTO `surveyinfodata` (`survey_id`, `survey_title`, `survey_description`, `survey_start_date`, `survey_end_date`, `survey_created_by`, `survey_modified_by`,`survey_modified_date`, `survey_status`) VALUES (NULL, '$title', '$description', '$start_date ', '$end_date', '$id', '$id', '$todaydate', '$status')";
        $query = $this->con->query($sql);
        $_SESSION['new_survey'] = 1;
        if ($query) {
            echo "<script>
            window.location.href='survey_list.php?success=1';
            </script>";
            return $query;
        } else {
            echo "Cannot create Survey!!";
        }
    }

    public function fetchSurvey_data($id)
    {
        $result = $this->con->query("SELECT * FROM surveyinfodata WHERE `survey_id`='$id'");
        return $result;
    }

    public function filterSurvey_data($status = null, $user_id = null)
    {
        $arr = array();
        $whereCond = '';
        if (!empty($user_id)) {
            $arr[] = "survey_created_by= $user_id";
        }
        if (!empty($status)) {
            $arr[] = "`survey_status` = '$status'";
        }
        $arr[] = "status= 'Active'";
        $whereCond = implode(" AND ", $arr);
        $qry = $this->con->query("SELECT * FROM surveyinfodata WHERE $whereCond");
        $data = $qry->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function invitation_count($id)
    {

        $qry = $this->con->query("SELECT distinct(invitation_to_email) from invitations where survey_id =$id")->num_rows;
        return $qry;
    }
    public function taken_count($id)
    {
        $qry = $this->con->query("SELECT distinct(answer_submitted_by) as taken from answers where survey_id =$id")->num_rows;
        return $qry;
    }

    public function quesCount($id){
        $qry = $this->con->query("SELECT question_id as taken from questions where survey_id =$id AND q_status!='Deleted'")->num_rows;
        return $qry;
    }

    public function getDatabasedonUser($user_id = null)
    {
        $arr = array();
        global $rowcount;
        $whereCond = '';
        $rowcount = 0;
        if (!empty($user_id)) {
            $arr[] = "survey_created_by= $user_id";
        }
        $arr[] = "status= 'Active'";
        $whereCond = implode(" AND ", $arr);
        $qry = $this->con->query("SELECT * FROM surveyinfodata WHERE $whereCond");
        $rowcount = mysqli_num_rows($qry);
        $data = $qry->fetch_all(MYSQLI_ASSOC);
        return $data;
        return $rowcount;
    }

    public function count_invitedUser($id)
    {
        $qry = $this->con->query("SELECT count(distinct(invitation_to_email)) as invited, SUM(status='submitted') as attempted FROM `invitations` WHERE survey_id = $id");
        $arr = mysqli_fetch_array($qry);
        return $arr;
    }

    public function survey_count($user_id = null)
    {
        if (!empty($user_id)) {
            $arr[] = "survey_created_by= $user_id";
        }
        $arr[] = "status= 'Active'";
        $whereCond = implode(" AND ", $arr);
        $qry = $this->con->query("SELECT count(survey_id) as total_count, SUM(survey_status='ACTIVE') as active_count, SUM(survey_status='INACTIVE') as inactive_count, SUM(survey_status='EXPIRED') as expired_count FROM `surveyinfodata` WHERE $whereCond");
        $arr = mysqli_fetch_array($qry);
        return $arr;
    }

    public function update($id, $sid, $title, $description, $start_date, $end_date)
    {
        date_default_timezone_set('Asia/Kolkata'); // set your timezone
        $todaydate = date("Y-m-d H:i:s");
        $todaydate1 = date("Y-m-d");

        if ($start_date == $todaydate1) {
            $status = "ACTIVE";
        } else {
            $status = "INACTIVE";
        }

        $result = $this->con->query("UPDATE `surveyinfodata` SET `survey_title`='$title',`survey_description`='$description',`survey_start_date`='$start_date',`survey_end_date`='$end_date',`survey_modified_date` ='$todaydate', `survey_modified_by`='$id',`survey_status`='$status' WHERE `survey_id` = '$sid'");
        if ($result) {
            $_SESSION['update_survey'] = 1;
            echo "<script>
            location.replace('survey_list.php');
            </script>";
            return $result;
        } else {
            echo "<script>alert('Failed to update Data')</script>";
        }
    }

    public function delete($id)
    {
        $result = $this->con->query("UPDATE `surveyinfodata` SET `status` = 'Deleted' WHERE `survey_id`= '$id'");
        $_SESSION['delete_survey'] = 1;
        if ($result) {
            header("location:survey_list.php?success==1");
            return $result;
        }
    }
    public function expireSurvey($id)
    {
        $result = $this->con->query("UPDATE `surveyinfodata` SET `survey_status` = 'EXPIRED' WHERE `survey_id`= '$id'");
        $_SESSION['expire_survey'] = 1;
        if ($result) {
            header("location:survey_list.php?success==1");
            return $result;
        }
    }
    public function updateStatus($sid, $status)
    {
        $result = $this->con->query("UPDATE `surveyinfodata` SET `survey_status` = '$status' WHERE `survey_id`= '$sid'");
        if ($result) {
            // header("location:survey_list.php?success==1");
            return $result;
        }
    }

    public function updateStatusAuto()
    {
        $todaydate = date("Y-m-d");
        $result = $this->con->query("SELECT * FROM surveyinfodata WHERE `survey_status`='ACTIVE' || `survey_status`='INACTIVE' && `survey_end_date`!= '0000-00-00'");
        // return $result;
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if (!empty($data)) {
            echo "Processing Survey to update status <br>";
            foreach ($data as $value) {
                // echo "<pre>";
                // print_r($value);
                // echo $value['survey_description'];
                $id = $value['survey_id'];
                // echo "</pre>";
                if ($value['survey_status'] == 'ACTIVE') {
                    if ($value['survey_end_date'] < $todaydate) {
                        $result = $this->con->query("UPDATE `surveyinfodata` SET `survey_status` = 'EXPIRED' WHERE `survey_id`= '$id'");
                        if ($result) {
                            echo "Survey Status update to 'Expired' for survey id $id\n";
                        }
                    }
                } else if ($value['survey_status'] == 'INACTIVE') {
                    if ($value['survey_start_date'] <= $todaydate) {
                        $result = $this->con->query("UPDATE `surveyinfodata` SET `survey_status` = 'ACTIVE' WHERE `survey_id`= '$id'");
                        if ($result) {
                            echo "Survey Status update to 'Active' for survey id $id\n";
                        }
                    }
                }
            }

            echo "All Survey Updated Successfully\n";
        } else {
            echo "No survey record to update status";
        }
    }

    public function updateStatusQues($sid, $status)
    {
        $result = $this->con->query("UPDATE `questions` SET `q_status` = '$status' WHERE `question_id`= '$sid'");
        if ($result) {
            return $result;
        }
    }

    function addQuestion($hid, $question, $type, $comp, $des = null)
    {
        $flag = false;
        if ($type == "radio_comment" || $type == "mcq_comment" || $type == "mcq" || $type == "radio") {
            $query1 = $this->con->query("INSERT INTO `questions`( `question_description`, `question_type`, `question_compulsory`, `survey_id`) VALUES ('$question','$type','$comp','$hid')");
            $flag = true;

            $ques = $this->con->query("SELECT question_id FROM questions WHERE question_id = (SELECT MAX(question_id) FROM questions)");
            $arr1 = mysqli_fetch_array($ques);
            $ques_id = $arr1[0];

            foreach ($des as $i) {
                $query2 = $this->con->query("INSERT INTO `options`(`option_type`, `option_description`, `Question_id`) VALUES ('$type','$i','$ques_id')");
                $flag = true;
            }
        } else {
            $query3 = $this->con->query("INSERT INTO `questions`( `question_description`, `question_type`, `question_compulsory`, `survey_id`) VALUES ('$question','$type','$comp','$hid')");
            $flag = true;
        }
        if ($flag) {
            return $flag;
        }
    }
    function displayQuestion($hid)
    {
        $query = $this->con->query("SELECT * FROM questions AS q LEFT JOIN options AS o ON q.question_id=o.Question_id WHERE q.survey_id = '$hid' AND (q.q_status = 'Active' OR q.q_status='Inactive') AND (o.o_status = 'Active' OR o.o_status is NULL) ORDER BY  q.question_id ");
        foreach ($query as $arr1) {
            // while ($arr1 = mysqli_fetch_array($data)) {
            $option['options'] = $arr1['option_description'];
            $option['o_id'] = $arr1['option_id'];
            $option['type'] = $arr1['question_type'];
            $option['id'] = $arr1['question_id'];
            $option['quesStatus'] = $arr1['q_status'];
            $option['iscompulsory'] = $arr1['question_compulsory'];
            $data8[$arr1['question_description']][] = $option;
        }
        return @$data8;
    }
    function viewQuestion($hid)
    {
        $query = $this->con->query("SELECT * FROM questions AS q LEFT JOIN options AS o ON q.question_id=o.Question_id WHERE q.survey_id = '$hid' AND q.q_status = 'Active' AND (o.o_status = 'Active' OR o.o_status is NULL) ORDER BY  q.question_id ");
        foreach ($query as $arr1) {
            $option['options'] = $arr1['option_description'];
            $option['type'] = $arr1['question_type'];
            $option['ques_id'] = $arr1['question_id'];
            $option['iscompulsory'] = $arr1['question_compulsory'];

            $data2[$arr1['question_description']][] = $option;
        }
        return @$data2;
    }
    function selectQuestion($qid)
    {
        $qry = $this->con->query("SELECT * FROM questions AS q LEFT JOIN options AS o ON q.question_id=o.Question_id WHERE q.Question_id = '$qid' AND q.q_status != 'Deleted' AND (o.o_status = 'Active' OR o.o_status is NULL)");
        return $qry;
    }
    function fetchQuestion($qid)
    {
        $query = $this->con->query("SELECT * FROM questions WHERE question_id='$qid'");
        return $query;
    }
    public function deletequestion($id)
    {
        $flag = false;
        $query1 = $this->con->query("UPDATE `questions` SET `q_status` = 'Deleted' WHERE `question_id`='$id'");
        $flag = true;
        $query2 = $this->con->query(" UPDATE `options` SET `o_status` = 'Deleted' WHERE `Question_id`='$id'");
        $flag = true;
        if ($flag) {
            $_SESSION['delete_question'] = 1;
            $referer = $_SERVER['HTTP_REFERER'];
            header("location: $referer");
            return $flag;
        }
    }

    public function deleteOption($id)
    {
        $query = $this->con->query(" UPDATE `options` SET `o_status` = 'Deleted' WHERE `option_id`='$id'");
        if ($query) {
            $_SESSION['delete_option'] = 1;
            $referer = $_SERVER['HTTP_REFERER'];
            header("location: $referer");
            return $query;
        }
    }

    function surveyIdInAnswer($hid)
    {
        $qry = $this->con->query("SELECT DISTINCT(a.Survey_Id) FROM surveyinfodata AS s LEFT JOIN answers AS a ON s.survey_id=a.Survey_Id WHERE a.Survey_Id!= 'NULL' && a.Survey_Id='$hid'");
        return $qry;
    }
    function surveyIdInInvitation($hid)
    {
        $qry = $this->con->query("SELECT DISTINCT(i.Survey_Id) FROM surveyinfodata AS s LEFT JOIN invitations AS i ON s.survey_id=i.Survey_Id WHERE i.Survey_Id='$hid'");
        return $qry;
    }
    function QuestionIdInAnser($hid, $qid)
    {
        $qry = $this->con->query("SELECT DISTINCT(q.question_id) FROM questions AS q LEFT JOIN answers AS a ON q.question_id=a.ans_question_id WHERE a.ans_question_id!= 'NULL' && a.Survey_Id='$hid' && q.question_id='$qid'");
        $arr = mysqli_fetch_array($qry);
        return $arr;
    }

    function checkType($des, $des1)
    {
        // $des1 = $_POST['add1'];
        // $des1 = array_filter($des1);
        if (empty($des1)) {
            $des[] = "Empty CommentBox";
        } else {
            foreach ($des1 as $k => $v) {
                $des[] = $v;
            }
        }
        return $des;
    }
    function questionUpdate($newques, $type1, $comp, $qid, $options_id)
    {
        if (@$type1 == 'radio' || @$type1 == 'radio_comment' || @$type1 == 'mcq_comment' || @$type1 == 'mcq') {
            // if(!empty($des)){
            $des = $_REQUEST['add'][$type1];
            $des = array_filter($des);
            // }
        }
        $flag = false;
        $x = 0;
        if ($newques != "" && $type1 != "") {
            if (@$type1 == 'radio' || @$type1 == 'radio_comment' || @$type1 == 'mcq_comment' || @$type1 == 'mcq') {
                if (count($options_id) <= count($des)) {
                    $query = $this->con->query("UPDATE `questions` SET `question_description`='$newques',`question_type`='$type1', `question_compulsory`='$comp' WHERE `question_id` = '$qid'");
                    foreach ($des as $inp) {
                        if ($x <= count($options_id)) {
                            @$o_id = $options_id[$x];
                            $x++;
                        }
                        $query1 = $this->con->query("REPLACE INTO `options` (`option_id`,`option_type`,`option_description`,`Question_id`) VALUES('$o_id','$type1','$inp','$qid') ");
                        $flag = true;
                    }
                }
            } else {
                $query = $this->con->query("UPDATE `questions` SET `question_description`='$newques',`question_type`='$type1', `question_compulsory`= '$comp' WHERE `question_id` = '$qid'");
                $flag = true;
                if (!empty($options_id)) {
                    for ($i = 0; $i < count($options_id); $i++) {
                        $opt_id = $options_id[$i];
                        $query1 = $this->con->query("DELETE FROM `options` WHERE option_id = '$opt_id'");
                    }
                }
            }
        } else {
            $flag = false;
        }
        return $flag;
    }

    function getAnswer($hid, $name, $email)
    {
        $answers = array_map("array_filter", $_POST['answer']);
        $ans = array_filter($answers);
        if ($_FILES['file']['name'] != '') {
            $fileName = $_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], 'uploads/' . $fileName);
        }
        // echo "<pre>";
        // print_r($ans);
        // echo "</pre>";
        foreach ($ans as $q_id => $opt) {
            $cmt = isset($opt['cmt']) ? $opt['cmt'] : "";
            foreach ($opt as $type => $v) {
                foreach ((array) $v as $key => $val) {
                    if ($type != 'cmt') {
                        if ($type == 'file') {
                            $query = $this->con->query("INSERT INTO `answers`(`Survey_Id`,`ans_question_id`, `answer_selected`, `comment`, `answer_submitted_by`, `answer_submitted_email`) VALUES ('$hid','$q_id','$fileName','$cmt','$name','$email')");
                            $flag = true;
                        } else {
                            $query = $this->con->query("INSERT INTO `answers`(`Survey_Id`,`ans_question_id`, `answer_selected`, `comment`, `answer_submitted_by`, `answer_submitted_email`) VALUES ('$hid','$q_id','$val','$cmt','$name','$email')");
                            $flag = true;
                        }
                    }
                }
            }
        }
        if ($flag) {
            $query = $this->con->query("UPDATE `invitations` SET `status`= 'submitted' WHERE `Survey_Id`='$hid' && `invitation_to_email`= '$email'");
        }
        header("location:thankyou.php");
    }

    function generateReport($hid, $email)
    {
        $qry = $this->con->query("SELECT * FROM questions AS q LEFT JOIN answers AS a ON q.question_id=a.ans_question_id WHERE q.survey_id = '$hid' AND a.ans_question_id!='NULL' AND a.answer_submitted_email='$email'");
        while ($arr = mysqli_fetch_assoc($qry)) {
            $answer['question'] = $arr['question_description'];
            $answer['type'] = $arr['question_type'];
            $answer['answer'] = $arr['answer_selected'];
            $answer['cmt'] = $arr['comment'];
            // $answer['ques_id']= $arr['ans_question_id'];
            $result[] = $answer;
        }
        return @$result;
    }

    function graphReport($hid)
    {
        $qry = $this->con->query("SELECT * FROM questions AS q LEFT JOIN  options AS o ON q.question_id=o.Question_id WHERE q.survey_id = '$hid' AND (o.o_status = 'Active' OR o.o_status is NULL) ");
        while ($arr1 = mysqli_fetch_assoc($qry)) {
            if ($arr1['question_type'] == "radio" || $arr1['question_type'] == "radio_comment" || $arr1['question_type'] == "mcq" || $arr1['question_type'] == "mcq_comment") {
                $option['options'] = $arr1['option_description'];
                $option['id'] = $arr1['question_id'];
                $option['type'] = $arr1['question_type'];
                $data[$arr1['question_description']][] = $option;
            }
        }
        return @$data;
    }
    function count_answer($id, $options, $hid)
    {
        $qry = $this->con->query("SELECT count(answer_selected) as count FROM `answers` WHERE ans_question_id='$id' && answer_selected='$options' && Survey_Id='$hid'")->fetch_assoc();
        return $qry['count'];
    }

    function downloadReprt($hid, $email = null)
    {
        $arr = array();
        $whereCond = '';
        if (!empty($email)) {
            $arr[] = "a.answer_submitted_email='$email'";
        }
        $arr[] = "q.survey_id = '$hid'";
        $arr[] = "a.ans_question_id!='NULL'";
        $whereCond = implode(" AND ", $arr);
        // Fetch records from database 
        $query = $this->con->query("SELECT * FROM questions AS q LEFT JOIN answers AS a ON q.question_id=a.ans_question_id WHERE $whereCond");

        if ($query->num_rows > 0) {
            $delimiter = ",";

            // Create a file pointer 
            $f = fopen('php://memory', 'w');
            // Set column headers 
            $fields = array(str_pad("USER NAME", 20), 'USER EMAIL', 'QUESTION', 'ANSWER SUBMITTED', 'COMMENT');
            fputcsv($f, $fields, $delimiter);
            if (empty($email)) {
                $fileName = "surveyreport_$email-" . date('Y-m-d') . ".csv";
                // Output each row of the data, format line as csv and write to file pointer 
                while ($row = $query->fetch_assoc()) {
                    // $status = ($row['status'] == 1)?'Active':'Inactive'; 
                    if ($row['question_type'] == "radio_comment" || $row['question_type'] == "mcq_comment") {
                        $cmt = $row['comment'] == "" ? "-" : $row['comment'];
                    } else {
                        $cmt = "N/A";
                    }
                    $lineData = array($row['answer_submitted_by'], $row['answer_submitted_email'], $row['question_description'], $row['answer_selected'], $cmt);
                    fputcsv($f, $lineData, $delimiter);
                }
            } else {
                $fileName = "surveyreport_$email-" . date('Y-m-d') . ".csv";
                // Output each row of the data, format line as csv and write to file pointer 
                while ($row = $query->fetch_assoc()) {
                    // $status = ($row['status'] == 1)?'Active':'Inactive'; 
                    if ($row['question_type'] == "radio_comment" || $row['question_type'] == "mcq_comment") {
                        $cmt = $row['comment'] == "" ? "-" : $row['comment'];
                    } else {
                        $cmt = "N/A";
                    }
                    $lineData = array($row['question_description'], $row['answer_selected'], $cmt);
                    fputcsv($f, $lineData, $delimiter);
                }
            }
            // Move back to beginning of file 
            fseek($f, 0);

            // Set headers to download file rather than displayed 
            header('Content-Type: text/csv');
            header("Content-Disposition: attachment; filename=\"$fileName\"");

            //output all remaining data on a file pointer 
            fpassthru($f);
        }
        exit;
    }

    function countQuestiontaken($id = null)
    {
        $result = $this->con->query("SELECT sum(ans_question_id) as TotOutput FROM answers where Survey_Id= '$id'");
        return $result;
    }
}