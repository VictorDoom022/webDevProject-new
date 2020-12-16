<?php
require_once('../../config/connect_db.php');
session_start();

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && $_SERVER['REQUEST_METHOD'] == "POST") {
    header('Content-Type: application/json');
    $output = array();

    if(isset($_SESSION['user_id']) && isset($_SESSION['position'])) {
        if(isset($_POST['product_id']) && isset($_POST['quantity'])) {
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            if($_SESSION['position'] == 'customer') {
                $user_id = $_SESSION['user_id'];
                // check product exist or not
                $query = "SELECT id, prdt_quantity FROM product WHERE id = $product_id";
                $result = mysqli_query($conn, $query);
                if($result) {
                    $num_row = mysqli_num_rows($result);
                    if($num_row == 1) {
                        $product = mysqli_fetch_object($result);

                        if($product->prdt_quantity == 0) {
                            $output['status'] = 2;
                            $output['msg'] = 'What are you doing --! (The Product Out of sales)';
                        } else {
                            $quantity_left = $product->prdt_quantity - $quantity;
    
                            // add to cart
                            $query = "INSERT INTO cart(crt_user, crt_product, crt_quantity, crt_addDate) VALUES ('$user_id', '$product_id', $quantity, CURRENT_TIMESTAMP)";
                            $result = mysqli_query($conn, $query);
                            // munis product quantity
                            if($result) {
                                $query = "UPDATE product SET prdt_quantity = $quantity_left  WHERE id = '$product_id'";
                                $result = mysqli_query($conn, $query);
                                if($result) {
                                    $output["status"] = 0;
                                    $output["msg"] = 'Added To Cart';
                                    $output["quantity_left"] = $quantity_left;
                                }

                                $conn->close();
                            }

                        }
                    }
                } else {
                    $output['status'] = 2;
                    $output['msg'] = 'Product do not exist';
                }
            }
        } else {
            $output['status'] = 2;
            $output['msg'] = 'Something wrong (Can not get the request product)';
        }
    }else {
        $output["status"] = 1;
        $output["msg"] = 'Login required';
    }
    
    echo json_encode($output);
}

// header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");