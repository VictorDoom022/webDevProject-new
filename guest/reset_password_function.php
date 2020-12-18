<?php
require_once('data_valid_functions.php');
require_once('../config/connect_db.php');
require_once('user_auth_function.php');

session_start();

$username = $_POST['username'];

try{
    $password = reset_password($username);
    notify_password($username, $password);
    echo 'Your new password has been emailed to you. <br>';
}catch(Exception $e) {
    echo 'Your password could not be reset - please try again later.';
}
?>