<?php
require_once('../../config/connect_db.php');

session_start();

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST"){
    $cht_sender = $_POST['cht_sender'];
    $cht_receiver = $_POST['receiver_id'];
    $cht_msg = $_POST['msg'];

    $sql = "INSERT INTO chat (cht_sender, cht_receiver, cht_msg, cht_sendDate)
    VALUES ('$cht_sender', '$cht_receiver', '$cht_msg', NOW())";
    mysqli_query($conn, $sql);
}
?>