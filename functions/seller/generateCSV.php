<?php

require_once('../../config/connect_db.php');

session_start();

$sql = "SELECT 
        product.prdt_name, product.prdt_oriPrice, product.prdt_sellPrice, order_detail.ord_product_quantity, users.id
        FROM orders 
        LEFT JOIN order_detail ON orders.id = order_detail.ord_id
        LEFT JOIN users ON orders.ord_user_id = users.id
        LEFT JOIN product ON order_detail.ord_product_id = product.id
        WHERE prdt_seller = '" .$_SESSION["user_id"]."'";

$result = mysqli_query($conn, $sql);

$fp = fopen('file.csv', 'w');
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    print_r($row);
    fputcsv($fp, $row);
}

fclose($fp);
?>