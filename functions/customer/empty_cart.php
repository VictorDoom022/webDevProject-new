<?php
require_once('../../config/connect_db.php');

session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['position'])) {
    if($_SESSION['position'] == "customer") {
        $user_id = $_SESSION['user_id'];

        $query = "SELECT 
                    cart.id AS cart_id,
                    product.id AS product_id,
                    crt_quantity
                    FROM cart LEFT JOIN product ON cart.crt_product = product.id WHERE crt_user = $user_id";

        $info_result = mysqli_query($conn, $query);

        if($info_result) {
            $num_row = mysqli_num_rows($info_result);

            if($num_row > 0) {
                for($i = 0; $i < $num_row; $i++) {
                    $obj = mysqli_fetch_object($info_result);
                    $cart_id = $obj->cart_id;
                    $product_id = $obj->product_id;
                    $crt_qty = intval($obj->crt_quantity);

                    $query = "DELETE FROM cart WHERE id = $cart_id AND crt_user = $user_id;";
                    mysqli_query($conn, $query);

                    $query = "SELECT prdt_quantity FROM product WHERE id = $product_id";
                    $result = mysqli_query($conn, $query);
                    $prdt_qty = mysqli_fetch_assoc($result)['prdt_quantity'];
                    $product_quantity = intval($prdt_qty) + $crt_qty;

                    $query = "UPDATE product SET prdt_quantity = $product_quantity WHERE id = $product_id;";
                    $result = mysqli_query($conn, $query);

                    if(!$result) {
                        print_r( mysqli_error_list($conn));
                        echo '<script>alert("something wrong");</script>';
                        break;
                    }
                }
                header('location: ../../viewCart.php');
            }
        }
    }
}
echo '<script>alert("something wrong");</script>';
header('location: ../../viewCart.php');
