<?php
require_once('../../config/connect_db.php');

session_start();

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['user_id']) && isset($_POST['position']) ) {
    $user_id = $_POST['user_id'];
    $ord_discount = $_POST['ord_discount'];

    if(!($_POST['position'] == 'customer')) {
        header('location: ../../index.php');
    }

    $query = "INSERT INTO orders(ord_user_id) VALUES ($user_id)";

    $order_result = mysqli_query($conn, $query);
    if($order_result) {
        $order_id = mysqli_insert_id($conn);

        $query = "SELECT 
        cart.id AS cart_id,
        product.id AS product_id,
        prdt_name,
        prdt_sellPrice,
        crt_quantity,
        prdt_quantity,
        product.prdt_seller AS seller_id
        FROM cart LEFT JOIN product ON cart.crt_product = product.id WHERE crt_user = $user_id";
    
        $cart_result = mysqli_query($conn, $query);
        if($cart_result) {
            $cart_num_row = mysqli_num_rows($cart_result);
    
            for ($i=0; $i < $cart_num_row; $i++) { 
                $cart = mysqli_fetch_assoc($cart_result);

                $cart_id = $cart['cart_id'];

                $product_id = $cart['product_id'];
                $product_name = $cart['prdt_name'];
                $product_quantity = $cart['crt_quantity'];
                $product_unitprice = $cart['prdt_sellPrice'];
                
                $seller_id = $cart['seller_id'];

                $query = "INSERT INTO 
                        order_detail
                        (ord_id, ord_product_id, seller_id, ord_product_name, ord_product_quantity, ord_product_unit_price, ord_discount, ord_status) 
                        VALUES 
                        ($order_id, $product_id, $seller_id, '$product_name', $product_quantity, $product_unitprice, $ord_discount, 'payed')";

                $detail_result = mysqli_query($conn, $query);
                if(!$detail_result) {
                    echo "<script>alert('error occurs')</script>";
                    break;
                }

                // remove item form cart
                $query = "DELETE FROM cart WHERE id = $cart_id";
                $remove_cart_result = mysqli_query($conn, $query);
                if(!$remove_cart_result) {
                    echo "<script>alert('error occurs')</script>";
                    break;
                }
            }
        }
        $query = "DELETE";
    } else {
        die("insert order Error");
    }

}

?>