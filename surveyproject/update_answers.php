<?php
include 'config.php';

@$hid = $_GET['survey_id'];
@$email = $_GET['email'];

$query1 = "SELECT * FROM `surveyinfodata` WHERE `survey_id` = '$hid'";
$result1 = mysqli_query($con, $query1);
$res = mysqli_fetch_array($result1);
$title = $res[1];
$description = $res[2];

$query= "SELECT * FROM `questions` AS q INNER JOIN `answers` AS a on q.question_id=a.ans_question_id WHERE q.survey_id='$hid' AND a.answer_submitted_email='$email'";
$result = mysqli_query($con, $query);
while ($res = mysqli_fetch_assoc($result)) {
    $name= $res['answer_submitted_by'];
    // $answer['q_des'] = $res['question_description'];
    $answer['answer_id'] = $res['answer_id'];
    $answer['opt_selected'] = $res['answer_selected'];

    $result2[$res['ans_question_id']][] = $answer;
}
// echo"<pre>";
// print_r($result2);
// echo"</pre>";
?>
<?php
// if (isset($_POST['update'])) {
//     extract($_POST);

//     // $answers = array_map("array_filter", $_POST['answer']);
//     // echo "<pre>";
//     // print_r($answers);
//     // echo "</pre>";
//     // $ans = array_filter($answers);

//     foreach ($result1 as $q_id => $opt) {
//         foreach ($opt as $ind => $val) {
//             $query="UPDATE `answers` SET `Survey_Id`='$hid',`ans_question_id`='$q_id',`answer_selected`='$val',`answer_submitted_by`='$name',`answer_submitted_email`='$email', WHERE ";
//             $data = mysqli_query($con, $query);

//             header("location:thankyou.php?survey_id=$hid&email=$email");
//         }
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center
        }

        .rating>input {
            display: none
        }

        .rating>label {
            position: relative;
            width: 1em;
            font-size: 30px;
            font-weight: 300;
            color: #d4b772;
            cursor: pointer
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0;
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important
        }

        .rating>input:checked~label:before {
            opacity: 1
        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4
        }
    </style>

