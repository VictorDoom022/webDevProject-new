<?php
require_once('connect_db.php');

$username = $_POST['username'];
$passwordNoEncrypt = $_POST['password'];
$position = $_POST['position'];
$email = $_POST['email'];

$password = md5($passwordNoEncrypt);

$sql = "INSERT INTO users(username, password, position, email) VALUES ('$username','$password','$position','$email')";
mysqli_query($conn, $sql);
mysqli_close($conn);
?>