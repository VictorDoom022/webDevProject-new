<?php

$conn = mysqli_connect("localhost","root","","webdevnew");

if(isset($_POST["submit"])){
	$username = $_POST["username"];
	$password = $_POST["password"];

	$sql = mysqli_query($conn,"SELECT count(*) as total FROM users WHERE username = '".$username."' and password = '".$password."'")or die(
		mysqli_error($conn));

	$rw = mysqli_fetch_array($sql);
    
        
    if(empty($_POST["username"]) && empty($_POST["password"]) && empty($_POST["term"])){
        echo"Please Enter username and password";
    }else if(empty($_POST["username"])){
        echo"Please Enter Username";
    }else if(empty($_POST["password"])){
        echo"Please Enter Password";
    }else if(isset($_POST["username"]) && isset($_POST["password"]) && empty($_POST["term"])){
        echo"<script>alert('Please read the FKing TERM')</script>";
    }else{
        if($rw['total']>0){
            echo"user name and password are Correct";   
        }else{
            echo"Wrong pass";
        }
    }
}
?>



<a href="login.php">back</a>