</head>
<body style="background-color: #81b8c9;">
    <div class="mx-0 mx-sm-auto">
        <div class="card" style="width: 55%; margin: auto; background: #cbe9f5;">
            <div class="card-header " style="background-color: #81b8c9;">
                <h5 class="card-title text-white mt-2" style="text-align:center" id="exampleModalLabel">SURVEY FORM</h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="far fa-file-alt fa-4x mb-3 text-primary"></i>
                    <p>
                        Your opinion matters
                    </p>
                    <p>
                        Please take a moment to fill out this survey.
                    </p>
                </div>
                <hr />

                <div class="text-center">
                    <i class="far fa-file-alt fa-4x mb-3 text-primary"></i>
                    <p>
                        <strong><?php echo $title; ?></strong>
                    </p>
                    <p>
                        <strong><?php echo $description; ?></strong>
                    </p>
                </div>
                <hr />

                <form class="px-4" action="" method="post">
                    <div class="text-center">
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label">NAME:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" style="width:305px;" value="<?php echo $name; ?>" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">EMAIL:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" style="width:305px;" value="<?php echo $email; ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <?php
                    $query = "SELECT * FROM questions AS q LEFT JOIN options AS o ON q.question_id=o.Question_id WHERE q.survey_id = '$hid' ORDER BY q.question_id";
                    $data = mysqli_query($con, $query);
                    while ($arr1 = mysqli_fetch_assoc($data)) {
                        $option['options'] = $arr1['option_description'];
                        $option['type'] = $arr1['question_type'];
                        $option['ques_id'] = $arr1['question_id'];

                        $data1[$arr1['question_description']][] = $option;
                    }
                    // echo "<pre>";
                    // print_r($data1);
                    // echo "</pre>";
                    ?>
                    <div class="info">
                        <?php
                        foreach ($data1 as $ques => $option) {
                            echo "<b> Question: </b>" . $ques . "<br><br>";
                            $len = count($option);
                            $j = 0;
                            foreach ($option as $key => $val) {
                                $j++;
                                if ($val['type'] == 'mcq' && $val['options'] != 'Empty CommentBox') {
                                    echo '<div class="input_check"><input type="checkbox" name="answer[' . $val['ques_id'] . '][]" value="' . $val['options'] . '"> &nbsp;<span class="optdata"> ' . $val['options'] . '</span></div>' . "<br>";
                                } elseif ($val['type'] == 'mcq_comment') {
                                    if ($val['options'] == 'Empty CommentBox') {
                                        echo '<div class="input-group mb-3" style="width:305px;"><div class="input-group-prepend"><span class="input-group-text" style="height: 18vh;">Comment</span></div><textarea class="form-control" name="answer[' . $val['ques_id'] . '][]" aria-label="With textarea" rows="4" cols="50"></textarea></div>';
                                    } else {
                                        if ($j == $len) {
                                            echo '<div class="input-group mb-3" style="width:305px;"><div class="input-group-prepend"><span class="input-group-text" style="height: 18vh;">Comment</span></div><textarea class="form-control" name="answer[' . $val['ques_id'] . '][]" placeholder=" ' . $val['options'] . '"  aria-label="With textarea" rows="4" cols="50"></textarea></div>';
                                        } else {
                                            echo '<div class="input_check"><input type="checkbox" name="answer[' . $val['ques_id'] . '][]" value="' . $val['options'] . '" > &nbsp;<span class="optdata"> ' . $val['options'] . '</span></div>' . "<br>";
                                        }
                                    }
                                } elseif ($val['type'] == 'radio' && $val['options'] != 'Empty CommentBox') {
                                    echo '<div class="input_check"><input type="radio" name="answer[' . $val['ques_id'] . '][]" value="' . $val['options'] . '"> &nbsp;<span class="optdata"> ' . $val['options'] . '</span></div>' . "<br>";
                                } elseif ($val['type'] == 'radio_comment') {
                                    if ($val['options'] == 'Empty CommentBox') {
                                        echo '<div class="input-group mb-3" style="width:305px;"><div class="input-group-prepend"><span class="input-group-text" style="height: 18vh;">Comment</span></div><textarea class="form-control" name="answer[' . $val['ques_id'] . '][]" aria-label="With textarea" rows="4" cols="50"></textarea></div>';
                                    } else {
                                        if ($j == $len) {
                                            echo '<div class="input-group mb-3" style="width:305px;"><div class="input-group-prepend"><span class="input-group-text" style="height: 18vh;">Comment</span></div><textarea class="form-control" name="answer[' . $val['ques_id'] . '][]"  aria-label="With textarea" rows="4" cols="50" placeholder=" ' . $val['options'] . '"></textarea></div>';
                                        } else {
                                            echo '<div class="input_check"><input type="radio" name="answer[' . $val['ques_id'] . '][]" value="' . $val['options'] . '"> &nbsp; <span class="optdata">' . $val['options'] . '</span></div>' . "<br>";
                                        }
                                    }
                                } elseif ($val['type'] == 'text') {
                                    echo '<div class="mb-3" style="width:230px;"><textarea class="form-control" name="answer[' . $val['ques_id'] . '][]" aria-label="With textarea" rows="4" cols="5" style="font-size:14px;"></textarea></div>' . " <br>";
                                } elseif ($val['type'] == 'email') {
                                    echo '<div class="input-group mb-3" style="width:305px;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="bx bx-at"><label type="email" aria-label="Email for following text input" name="email" disabled></i>
                                        </div>
                                    </div>
                                    <input type="email" name="answer[' . $val['ques_id'] . '][]" class="form-control" aria-label="Text input with email" disabled>
                                </div>' . "<br>";
                                } elseif ($val['type'] == 'one_word') {
                                    echo '<div class="input-group mb-3" style="width: 320px;"><div class="input-group-prepend"><span class="input-group-text">Single Word</span></div><input class="form-control input-sm" id="inputsm" type="text" name="answer[' . $val['ques_id'] . '][]"></div>' . "<br>";
                                } elseif ($val['type'] == 'file') {
                                    echo '<div class="mb-3" style="width:305px;">
                                    <label for="file" class="form-label">Upload file</label>
                                    <input class="form-control form-control-lg" type="file" id="file" name="answer[' . $val['ques_id'] . '][]" >
                                </div>' . "<br>";
                                } elseif ($val['type'] == 'date') {
                                    echo '<div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Date and Time:</span>
                                    </div>
                                    <input type="datetime-local" id="datetime" name="answer[' . $val['ques_id'] . '][]">
                                    </div>';
                                } elseif ($val['type'] == 'rating') {
                                    echo '<div class="rating">
                                <input type="radio" name="answer[' . $val['ques_id'] . '][]" value="5" id="5"><label for="5">☆</label>
                                <input type="radio" name="answer[' . $val['ques_id'] . '][]" value="4" id="4"><label for="4">☆</label>
                                <input type="radio" name="answer[' . $val['ques_id'] . '][]" value="3" id="3"><label for="3">☆</label>
                                <input type="radio" name="answer[' . $val['ques_id'] . '][]" value="2" id="2"><label for="2">☆</label>
                                <input type="radio" name="answer[' . $val['ques_id'] . '][]" value="1" id="1"><label for="1">☆</label>
                            </div>' . "<br>";
                                }
                            }
                        }
                        ?>

                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                        <button type="submit" name="Clear Form" value="reset" class="btn btn-primary" onclick="return confirm('Are you sure you want to clear the form?');">Clear Form</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>

