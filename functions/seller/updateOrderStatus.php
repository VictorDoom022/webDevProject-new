<?php
require_once('../../config/connect_db.php');

session_start();

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST"){
    $ord_id = $_POST['ord_id'];
    $ord_status = $_POST['ord_status'];

    $sql = "UPDATE order_detail SET ord_status = '" . $ord_status ."' WHERE ord_id = '" . $ord_id ."'";
    mysqli_query($conn, $sql);
}
?>