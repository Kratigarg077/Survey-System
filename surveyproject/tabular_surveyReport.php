<?php
include 'config/connection.php';
include 'controllers/surveycontroller.php';
include 'controllers/invitationcontroller.php';
include 'nav.php';

$hid = $_GET['survey_id'];
$survey = new survey;
$invite = new invitation;

$taken = $survey->taken_count($hid);
$invited = $survey->invitation_count($hid);
$InvitedUsers = $invite->InvitedUsers($hid);
?>
<link rel="stylesheet" href="/css/modal.css">
<!-- Export link -->
<div class="col-md-12 mr-5 p-2 head">
    <div class="float-right">
        <a href="export.php?survey_id=<?php echo $hid; ?>" class="btn ylwcolor" style="width:29vh; font-size:medium; border-radius:5px;"><i class='bx bx-download'></i> Download Report</a>
    </div>
</div>

<table id="dt" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead class="tablehead">
        <tr>
            <th class="hidden">Survey_Id</th>
            <th class="text-center">#</th>
            <th class="th-sm">User_Name

            </th>
            <th class="th-sm">User_Email

            </th>
            <th class="th-sm">Status

            </th>
            <th class="th-sm">View Details

            </th>
            <th class="th-sm">Individual Report

            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        ?>
        <?php
        if (!empty($InvitedUsers)) {
            foreach ($InvitedUsers as $row) { ?>
                <tr id=<?php echo $row['invitation_id']; ?>>
                    <th class="hidden row-data"><?php echo $hid; ?></th>
                    <th><?= $i++ ?></th>
                    <td><?= $row['invitation_to_name']; ?></td>
                    <td class="row-data"><?= $row['invitation_to_email']; ?></td>
                    <td><?= $row['status'] == "Invited" ? "Not Attempted" : "Attempted"; ?></td>
                    <td><?= $row['status'] == "Invited" ? '-' : '<button type="button" class="btn btn-default btn-sm btn-flat btncolor viewData" data-toggle="dropdown" aria-expanded="true" style=" padding:10px; font-size:medium; width:fit-content; margin-bottom:20px;" data-toggle="modal" data-target="#myModal">View Details</button>'; ?></td>
                    <td><?= $row['status'] == "Invited" ? '-' : '<a href="export.php?survey_id='.$hid.'&email='.$row['invitation_to_email'].'" class="btn btn-default btn-sm btn-flat ylwcolor" style=" padding:10px; font-size:medium; width:fit-content; margin-bottom:20px; border-radius:5px;"><i class="bx bx-download"></i>Download</a>'; ?></td>                
                </tr>
        <?php }
        } ?>
    </tbody>
</table>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bgcolor">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <ul style="font-size:15px;">
                    If type is "Radio & Comment / Mcq & Comment" but user has not filled the comment, then "" is displayed.
                    <br>
                    If type is other than "Radio & Comment / Mcq & Comment", then "N/A" is displayed.
                </ul>
                <button type="button" class="close" data-dismiss="modal" style="font-size:2rem;">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body bgcolor">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Answer_selected</th>
                            <th scope="col">Comment</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn redcolor" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dt').DataTable();
    });

    $('.viewData').click(function() {
        $('#myModal').modal('show');
        var rowId = event.target.parentNode.parentNode.id;
        //this gives id of tr whose button was clicked
        var data = document.getElementById(rowId).querySelectorAll(".row-data");
        /*returns array of all elements with 
        "row-data" class within the row with given row_id*/

        var survey_id = data[0].innerHTML;
        var email = data[1].innerHTML;
        $.ajax({
            url: "fetchUserAnswers",
            method: "POST",
            data: {
                survey_id: survey_id,
                email: email
            },
            dataType: "JSON",
            success: function(data) {
                var i = 1;
                var html = '';
                // console.log(data);
                jQuery.each(data, function(i, val) {
                    //alert( "Key: " + i + ", Value: " + val );
                    html += '<tr>';
                    html += '<th>' + (i + 1) + '</th>';
                    html += '<td class="labelcolor">' + val.question + '</td>';
                    if (val.type == 'file') {
                        html += '<td class="labelcolor"><a href="uploads/'+ val.answer +'" target="_blank">View Here</a></td>';  
                    } else {
                        html += '<td class="labelcolor">' + val.answer + '</td>';
                    }
                    var cmt = '';
                    if (val.type == 'radio_comment' || val.type == 'mcq_comment') {
                        cmt = (val.cmt != '') ? val.cmt : "-";
                    } else {
                        cmt = "N/A";
                    }
                    html += ' <td class="labelcolor">' + cmt + '</td>';
                    html += '</tr>';
                });
                $("#tbody").html(html);
            }
        })
        return false;
    });
</script>
<?php
include_once 'nav_bottom.php';
?>