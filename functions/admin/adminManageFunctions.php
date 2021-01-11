<?php
session_start();

require_once('../../config/connect_db.php');

$id = 0;
$update = false;
$username = '';
$password = '';
$email = '';
$position = '';

//delete
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $query = "DELETE FROM users WHERE id='".$id."'";
    
    $result = mysqli_query($conn,$query);
    if(!$result) die ('Delete data failed');
    header("location: ../../admin/adminManageSeller.php");
}
//update
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $query = "UPDATE users SET username='$username',email = '$email' WHERE id=$id";
    $result = mysqli_query($conn,$query);
    if(!$result) die ('Update data failed');
    header("location: ../../admin/adminManageSeller.php");
}
?>