<?php
require_once('config/connect_db.php');
require_once('config/bootstrap.php');
require_once('customer/layouts.php');

session_start();
if(!isset($_SESSION['user_id'])) {
    header('location: login.php');
}

$user_id = $_SESSION['user_id'];

do_html_head('Apple', $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav('Apple');


$query = "SELECT 
            cart.id AS cart_id,
            cart.crt_addDate AS cart_time,
            cart.crt_quantity AS quantity,
            product.prdt_name AS product_name,
            product.prdt_sellPrice AS product_price
            FROM cart LEFT JOIN product ON cart.crt_product = product.id WHERE crt_user='$user_id'";
$result = mysqli_query($conn, $query);
?>
<div class="container mt-4">
<?php
if($result) {
    $num_row = mysqli_num_rows($result);
    if($num_row > 0) {
        for($i = 0; $i < $num_row; $i++) {
            $row = mysqli_fetch_assoc($result);
?>
    <div class="card mb-3 border-0">
        <div class="card-body">
            <?= $row['product_name'] ?>
            <?= $row['quantity'] ?>
            <?= $row['cart_time'] ?>
            <?= $row['product_price'] * $row['quantity'] ?>
        </div>
    </div>
<?php
        }
    }
}
?>
</div>
<?php
do_html_end();
?>