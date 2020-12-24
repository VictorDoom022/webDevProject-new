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
$page_num = @$_GET['page'];

if($page_num == 0 || $page_num == 1) {
    $out_set = 0;
} else {
    $out_set = ($page_num * 5) - 5;
}

$query = "SELECT id AS total_price FROM cart WHERE crt_user='$user_id'";
$result = mysqli_query($conn, $query);

if($result) {
    $sub_total = 0;

    $total_cart = mysqli_num_rows($result);
    if($total_cart > 0) {
        $query = "SELECT 
                    cart.crt_quantity AS quantity,
                    product.prdt_sellPrice AS product_price
                    FROM cart LEFT JOIN product ON cart.crt_product = product.id WHERE crt_user='$user_id'";
        $result = mysqli_query($conn, $query);
        if($result) {
            $count = $num_row = mysqli_num_rows($result);

            for($i = 0; $i < $num_row; $i++) {
                $row = mysqli_fetch_assoc($result);
                $sub_total += $row['product_price'] * $row['quantity'];
            }
        }

        $query = "SELECT 
                    cart.id AS cart_id,
                    cart.crt_addDate AS cart_time,
                    cart.crt_quantity AS quantity,
                    product.id AS product_id,
                    product.prdt_name AS product_name,
                    product.prdt_image AS product_image,
                    product.prdt_sellPrice AS product_price
                    FROM cart LEFT JOIN product ON cart.crt_product = product.id WHERE crt_user='$user_id' LIMIT $out_set, 5";
        $result = mysqli_query($conn, $query);

        if($result) {
            $count = $num_row = mysqli_num_rows($result);
            if($num_row > 0) {
                for($i = 0; $i < $num_row; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $create_time = strtotime($row['cart_time']);
?>
                    <div class="card mb-3 border-0" id="cart-<?= $row['cart_id'] ?>">
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
                                        <button class="btn btn-sm ml-auto text-muted remove-cart-btn" data-cart_id="<?= $row['cart_id'] ?>">
                                            <i class="fas fa-times mr-1"></i>Remove
                                        </button>
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
?>
    <div class="card border-0">
        <div class="card-body text-center">
            <div class="text-center">Empty Cart</div>
            <div class="text-right"><a href="product.php" class="text-body small stretched-link">shopping now</a></div>
        </div>
    </div>
<?php
    }
}

?>
            <nav>
                <div class="justify-content-start"></div>
                <ul class="pagination justify-content-end">
                    <?php
                    $page = ceil($total_cart / 5);
                    for($i = 1;$i <= $page; $i ++){
                    ?>
                        <li class="page-item <?= ($page_num == $i || ($i == 1 && $page_num == 0)) ? 'active' : '' ?>"><a class="page-link border-0" href="<?= $_SERVER['PHP_SELF'] .'?page='. $i ?>"><?= $i ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
            <hr>
            <div class="card border-0 mb-4">
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
            <a href="functions/customer/empty_cart.php" class="btn btn-outline-dark btn-block<?= ($total_cart == 0) ? ' disabled' :'' ?>">Empty Cart</a>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('.remove-cart-btn').on('click', function() {
            var cart_id = $(this).data('cart_id');
            var url = 'functions/customer/removeCartItem.php';

            $.post({
                url: url,
                data: {
                    cart_id: cart_id,
                },
                success: function (result) {
                    if(result.status == 0) {
                        var cart_card = $('#cart-'+ cart_id).remove();
                        console.log(cart_card);
                        swal({
                            icon: "success",
                            title: "Success",
                            text: result.msg,
                            timer: 1100,
                            buttons: false,
                        });

                        if(result.cart_num == 0)
                            window.location.assign('<?= $_SERVER['PHP_SELF'] ?>');
                    }
                }
            });
        });
    });
</script>
<?php
do_html_end();
?>