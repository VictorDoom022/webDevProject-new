<?php
require_once('../config/connect_db.php');

session_start();

header('Content-Type: application/json');

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
    $_SERVER['REQUEST_METHOD'] == "POST"){

    $sender = $_POST['sender_id'];
    $receiver = $_POST['receiver_id'];
    $msg = $_POST['msg'];

    $sql = "INSERT INTO chat (cht_sender, cht_receiver, cht_msg, cht_sendDate)
        VALUES ('$sender', '$receiver', '$msg', NOW())";
    mysqli_query($conn, $sql);
}
?>