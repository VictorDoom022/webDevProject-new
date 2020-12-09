<?php
session_start();

require_once('../../config/connect_db.php');

$id = 0;
$update = false;
$username = '';
$password = '';
$email = '';
$position = '';

//save
if(isset($_POST['save'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $position = $_POST['position'];

    $query = "INSERT INTO users (username,password,email,position) VALUES('$username','$password','$email','$position')";
    $result = mysqli_query($conn,$query);
    if(!$result) die ('Data insert failed');
    header("location: ../../admin/adminManageSeller.php");
    
}
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
    $password = $_POST['password'];
    $email = $_POST['email'];
    $position = $_POST['position'];

    $query = "UPDATE users SET username='$username',password = '$password',email = '$email',position = '$position' WHERE id=$id";
    $result = mysqli_query($conn,$query);
    if(!$result) die ('Update data failed');
    header("location: ../../admin/adminManageSeller.php");
}
?>