<?php

SESSION_START();

require_once('data_valid_functions.php');

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

if($num == 1){
    echo"Username Already Taken";
}else if(empty($_POST["username"])){
    echo"Please Enter Username";
}else if(empty($_POST["password"])){
    echo"Please Enter Password";
}else if(empty($_POST["password2"])){
    echo"Please Enter Password";
}else if(!valid_email($email)){
    echo "Email address is not valid - Please Try another email address";
}else if($password != $password2){
    echo "Password you entered do not match - Please Try Again";
}else if(empty($_POST["email"])){
    echo"Please Enter Email";
}else if ($position == ''){
    echo"Please Enter Position";
}else if(isset($_POST["username"]) && isset($_POST["password"]) && empty($_POST["term"])){
    echo"<script>alert('Please read the FKing TERM')</script>";
}else{
    $reg = "INSERT INTO users(username,password,email,position) VALUES('$name','$password','$email','$position')";
    mysqli_query($conn,$reg);
    echo"Registration Successful";
}
?>
<a href="register.php">back</a>