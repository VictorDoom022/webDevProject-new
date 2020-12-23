<?php
require_once('../../config/connect_db.php');
session_start();

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
    $_SERVER['REQUEST_METHOD'] == "POST") {

    header('Content-Type: application/json');
    $output = array();

    if(isset($_SESSION['user_id']) && isset($_SESSION['position']) && isset($_POST['cart_id'])) {
        if($_SESSION['position'] == 'customer') {
            $user_id = $_SESSION['user_id'];
            $cart_id = $_POST['cart_id'];

            $query = "SELECT crt_quantity, prdt_quantity FROM cart LEFT JOIN product ON cart.crt_product = product.id WHERE id = $cart_id AND crt_user = $user_id";
            $result = mysqli_query($conn, $query);
            if($result) {
                $product_quantity = mysqli_fetch_object($result)->crt_quantity;
                $output['quantity'] = $product_quantity;
            }
            $query = "DELETE FROM cart WHERE id = $cart_id AND crt_user = $user_id";
            $result = mysqli_query($conn, $query);

            if($result) {
                $output['status'] = 0;
                $output['msg'] = 'Item Remove Success';

                // $query = "";
                // $result = mysqli_query($conn, $query);
            } else {
                $output['status'] = 1;
                $output['msg'] = 'Some thing error (DB connect error)';
            }
        }
    }
    echo json_encode($output);
} else {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
}
