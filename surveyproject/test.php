<?php
include 'config/connection.php';
include 'controllers/usercontroller.php';
include 'nav.php';

?>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary btn-block btn-lg show" data-toggle="modal" data-target="#myModal">
        Open modal
    </button>


    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td>Mary</td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <?php
        //  foreach ((array)@$result as $key => $val) {
        ?>
        <!-- <th scope="row"><?php echo $i++ ?></th>
                <td scope="row"><?php echo $key; ?></td> -->
        <?php
        // foreach ($val as $v => $e) {
        ?>
        <!-- <td><?php echo $v; ?></td>
                    <td colspan="3"> -->
        <?php
        // foreach ($e as $q => $a) {
        ?>
        <!-- <table style="width:100%;">
                                <tr>
                                    <td style="width:34%;"><?php echo $a['question']; ?></td>
                                    <td style="width:35%;"><?php echo $a['answer']; ?></td>
                                    <?php
                                    if ($a['type'] == "radio_comment" || $a['type'] == "mcq_comment") {
                                        $cmt = (!empty($a['cmt'])) ? $a['cmt'] : "N/A";
                                    ?>
                                        <td><?php echo $cmt; ?></td>
                                    <?php } else { ?>
                                        <td>-</td>
                                    <?php }
                                    ?>
                                </tr>
                            </table> -->
        <?php
        // }
        ?>
        </td>
        </tr>
        <?php
        // }
        //             }
        ?>
<script>
    $('.show').click(function() {
        $('#myModal').modal('show');
        return false;
    });
</script>
<?php
include 'nav_bottom.php';
?>