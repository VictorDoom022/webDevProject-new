<?php
session_start();

require_once('../../config/connect_db.php');

$id = 0;
$update = false;
$username = '';
$password = '';
$email = '';
$position = '';
$giveCommission = false;

//save
if(isset($_POST['give'])){
    $seller_id = $_POST['seller_id'];
    $revenue = $_POST['revenue'];
    $commission = $_POST['commission'];

    $query = "INSERT INTO commission (user_id,total_revenue,commission_rate) VALUES('$seller_id','$revenue','$commission')";
    $result = mysqli_query($conn,$query);

    if(!$result) die ('Data insert failed');
    else{
        $cms_id = mysqli_insert_id($conn);
        $updt_query = "UPDATE order_detail SET cms_id='$cms_id' WHERE seller_id = $seller_id";
        $updt_result = mysqli_query($conn,$updt_query);
        if(!$updt_result) die ('Data insert failed');
    }
    mysqli_close($conn);
    header("location: ../../admin/adminGiveCom.php");
    
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