<?php
require_once('../../config/connect_db.php');
session_start();

header('Content-Type: application/json');

if(isset($_SESSION['user_id']) && isset($_SESSION['position'])) {
    if($_SESSION['position'] == 'customer') {
        $user_id = '';
        $product_id = '';
        $quantity = '';

        $query = "INSERT INTO cart(crt_user, crt_product, crt_quantity, crt_addDate) VALUES ('$user_id', '$product_id', $quantity, CURRENT_TIMESTAMP)";

        $output["status"] = 0;
        $output["msg"] = 'Added To Cart';
    }
}else {
    $output["status"] = 1;
    $output["msg"] = 'Login required';
}

echo json_encode($output);