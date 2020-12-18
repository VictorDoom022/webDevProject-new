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
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Cart List</h2>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-8">
<?php
$query = "SELECT id FROM cart WHERE crt_user='$user_id'";
$result = mysqli_query($conn, $query);
if($result) {
    $total_cart = mysqli_num_rows($result);
    if($total_cart > 0) {
        $query = "SELECT 
                    cart.id AS cart_id,
                    cart.crt_addDate AS cart_time,
                    cart.crt_quantity AS quantity,
                    product.id AS product_id,
                    product.prdt_name AS product_name,
                    product.prdt_image AS product_image,
                    product.prdt_sellPrice AS product_price
                    FROM cart LEFT JOIN product ON cart.crt_product = product.id WHERE crt_user='$user_id' LIMIT 0, 5";
        $result = mysqli_query($conn, $query);

        if($result) {
            $count = $num_row = mysqli_num_rows($result);
            if($num_row > 0) {
                $sub_total = 0;

                for($i = 0; $i < $num_row; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $create_time = strtotime($row['cart_time']);

                    $sub_total += $row['product_price'] * $row['quantity'];
?>
                    <div class="card mb-3 border-0">
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-3">
                                <img src="<?= $row['product_image'] ?>" class="card-img" alt="">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <div class="d-flex font-weight-bold">
                                        <a href="detail.php?pid=<?= $row['product_id'] ?>" class="text-body"><?= $row['product_name'] ?></a>
                                        <span class="ml-auto">RM <?= number_format($row['product_price'] * $row['quantity'], '2') ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Quantity: <?= $row['quantity'] ?></small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="card-text text-right"><small class="text-muted"><?= date("m/d/Y",$create_time) ?></small></span>
                                        <button class="btn btn-sm ml-auto text-muted"><i class="fas fa-times mr-1"></i>Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
                }
            }
        }
    } else {
        echo '';
    }
}

?>
            <nav>
                <ul class="pagination justify-content-end">
                    <?php
                    $page = $total_cart / $count;
                    for($i = 1;$i <= $page; $i ++){
                    ?>
                        <li class="page-item"><a class="page-link border-0" href="#"><?= $i ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
            <hr>
            <div class="card border-0">
                <div class="card-body">
                    <form action="" method="post">
                        <label for="" class="font-weight-bold">Discount code:</label>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Enter Discount code">
                                    </div>
                                    <div class="col-auto">
                                        <input class="btn btn-dark" type="submit" value="Apply">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 mb-3">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex">
                            <span>Subtotal</span>
                            <span class="ml-auto">RM <?= $sub_total ?></span>
                        </li>
                        <li class="list-group-item d-flex">
                            <span>Total</span>
                            <span class="ml-auto">RM <?= $sub_total ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <button class="btn btn-dark btn-block">Check Out</button>
            <button class="btn btn-outline-dark btn-block">Empty Cart</button>
        </div>
    </div>
</div>
<?php
do_html_end();
?>