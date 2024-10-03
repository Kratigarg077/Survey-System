<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';

@$hid = $_GET['survey_id'];
$survey = new survey;

//fetch survey data
$qry = $survey->fetchSurvey_data($hid);
$row = mysqli_fetch_array($qry);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank You</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>
  <div class="jumbotron text-center">
    <h1 class="display-3">Thank You!!</h1>
    <br>
    <?php
    if (@$_GET['survey_id']) { ?>
      <?php if (@$row['survey_status'] == 'EXPIRED') { ?>
        <p style="color:#b51f19;"><strong>Survey already submitted and expired!!</p>
        <p style="color:#b51f19;" class="lead"><strong>We are no longer accepting responses !!</p>
      <?php } else { ?>
        <p><strong>Survey already submitted!!</p>
        <p class="lead"><strong>You can fill survey only once!!</p>
      <?php }
      ?>
    <?php } else { ?>
      <p><strong>Survey submitted successfully!!</p>
      <p class="lead"><strong>You can fill survey only once!!</p>
    <?php }
    ?>
    <hr>
  </div>
</body>
</html>