<?php
require_once('connect_db.php');

$sellerID = $_POST['sellerID'];

$sql = "SELECT COUNT(*) AS totalOrders,
SUM(ord_product_unit_price * ord_product_quantity) AS totalSellPrice,
SUM(prdt_oriPrice * ord_product_quantity) AS totalOriPrice,
SUM(ord_discount) AS totalDiscount
FROM orders 
LEFT JOIN order_detail ON orders.id = order_detail.ord_id 
LEFT JOIN product ON ord_product_id = product.id
LEFT JOIN users ON users.id = orders.ord_user_id
WHERE orders.date >= (NOW()- INTERVAL 7 DAY) AND product.prdt_seller = '$sellerID'";
$result = mysqli_query($conn, $sql);

$data = array();

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
}

echo json_encode($data);
?>