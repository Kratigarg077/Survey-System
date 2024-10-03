<?php
include 'config/connection.php';
include 'controllers/usercontroller.php';
include 'nav.php';
?>

<link rel="stylesheet" href="/css/modal.css">
<link rel="stylesheet" href="/css/button.css">
<div class="col-lg-12" style="margin-top: 60px;">
    <?php
    if (@$_SESSION['new_user'] == 1) {
    ?>
        <div id="msg" class="alert alert-success" role="alert" style="text-align:center;">
            User Created Successfully!!
        </div>
    <?php
        $_SESSION['new_user'] = 0;
    }
    if (@$_SESSION['delete_user'] == 1) {
    ?>
        <div id="msg2" class="alert alert-danger" role="alert" style="text-align:center;">
            User Deleted Successfully!!
        </div>
        <!-- <p id="msg2" style="color:black; background-color :#cc5a5a; width:20%; margin-left: 20vh;">User Deleted Successfully!!</p> -->
    <?php
        $_SESSION['delete_user'] = 0;
    }
    ?>
    <div class="card card-outline card-primary bgcolor" style="margin: auto; background-color: #96c9d9;">
        <div class="card-header bgcolor" style="margin-bottom: 30px;">
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-default btn-flat ylwcolor" href="new_user.php"><b><i class="bx bx-plus "></i> Add New User</b></a>
            </div>
        </div>
        <div class="card-body">
            <table id="dt" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead class="tablehead">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="th-sm">Name

                        </th>
                        <th class="th-sm">Contact

                        </th>
                        <th class="th-sm">Gender

                        </th>
                        <th class="th-sm">Role

                        </th>
                        <th class="th-sm">Email

                        </th>
                        <th class="th-sm">Action

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $user = new user;
                    $qry = $user->user_data();
                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <th class="text-center"><?php echo $i++ ?></th>
                            <td><?php echo ucwords($row['User_name']) ?></td>
                            <td><?php echo $row['Contact_number'] ?></td>
                            <td><?php echo $row['User_gender'] ?></td>
                            <td><?php echo $row['User_role'] ?></td>
                            <td><?php echo $row['User_email'] ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat wave-effect text-info dropdown-toggle btncolor" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu" style="background-color: #e3e1e1; border-radius:12px;">
                                    <a class="dropdown-item view_user" href="user_profile.php?User_id=<?php echo $row['User_id']; ?>	">View</a>
                                    <!-- <a class="dropdown-item" href="./index.php?page=edit_user&id=<?php echo $row['id'] ?>">Edit</a> -->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete-confirm" href="deleteuser.php?User_id=<?php echo $row['User_id']; ?>" data-toggle="modal" data-target="#exampleModal">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#
                        </th>
                        <th>Name
                        </th>
                        <th>Contact
                        </th>
                        <th>Gender
                        </th>
                        <th>Role
                        </th>
                        <th>Email
                        </th>
                        <th>Action
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-confirm" role="document">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <h4 class="modal-title" id="exampleModalLabel">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to delete the user? This process cannot be undone.
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn bluecolor" data-dismiss="modal" style="font-size:small;">Cancel</button>
                    <a class="delete-yes"><button type="button" class="btn btn-danger" style="font-size:small;  background-color: #b43d3d !important; color: white; width: 8vh; height: 4vh; border:none; border-radius:5px;">Delete</button></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dt').DataTable();
        });

        $('.delete-confirm').click(function() {
                $('#exampleModal').modal('show');
                var deleteUrl = $(this).attr('href');
            $(".delete-yes").attr('href', deleteUrl);
            return false;
            });

        setTimeout(() => {
            $('#msg').css('display', 'none');
            // const box = document.getElementById('msg');

            // 👇️ removes element from DOM
            // box.style.display = 'none';

            // 👇️ hides element (still takes up space on page)
            //   box.style.visibility = 'hidden';
        }, 3000); // 👈️ time in milliseconds

        setTimeout(() => {
            $('#msg2').css('display', 'none');
        }, 3000);     
    </script>

    <?php
    include 'nav_bottom.php';
    ?>