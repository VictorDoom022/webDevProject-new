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

$query = "SELECT count(cart.id) FROM cart LEFT JOIN product ON cart.crt_product = product.id WHERE crt_user='$user_id'";
$result = mysqli_query($conn, $query);
if($result)
    $total_cart = mysqli_num_rows($result);

$query = "SELECT 
            cart.id AS cart_id,
            cart.crt_addDate AS cart_time,
            cart.crt_quantity AS quantity,
            product.prdt_name AS product_name,
            product.prdt_image AS product_image,
            product.prdt_sellPrice AS product_price
            FROM cart LEFT JOIN product ON cart.crt_product = product.id WHERE crt_user='$user_id' LIMIT 0, 10";
$result = mysqli_query($conn, $query);
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2>Cart List</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
<?php
if($result) {
    $num_row = mysqli_num_rows($result);
    if($num_row > 0) {
        for($i = 0; $i < $num_row; $i++) {
            $row = mysqli_fetch_assoc($result);
?>
            <div class="card mb-3 border-0">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="<?= $row['product_image'] ?>" class="card-img" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h4><?= $row['product_name'] ?></h4>
                            <?= $row['quantity'] ?>
                            <?= $row['cart_time'] ?>
                            <?= $row['product_price'] * $row['quantity'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
?>
        </div>
        <div class="col-md-3">
            <div class="card border-0">
                <div class="card-body">
                    
                    <button class="btn btn-warning btn-block">All Clear</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
do_html_end();
?>