<?php
include 'config/connection.php';
include 'controllers/usercontroller.php';
include 'controllers/surveycontroller.php';
include 'nav.php';

$user = new user;
$survey = new survey;
$cnt = $user->user_count();
?>
<div class="container">
    <?php
    if ($_SESSION['role'] == 'User') {
        $data = $survey->getDatabasedonUser($_SESSION['id']);
        $cnt1 = $survey->survey_count($_SESSION['id']);  
        
    } else if ($_SESSION['role'] != 'User') {
        $data = $survey->getDatabasedonUser();
        $cnt1 = $survey->survey_count();
         ?>
        <div class="row ml-2" >
            <div class="col-sm" style="margin:10px; background-color:#6aaacc; border-top:4px solid #3787b0; border-radius:5px;">
                <p style="margin:5px;"><b>Number of Total Users:</b><label></p>
                <p style="text-align:center ; font-size: larger;"><b><?php echo $cnt['user_count']; ?></label></b></p>
                <br>
                <!-- <a class="btn btncolor mb-3" href="user_list.php" role="button" style=" font-size:small; margin-left:40%;">View Users</a> -->
            </div>
            <div class="col-sm" style="margin:10px;background-color:#93bfa7; border-top:4px solid #68947c; border-radius:5px;">
                <p style="margin:5px;"><b>Number of Active Users :</b><label></p>
                <p style="text-align:center ; font-size: larger;"><b><?php echo $cnt['a_user_count']; ?></label></b></p>
            </div>
            <div class="col-sm" style="margin:10px 30px 10px 10px;background-color:#c9b59a; border-top:4px solid #a37f4d; border-radius:5px;">
                <p style="margin:5px;"><b>Number of InActive Users :</b><label></p>
                <p style="text-align:center ; font-size: larger;"><b><?php echo $cnt['user_count'] - $cnt['a_user_count']; ?></label></b></p>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="row ml-2">
        <div class="col-sm" style="margin:10px;background-color:#6aaacc; border-top:4px solid #3787b0; border-radius:5px;">
            <p style="margin:5px;"><b>Number of Total Surveys:</b><label></p>
            <p style="text-align:center ; font-size: larger;"><b><?php echo $cnt1['total_count']; ?></label></b></p>
        </div>
        <div class="col-sm bgcolor" style="margin:10px;background-color:#93bfa7 !important; border-top:4px solid #68947c; border-radius:5px;">
            <p style="margin:8px;"><b>Number of Active Surveys :</b><label></p>
            <p style="text-align:center ; font-size: larger;"><b><?php echo $cnt1['active_count'];?></label></b></p>
        </div>
        <div class="col-sm" style="margin:10px;background-color:#c9b59a; border-top:4px solid #a37f4d; border-radius:5px;">
            <p style="margin:5px;"><b>Number of InActive Surveys :</b><label></p>
            <p style="text-align:center ; font-size: larger;"><b><?php echo $cnt1['inactive_count']; ?></label></b></p>
        </div>
        <div class="col-sm" style="margin:10px 30px 10px 10px;background-color:#cc7872; border-top:4px solid #bd5248; border-radius:5px;">
            <p style="margin:5px;"><b>Number of Expired Surveys :</b><label></p>
            <p style="text-align:center ; font-size: larger;"><b><?php echo $cnt1['expired_count']; ?></label></b></p>
        </div>
    </div>
    <?php
    if (!empty($data)) {
        foreach ($data as $arr) {
            $hid =  $arr['survey_id'];
            $cnt2 = $survey->count_invitedUser($hid);
    ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 green text-center d-height">
                <div class="card h-100 flex-fill" style="border-top:4px solid #585656;">
                    <div class="card-header bgcolor">
                    </div>
                    <div class="card-body bgcolor ">
                        <h5 class="card-title cardcolor"><b><?php echo $arr['survey_title']; ?></b></h5>
                        <div class="dates">
                            <div class="start">
                                <strong>Start: &nbsp;<?php echo $arr['survey_start_date']; ?></strong>
                            </div>
                            <div class="ends">
                                <strong>End: &nbsp;<?php echo $arr['survey_end_date']; ?></strong>
                            </div>
                        </div>
                        <div>
                            <b>Survey Description:</b> <?php echo $arr['survey_description']; ?>
                        </div>
                        <div class="mt-2">
                            <b>Survey Status:</b> <?php echo $arr['survey_status']; ?>
                        </div>

                        <div class="stats">
                            <div>
                                <strong>INVITED</strong>&nbsp;<?php echo $cnt2['invited']; ?>
                            </div>
                            <div>
                                <strong> Have Taken</strong>&nbsp;<?php echo $cnt2['attempted']==""?'0': $cnt2['attempted']; ?>
                            </div>
                            <div>
                                <strong>Left</strong>&nbsp;<?php echo $cnt2['invited'] - $cnt2['attempted']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bgcolor">
                        <div class=row>
                            <div class=col-sm-12>
                                <div class=col-sm-6>
                                    <a class="btn btncolor mb-2 ml-0" href="tabular_surveyReport.php?survey_id=<?php echo $arr['survey_id']; ?>" role="button" style="font-size:small;">Tabular Report</a>
                                </div>
                                <div class=col-sm-6>
                                    <a class="btn btncolor" href="graphical_surveyReport.php?survey_id=<?php echo $arr['survey_id']; ?>" role="button" style="font-size:small;">Graphical Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php }
    } ?>
</div>

<?php
include 'nav_bottom.php';
?>