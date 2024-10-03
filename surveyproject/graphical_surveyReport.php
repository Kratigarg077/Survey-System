<?php
include 'config/connection.php';
include 'nav.php';
include 'controllers/surveycontroller.php';

$hid = $_GET['survey_id'];
$survey = new survey;
$cnt = $survey->count_invitedUser($hid);
$arr = $survey->graphReport($hid);
$attempted = isset($cnt['attempted']) ? $cnt['attempted'] : '0';
$unattempted = $cnt['invited'] - $attempted;
?>

<div class="container">
    <div class="row">
        <div class="col" style="margin-left:20%;"><?php
                                                    if ($attempted == '0' && $unattempted == '0') { ?>
                <div style="margin-left:11em; font-weight:bold; color:#1b4c94; font-size:20px;">No invited Users</div>
            <?php } ?><canvas id="UsersChart" style="width:100%;max-width:600px"></canvas>
        </div>
    </div>
    <script>
        var xValues = ["Attempted", "Not Attempted"];
        var yValues = [<?php echo $attempted ?>, <?php echo $unattempted ?>];
        var barColors = ["#00aba9", "#2b5797"];
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
                    text: "Invited Users Status"
                }
            }
        });
    </script>
    <?php
    $i = 1;
    foreach ((array)@$arr as $ques => $option) {
        $options = array();
        $count = array(); ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt-5">
            <canvas id="QuestionsChart['<?php echo ($ques) ?>']" style="width:100%;max-width:600px"></canvas>
        </div>
        <?php foreach ((array)@$option as $k => $v) {
            $options[] = $v['options'];
            $query = $survey->count_answer($v['id'], $v['options'], $hid);
            $count[] = $query;
        } ?>
        <script>
            var xValues = <?php echo !empty($options) ? json_encode($options) : '[]'; ?>;
            var yValues = <?php echo !empty($count) ? json_encode($count) : '[]'; ?>;
            var barColors = ["#00aba9", "#4e59b5", "#1e7145", "#a37f4d", "#b06310", "#b91d47", "#2b5797"];
            new Chart("QuestionsChart['<?php echo $ques ?>']", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false,
                        labels: {
                            fontColor: '#00aba9',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
                    title: {
                        display: true,
                        fontSize: 16,
                        text: "Q." + <?php echo $i++ ?> + " " + <?php echo json_encode($ques) ?>
                    }
                }
            });
        </script>
    <?php
    }
    ?>
    <?php
include 'nav_bottom.php';
?>