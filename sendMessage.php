<?php
require_once('connect_db.php');


$cht_sender = $_POST['cht_sender'];
$cht_receiver = $_POST['cht_receiver'];
$cht_msg = $_POST['cht_msg'];

$sql = "INSERT INTO chat (cht_sender, cht_receiver, cht_msg, cht_sendDate)
VALUES ('$cht_sender', '$cht_receiver', '$cht_msg', NOW())";
mysqli_query($conn, $sql);
mysqli_close($conn);
?>  