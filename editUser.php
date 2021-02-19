<?php
require_once('connect_db.php');

$id = $_POST['id'];
$username = $_POST['username'];
$passwordNoEncrypt = $_POST['password'];
$position = $_POST['position'];
$email = $_POST['email'];

$password = md5($passwordNoEncrypt);

$sql = "UPDATE users SET username = '$username', password = '$password', position = '$position', email = '$email' WHERE id = '$id'";
mysqli_query($conn, $sql);
mysqli_close($conn);
?>