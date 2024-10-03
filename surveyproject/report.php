<?php
include 'config/connection.php';
include 'nav.php';
include 'controllers/surveycontroller.php';
include 'controllers/usercontroller.php';

$survey = new survey;
$user = new user;
if ($_SESSION['role'] == 'User') {
    $cnt1 = $survey->survey_count($_SESSION['id']);
} else if ($_SESSION['role'] != 'User') {
    $cnt1 = $survey->survey_count();
    $cnt = $user->user_count();
}
?>
<div class="container mt-5">
    <div class="row mt-5">
        <div class="col mt-5"><canvas id="SurveyChart" style="width:100%;max-width:600px"></canvas></div>
        <?php if ($_SESSION['role'] != 'User') { ?>
            <div class="col mt-5"><canvas id="UsersChart" style="width:100%;max-width:600px"></canvas></div>
        <?php } ?>
    </div>
</div>
<script>
    var xValues = ["Active Surveys", "Inactive Surveys", "Expired Surveys"];
    var yValues = [ <?php echo $cnt1['active_count']; ?>, <?php echo $cnt1['inactive_count']; ?>, <?php echo $cnt1['expired_count']; ?>];
    var barColors = [
        "#1e7145",
        "#a37f4d",
        "#c72e2e"
    ];
    new Chart("SurveyChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                fontSize: 16,
                text: "Survey Status"
            }
        }
    });
    <?php if ($_SESSION['role'] != 'User') { ?>
    var xValues = [ "Active Users", "Inactive Users"];
    var yValues = [<?php echo $cnt['a_user_count'] ?>, <?php echo $cnt['user_count'] - $cnt['a_user_count']; ?>];
    var barColors = [
        "#1e7145",
        "#a37f4d"
    ];
    new Chart("UsersChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                fontSize: 16,
                text: "Users Status",
            }
        }
    });
    <?php } ?>
</script>
<?php
include 'nav_bottom.php';
?>