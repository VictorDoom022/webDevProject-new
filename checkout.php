<?php
require_once('config/connect_db.php');
require_once('config/bootstrap.php');
require_once('customer/layouts.php');

session_start();

if(empty($_SESSION['user_id'])) {
    header('location: index.php');
}

$user_id = $_SESSION['user_id'];

$query = "SELECT 
    cart.id AS cart_id,
    product.id AS product_id,
    prdt_name,
    prdt_image,
    prdt_sellPrice,
    crt_quantity,
    prdt_quantity 
    FROM cart LEFT JOIN product ON cart.crt_product = product.id WHERE crt_user = $user_id";

$result = mysqli_query($conn, $query);

if($result) {
    do_html_head('Apple', $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
    do_component_topnav('Apple');

    $num_row = mysqli_num_rows($result);
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card border-0 mb-2">
                    <div class="card-header bg-white">Product List</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-light">
                                <div class="row">
                                    <div class="col-8">Item</div>
                                    <div class="col-2">Price</div>
                                    <div class="col-2 text-right">Quantity</div>
                                </div>
                            </li>
                            <?php
                            $total_price = 0;
                            for($i = 0; $i < $num_row; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                $total_price += $row['prdt_sellPrice'];
                            ?>
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <img class="img-fluid" src="<?= $row['prdt_image'] ?>" alt="">
                                            </div>
                                            <div class="col-9"><?= $row['prdt_name'] ?></div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        RM <?= number_format($row['prdt_sellPrice'], 2) ?>
                                    </div>
                                    <div class="col-1">
                                        <?= $row['crt_quantity'] ?>
                                    </div>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-0">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="d-flex justify-content-between my-2">
                                <div class="small text-muted">Subtotal (<?= $num_row ?> items)</div>
                                <div>RM <?= number_format(floatval($total_price), 2) ?></div>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <input id="" class="form-control" type="text" placeholder="Enter Promo Code">
                                <button class="btn btn-dark ml-2">Apply</button>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <div class="small text-muted">Total</div>
                                <div style="color: #ff9326;">RM <?= number_format(floatval($total_price), 2) ?></div>
                            </div>
                            <div class="my-2">
                                <input class="btn btn-warning btn-block" style="background-color: #ff9326;" type="submit" value="Place Order">
                            </div>
                        </form>
                    </div>
                </div>
                <a href="viewCart.php" class="btn-link"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>

    <?php
    do_html_end();
    

    
}

