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
            <div class="col-12 col-md-7">
                <div class="card border-0 mb-2">
                    <div class="card-header bg-white">Check Out</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php
                            $total_price = 0;
                            for($i = 0; $i < $num_row; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                $total_price += $row['prdt_sellPrice'];
                            ?>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-3">
                                        <img class="img-fluid" src="<?= $row['prdt_image'] ?>" alt="">
                                    </div>
                                    <?= $row['prdt_name'] ?>
                                    <?= $row['prdt_quantity'] ?>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="card border-0">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for=""></label>
                                <input id="" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="">Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">MYR</span>
                                    </div>
                                    <input id="" class="form-control" type="text" value="<?= number_format(floatval($total_price), 2) ?>" readonly>
                                </div>
                            </div>
                            <div class="text-right">
                                <input class="btn btn-primary" type="submit" value="Pay">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    do_html_end();
    

    
}

