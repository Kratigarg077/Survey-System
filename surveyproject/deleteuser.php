
<?php
include 'config/connection.php';
include 'controllers/usercontroller.php';
session_start();
$user = new user;
$id = $_GET['User_id'];
// echo $id; die;
$qry = $user->delete($id);
?>