<?php

require_once('data_valid_functions.php');
require_once('../config/connect_db.php');

session_start();

$conn = mysqli_connect('localhost','root','');

mysqli_select_db($conn,'webdevnew');

$name = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$position = $_POST['position'];

$s = " SELECT * FROM users WHERE username = '$name'";

$result = mysqli_query($conn,$s);

$num = mysqli_num_rows($result);

unset($_SESSION['error']);
unset($_SESSION['success']);

if($num == 1){
    $_SESSION['register_error'] = "Username has taken";
    header("location: register.php");
}else if(empty($_POST["username"])){
    $_SESSION['register_error'] = "Please enter your Username";
    header("location: register.php");
}else if(empty($_POST["password"]) || empty($_POST["password2"])){
    $_SESSION['register_error'] = "Please Enter Password";
    header("location: register.php");
}else if(!valid_email($email)){
    $_SESSION['register_error'] = "Email address is not valid - Please Try another email address";
    header("location: register.php");
}else if($password != $password2){
    $_SESSION['register_error'] = "Password you entered do not match - Please Try Again";
    header("location: register.php");
}else if(empty($_POST["email"])){
    $_SESSION['register_error'] = "Please Enter Email";
    header("location: register.php");
}else if ($position == ''){
    echo"Please Enter Position";
}else if(isset($_POST["username"]) && isset($_POST["password"]) && empty($_POST["term"])){
    echo"<script>alert('Please read the FKing TERM')</script>";
}else{
    $reg = "INSERT INTO users(username,password,email,position) VALUES('$name',md5('$password'),'$email','$position')";
    mysqli_query($conn,$reg);
    $_SESSION['success'] = "Registration Successful - You may login now !";
    unset($_SESSION['error']);
    header("location: ../login.php");
}
?>
<a href="register.php">back</a>