<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';
include 'nav.php';

$sid = $_GET['s_id'];
$qid = $_GET['ques_id'];
$survey = new survey;

$query = $survey->selectQuestion($qid);
while ($res = mysqli_fetch_assoc($query)) {
    $options_id[] = $res['option_id'];
    $type = $res['question_type'];
    @$required = $res['question_compulsory'];
}
?>
<style>
    #msg,
    #msg2 {
        display: none;
    }
</style>
<link rel="stylesheet" href="/css/modal.css">
<div id="msg" class="alert alert-success" role="alert" style="width:65%; margin-left:11%; text-align:center;">
    Question Updated Successfully!!
</div>
<div id="msg2" class="alert alert-danger" role="alert" style="width:65%; margin-left:11%; text-align:center;">
    Failed to update data.
</div>
<?php
if (@$_SESSION['delete_option'] == 1) {
?>
    <div id="msg1" class="alert alert-danger" role="alert" style="width:65%; margin-left:11%; text-align:center;">
        Option Deleted Successfully!!
    </div>
<?php
    $_SESSION['delete_option'] = 0;
}
$query = $survey->selectQuestion($qid);
while ($arr = mysqli_fetch_array($query)) {
    $question = $arr['question_description'];
    $type = $arr['question_type'];
    $option['options'] = $arr['option_description'];
    $option['id'] = $arr['Question_id'];
    $option['o_id'] = $arr['option_id'];

    $result[$arr['question_description']][] = $option;
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";
}
?>
<link rel="stylesheet" href="/css/rating.css">
<div class="col-md-8" style="margin: 10vh 20vh;">
    <div class="card card-outline card-success" style="border-top:4px solid #585656;">
        <div class="card-header bgcolor">
            <h3 class="card-title labelcolor" style="margin-bottom:20px; text-align:center;"><b>Update Question</b></h3>
            <hr>
            <div class="card-tools">
                <!--  Body -->
                <form action="" id="myform" method="post">
                    <div class="container-fluid" style="width:fit-">
                        <div class="col-lg-12">
                            <div class="row">
                                <input type="hidden" value="<?php echo $qid ?>" name="question_id">
                                <?php
                                $typeArray = ['mcq', 'mcq_comment', 'radio', 'radio_comment'];
                                foreach (array_keys($typeArray, @$type, true) as $key) {
                                    unset($typeArray[$key]);
                                }
                                ?>
                                <div class="col-sm-6 border-right">
                                    <div class="form-group">
                                        <?php
                                        $arr1 = $survey->QuestionIdInAnser($sid, $qid);
                                        $disabled = @$arr1['question_id'] == $qid ? "readonly" : "";
                                        $unclickable = !empty($disabled) ? "pointer-events: none; cursor: default;" : "";
                                        ?>
                                        <label for="" class="control-label labelcolor">Question</label>
                                        <textarea name="newques" id="question" cols="20" rows="3" class="form-control" style="font-size:medium;" <?php echo $disabled; ?>><?php echo $question; ?></textarea>
                                        <span id="f_question" class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label labelcolor">Question Answer Type</label>
                                        <input type="hidden" id="from_type" value="<?php echo $type; ?>">
                                        <select name="type1" id="drop" class="custom-select custom-select-sm" style="<?php echo $unclickable; ?> height: fit-content;" selected value="<?php echo $type; ?>">
                                            <option value="radio" <?Php if ($type == "radio") {
                                                                        echo "selected";
                                                                    } ?>>Single Answer/Radio Button</option>
                                            <option value="radio_comment" <?Php if ($type == "radio_comment") {
                                                                                echo "selected";
                                                                            } ?>>Single Answer/Radio Button and Comment</option>
                                            <option value="mcq" <?Php if ($type == "mcq") {
                                                                    echo "selected";
                                                                } ?>>Multiple Answer/Check Boxes</option>
                                            <option value="mcq_comment" <?Php if ($type == "mcq_comment") {
                                                                            echo "selected";
                                                                        } ?>>Multiple Answer/Check Boxes and Comment</option>
                                            <option value="text" <?Php if ($type == "text") {
                                                                        echo "selected";
                                                                    } ?>>Descriptive</option>
                                            <option value="file" <?Php if ($type == "file") {
                                                                        echo "selected";
                                                                    } ?>>File</option>
                                            <option value="rating" <?Php if ($type == "rating") {
                                                                        echo "selected";
                                                                    } ?>>Rating</option>
                                            <option value="date" <?Php if ($type == "date") {
                                                                        echo "selected";
                                                                    } ?>>Date/Time</option>
                                            <option value="one_word" <?Php if ($type == "one_word") {
                                                                            echo "selected";
                                                                        } ?>>Short Text</option>
                                            <option value="email" <?Php if ($type == "email") {
                                                                        echo "selected";
                                                                    } ?>>E-mail</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if (!empty($disabled)) { ?>
                                    <div class="col-sm-6 labelcolor">
                                        <div id="msg3" class="alert alert-success" role="alert" style="text-align:center;">
                                            You cannot update existing but can only add options!!
                                        </div>
                                    <?php } ?>
                                    <span class="labelcolor ml-2" style="font-weight:bold;">Preview</span>
                                    <div class="preview labelcolor mt-5">
                                        <div class="data1">
                                            <?php
                                            $checked =  $required == "Yes" ? 'checked' : "";
                                            if ($type == 'radio' || $type == 'radio_comment' || $type == 'mcq_comment' || $type == 'mcq') {
                                                $j = 0;
                                                $i = 0;
                                                foreach ($result as $optype => $option) {
                                                    foreach ($option as $key => $val) {
                                            ?>
                                                        <input type="hidden" value="<?php echo implode(',', $options_id); ?>" name="options_id">
                                                        <?php
                                                        $disabledopt = @$arr1['question_id'] == $val['id'] ? "readonly" : "";
                                                        $j++;
                                                        $len = count($option);
                                                        $text = ($len == 1) ? 'Atleast one option is required. It cannot be deleted!!' : 'Do you really want to delete the option? This action cannot be undone.';
                                                        $i++;
                                                        if ($type == "mcq" || $type == "mcq_comment") {
                                                            $input_type = "checkbox";
                                                        } else {
                                                            $input_type = "radio";
                                                        }
                                                        ?>
                                                        <div class="field">
                                                            <div class="input-group mb-3" style="width:29vh;">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <input type="<?php echo $input_type; ?>" aria-label="<?php echo ucfirst($input_type); ?> button for following text input" name="<?php echo $input_type; ?>" disabled>
                                                                    </div>
                                                                </div>
                                                                <input type="text" name="add[<?php echo $type; ?>][]" class="form-control empty<?php echo @$type; ?> fsize" aria-label="Text input with <?php echo $input_type; ?>" value="<?php echo $val['options']; ?> " <?php echo $disabledopt ?>>
                                                                <?php if (empty($disabledopt)) {
                                                                    $id = $val['o_id']; ?>
                                                                    <a class="delete-confirm" href='<?php echo ($len == 1) ? "javascript:void(0)" : "delete_option.php?opt_id= $id" ?>'><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" style="margin-left:10px; height: fit-content; background-color: #b43d3d;"><i class="fa fa fa-trash"></i></button></a>
                                                                <?php } ?>
                                                            </div>
                                                            <span class="text-danger"></span>
                                                        </div>
                                                        <?php
                                                        if ($type == 'mcq_comment' || $type == "radio_comment") {
                                                            if ($j == $len) { ?>
                                                                <div class="dynamic_field6"></div>
                                                                <button class="btn addbtn4 bluecolor mb-3" type="button" style="width:14vh !important;">Add options</button>
                                                                <input id="comp11" type="checkbox" class="comp-border" name="comp" <?php echo $checked ?> style="<?php echo  $unclickable ?>">
                                                                <label for="comp11" class="checkbox-inline">Question Compulsory</label>
                                                                <div class="input-group mb-3" style="width:29vh;">
                                                                    <div class="input-group-prepend"><span class="input-group-text">Comment</span></div><textarea class="form-control" aria-label="With textarea" rows="4" cols="50" readonly></textarea>
                                                                </div>
                                                            <?php }
                                                        } else {
                                                            if ($i == $len) { ?>
                                                                <div class="dynamic_field6"></div>
                                                    <?php }
                                                        }
                                                    }
                                                }
                                            } else {
                                                if ($type == "text") { ?>
                                                    <div class="input-group mb-3" style="width:29vh;">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Descriptive</span>
                                                        </div>
                                                        <textarea class="form-control" aria-label="With textarea" rows="6" cols="50" disabled></textarea>
                                                    </div>
                                                    <input id="comp17" type="checkbox" class="comp-border" name="comp" <?php echo $checked ?> style="<?php echo $unclickable ?>">
                                                    <label for="comp17" class="checkbox-inline">Question Compulsory</label>
                                                <?php  } elseif ($type == "file") { ?>
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Upload file</label>
                                                        <input class="form-control form-control-lg" type="file" id="formFile" disabled>
                                                    </div>
                                                    <input id="comp18" type="checkbox" class="comp-border" name="comp" <?php echo $checked ?> style="<?php echo $unclickable ?>">
                                                    <label for="comp18" class="checkbox-inline">Question Compulsory</label>
                                                <?php } elseif ($type == "date") { ?>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Date & Time:</span>
                                                        </div>
                                                        <input type="datetime-local" id="datetime" name="datetime" style="width:30vh;" disabled>
                                                    </div>
                                                    <input id="comp19" type="checkbox" class="comp-border" name="comp" <?php echo $checked ?> style="<?php echo $unclickable ?>">
                                                    <label for="comp19" class="checkbox-inline">Question Compulsory</label>
                                                <?php } elseif ($type == "rating") { ?>
                                                    <div class="rate py-3 text-white mt-3" style="background-color:#dbdddf;">
                                                    <label class='mt-2' style="margin-left:2%; color:black;" for='vol'>Star Rating (1 to 5 star):</label>
                                                        <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                                        </div>
                                                    </div>
                                                    <input id="comp20" type="checkbox" class="comp-border" name="comp" <?php echo $checked ?> style="<?php echo $unclickable ?>">
                                                    <label for="comp20" class="checkbox-inline">Question Compulsory</label>
                                                <?php   } elseif ($type == "one_word") { ?>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Single Word</span>
                                                        </div>
                                                        <input class="form-control input-sm" id="inputsm" type="text" disabled>
                                                    </div>
                                                    <input id="comp22" type="checkbox" class="comp-border" name="comp" <?php echo $checked ?> style="<?php echo $unclickable ?>">
                                                    <label for="comp22" class="checkbox-inline">Question Compulsory</label>
                                                <?php  } elseif ($type == "email") { ?>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="bx bx-at"><label type="email" aria-label="Email for following text input" name="email" disabled></i>
                                                            </div>
                                                        </div>
                                                        <input type="email" class="form-control" aria-label="Text input with email" disabled>
                                                    </div>
                                                    <input id="comp21" type="checkbox" class="comp-border" <?php echo $checked ?> style="<?php echo $unclickable ?>">
                                                    <label for="comp21" class="checkbox-inline">Question Compulsory</label>
                                                <?php  }
                                            }
                                            if ($type == 'mcq') { ?>
                                                <button class="btn addbtn4 bluecolor mb-3" type="button" style="width:14vh !important;">Add options</button>
                                                <input id="comp14" type="checkbox" class="comp-border" name="comp" <?php echo $checked ?> style="<?php echo $unclickable ?>">
                                                <label for="comp14" class="checkbox-inline">Question Compulsory</label>
                                            <?php } else if ($type == 'radio') { ?>
                                                <button class="btn addbtn4 bluecolor mb-3" type="button" style="width:14vh !important;">Add options</button>
                                                <input id="comp15" type="checkbox" class="comp-border" name="comp" <?php echo $checked ?> style="<?php echo $unclickable ?>">
                                                <label for="comp15" class="checkbox-inline">Question Compulsory</label>
                                            <?php }
                                            ?>
                                        </div>
                                        <?php
                                        foreach ($typeArray as $i) {
                                            if ($i == "mcq" || $i == "mcq_comment") {
                                                $inputType = "checkbox";
                                            } else {
                                                $inputType = "radio";
                                            }
                                        ?>
                                            <div class="data" id="<?php echo $i ?>">
                                                <div class="dynamic_field<?php echo $i ?>">
                                                    <?php
                                                    foreach ($result as $optype => $option) {
                                                        foreach ($option as $key => $val) {
                                                            if (!empty($val['options'])) {
                                                    ?>
                                                                <div class="input-group mb-3" style="width:29vh;">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <input type="<?php echo $inputType ?>" aria-label="<?php echo $inputType ?> for following text input" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" name="add[<?php echo $i ?>][]" class="form-control empty<?php echo @$i; ?> fsize" aria-label="Text input with <?php echo $inputType ?>" value="<?php echo (!empty($val['options'])) ? $val['options'] : ""; ?> ">
                                                                    <?php if (empty($disabledopt)) {
                                                                        $id = $val['o_id']; ?>
                                                                        <a class="delete-confirm" href='<?php echo ($len == 1) ? "javascript:void(0)" : "delete_option.php?opt_id= $id" ?>'><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" style="margin-left:10px; height: fit-content; background-color: #b43d3d;"><i class="fa fa fa-trash"></i></button></a>
                                                                    <?php } ?>
                                                                </div>
                                                                <!-- <span class="text-danger" id="<?php echo $id ?>"></span>    -->
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div>
                                                    <button class="btn bluecolor mb-3 add_btn" type="button" id="<?php echo $i ?>" style="width:14vh !important;">Add options</button>
                                                    <input id="comp1" type="checkbox" class="comp-border" name="comp">
                                                    <label for="comp1" class="checkbox-inline">Question Compulsory</label>
                                                </div>
                                                <?php if ($i == 'radio_comment' || $i == 'mcq_comment') { ?>
                                                    <div class="input-group mb-3" style="width:31vh;">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Comment</span>
                                                        </div>
                                                        <textarea class="form-control" aria-label="With textarea" rows="4" cols="50" readonly></textarea>
                                                    </div>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="data" id="text">
                                            <div class="input-group mb-3" style="width:29vh;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Descriptive</span>
                                                </div>
                                                <textarea class="form-control" aria-label="With textarea" rows="6" cols="50" disabled></textarea>
                                            </div>
                                            <input id="comp5" type="checkbox" class="comp-border" name="comp">
                                            <label for="comp5" class="checkbox-inline">Question Compulsory</label>
                                        </div>

                                        <div class="data" id="one_word">
                                            <div class="input-group mb-3" style="width:29vh;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Single Word</span>
                                                </div>
                                                <input class="form-control input-sm" id="inputsm" type="text" disabled>
                                            </div>
                                            <input id="comp6" type="checkbox" class="comp-border" name="comp">
                                            <label for="comp6" class="checkbox-inline">Question Compulsory</label>
                                        </div>

                                        <div class="data" id="date">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Date and Time:</span>
                                                </div>
                                                <input type="datetime-local" id="datetime" name="datetime" style="width:30vh;" disabled>
                                            </div>
                                            <input id="comp7" type="checkbox" class="comp-border" name="comp" style="width:50%;">
                                            <label for="comp7" class="checkbox-inline">Question Compulsory</label>
                                        </div>

                                        <div class="data" id="rating">
                                            <div class="rate py-4 text-white mt-3" style="background-color:#dbdddf;">
                                            <label class='mt-2' style="margin-left:2%; color:black;" for='vol'>Star Rating (1 to 5 star):</label>
                                                <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                                </div>
                                            </div>
                                            <input id="comp10" type="checkbox" class="comp-border" name="comp">
                                            <label for="comp10" class="checkbox-inline">Question Compulsory</label>
                                        </div>

                                        <div class="data" id="file">
                                            <div class="mb-3" style="width:29vh;">
                                                <label for="formFile" class="form-label">Upload file</label>
                                                <input class="form-control form-control-lg" type="file" id="formFile" disabled>
                                            </div>
                                            <input id="comp8" type="checkbox" class="comp-border" name="comp">
                                            <label for="comp8" class="checkbox-inline">Question Compulsory</label>
                                        </div>
                                        <!-- </div> -->

                                        <div class="data" id="email">
                                            <div class="input-group mb-3" style="width:29vh;">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class='bx bx-at'><label type="email" aria-label="Email for following text input" name="email" disabled></i>
                                                    </div>
                                                </div>
                                                <input type="email" class="form-control" aria-label="Text input with email" disabled>
                                            </div>
                                            <input id="comp9" type="checkbox" class="comp-border" name="comp">
                                            <label for="comp9" class="checkbox-inline">Question Compulsory</label>
                                        </div>
                                    </div>
                                    <span style="margin-left:20%;">
                                        <button id="save" class="btn greencolor" type="submit" name="update-details" value="update-details" style="width:10vh; height: 4vh; font-size:small;">Update</button>
                                        <a href="viewsurvey.php?survey_id=<?php echo $sid; ?>"><button id="back" class="btn bluecolor" type="button" style="width:10vh; height: 4vh; font-size:small;">View</button></a>
                                    </span>
                                    </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-confirm" role="document">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <h4 class="modal-title" id="exampleModalLabel"><?php echo ($len != 1) ? 'Are you sure?' : 'Alert !!' ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $text ?>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn bluecolor" data-dismiss="modal" style="font-size:small;"><?php echo ($len != 1) ? 'Cancel' : 'OK' ?></button>
                <?php if ($len != 1) { ?>
                    <a class="delete-yes"><button type="button" href="" class="btn btn-danger" style="font-size:small;  background-color: #b43d3d !important; color: white; width: 8vh; height: 4vh; border:none; border-radius:5px;">Delete</button></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#drop").change(function() {
            var from_type = $("#from_type").val();
            var abc = "add[" + from_type + "][]";
            $('input[name="' + abc + '"]').each(function(key, value) {
                if (!($(this).attr("value"))) {
                    // $(this).closest('.form-row').remove();
                    $(this).parent('div').parent('div').parent('div').remove();
                }
            });
            var to_type = $("#drop").val();
            $(".data").hide();
            $(".data1").hide();
            $("#from_type").val(to_type);
            $("#" + $(this).val()).show();
            if ('<?php echo $type ?>' == to_type) {
                location.reload();
            }
        });
    });

    $(document).ready(function() {
        var i = 1;
        $('.add_btn').click(function() {
            var id = this.id;
            if (id == 'radio' || id == 'radio_comment') {
                var inputt = "radio";
            } else {
                inputt = "checkbox";
            }
            i++;
            $('.dynamic_field' + id + '').append('<div class="form-row" id="row1' + i + '"><div class ="col"> <div class="input-group mb-3" style="width:25vh;"><div class="input-group-prepend"><div class="input-group-text"><input type="' + inputt + '" aria-label="Checkbox for following text input" disabled></div></div><input type="text" name="add[' + id + '][]" class="form-control empty' + id + ' fsize" aria-label="Text input with "' + inputt + '"></div><span class="text-danger"></span></div> <div class="col"> <td><button type="button" name="add11" class="btn btn-danger btn_remove" style="background-color: #b43d3d" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row1' + button_id + '').remove();
        });
        $('.addbtn4').click(function() {
            i++;
            $('.dynamic_field6').append('<div class="form-row" id="row6' + i + '"><div class ="col"> <div class="input-group mb-3" style="width:25vh;"><div class="input-group-prepend"><div class="input-group-text"><input type="<?php echo @$input_type; ?>" aria-label="<?php echo @$input_type; ?> button for following text input" name="<?php echo @$input_type; ?>" disabled></div></div><input type="text" name="add[<?php echo @$type; ?>][]" class="form-control empty<?php echo @$type; ?> fsize" aria-label="Text input with <?php echo @$input_type; ?> button"></div><span class="text-danger"></span></div> <div class="col"> <td><button type="button" name="add11" class="btn btn-danger btn_remove" style="background-color: #b43d3d" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");

            $('#row6' + button_id + '').remove();
        });
    });

    $('.delete-confirm').click(function() {
        $('#deleteModal').modal('show');
        var deleteUrl = $(this).attr('href');
        $(".delete-yes").attr('href', deleteUrl);
        return false;
    });

    setTimeout(() => {
        $('#msg1').css('display', 'none');
    }, 2000);

    var form = $('#myform');
    form.submit(function(e) {
        e.preventDefault();
        var error_flag = validateForm();
        // alert(error_flag); 
        if (error_flag) {
            var formdata = form.serialize();

            $.ajax({
                url: "ajax_updateques",
                type: "POST",
                data: formdata,
                cache: false,
                success: function(data) {
                    var obj = JSON.parse(data);
                    console.log(obj.status);
                    if (obj.status == "success") {
                        $("#msg").show();
                        setTimeout(function() {
                            $("#msg").hide();
                        }, 2000);
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);
                    } else {
                        $("#msg2").show();
                        setTimeout(function() {
                            $("#msg2").hide();
                        }, 2000);
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);
                    }
                },
                error: function() {
                    console.log('error');
                }
            });
        } else {
            return error_flag;
        }
    });
</script>
<script src="/js/updatequestion.js"></script>
<?php
include 'nav_bottom.php';
?>