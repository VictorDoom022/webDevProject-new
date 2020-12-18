<?php
require_once('data_valid_functions.php');
require_once('../config/connect_db.php');
require_once('user_auth_function.php');

session_start();

$username = $_POST['username'];


if(empty($_POST['username'])){
    $_SESSION['reset_error'] = "Please enter your username";
    header("location: forgot_password.php");
}else{
        try{
            $password = reset_password($username);
            notify_password($username, $password);
            echo 'Your new password has been emailed to you. <br>';
        }catch(Exception $e) {
            echo '';
            $_SESSION['reset_error'] = "Your password could not be reset - please try again later.";
            header("location: forgot_password.php");
        
        }
}


?>