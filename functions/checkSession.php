<?php
// check if user is logged in and redirect if not logged in
// include this file after session_start();
if($_SESSION["user_id"]==null){
    header('location: ../login.php');
}
?>