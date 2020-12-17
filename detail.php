<?php
require_once('config/connect_db.php');
require_once('config/bootstrap.php');
require_once('customer/layouts.php');
session_start();

if(isset($_GET['pid'])) {
    $product_id = $_GET['pid'];
} else {
    header('location: index.php');
}

// show product detail
do_html_head('APP NAME', $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav('APP NAME');

$query = "SELECT * FROM product LEFT JOIN users ON product.prdt_seller = users.id WHERE product.id = $product_id";
$result = mysqli_query($conn, $query);

if(!$result) 
    die('Fetch Error!');
else {
    $num_row = mysqli_num_rows($result);
    if($num_row > 0) {
        $product = mysqli_fetch_object($result);
    } else {
        echo '404';
    }
}
?>
<div class="bg-white shadow" style="width: 250px;position: fixed;right: 20px;bottom: 0;">
    <div class="h4 text-center pt-2 text-primary">Message</div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-9">
            <div class="bg-white mb-3">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="m-1">
                            <img src="<?= $product->prdt_image ?>" alt="" class="img-fluid overflow-hidden">
                        </div>
                    </div>
                    <div class="col-12 col-md-7 pl-0 pr-4">
                        <div class="m-1">
                            <h3><?= $product->prdt_name ?></h3>
                            <div style="color: #fd7e14;font-size: 2rem;">
                                RM <?= number_format(floatval($product->prdt_sellPrice), 2) ?>
                            </div>
                            <input type="hidden" name="product_id" value="<?= $product_id ?>">
                            <div class="row">
                                <div class="col-3">
                                    <div class="text-muted">Quantity</div>
                                </div>
                                <div class="col-9">
                                    <div class="mb-2">
                                        <button id="minus-btn" class="btn btn-sm btn-warning" disabled>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input id="quantity" type="text" step="1" min="<?= ($product->prdt_quantity == 0) ? '0' : '1' ?>" value="<?= ($product->prdt_quantity == 0) ? '0' : '1' ?>" 
                                            max="<?= $product->prdt_quantity ?>" style="width:20px;" class="border-0 text-center">
                                        <button class="btn btn-sm btn-warning" id="add-btn" <?= ($product->prdt_quantity == 0) ? 'disabled' : '' ?>>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <span id="outStock" class="text-danger" style="font-size: 10px;"><?= ($product->prdt_quantity == 0) ? 'Out of stock' : '' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-block btn-warning text-white" id="btn-cart" <?= ($product->prdt_quantity == 0) ? 'disabled' : '' ?>>Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3">
            <div class="d-flex justify-content-between p-3" style="background-color: #fefefe;">
                <div>
                    <div class="text-muted" style="font-size: 0.7rem">Sold By</div>
                    <div><?= print_r($product->username) ?></div>
                </div>
                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-comments"></i>Chat</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="bg-white">
        <div class="p-2 h4" style="background-color: #f2f2f2;">Produt Description</div>
        <p class="text-muted p-2">
            <?= nl2br($product->prdt_desc) ?>
        </p>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $("#btn-cart").click(function() {
            event.preventDefault();
            var product_id = $('input[name="product_id"]').val();
            var quantity = $('input#quantity').val();
            $.post({
                url: 'functions/customer/addCart.php',
                data: {
                    product_id: product_id,
                    quantity: quantity,
                },
                success: function (result) {
                    if(result.status == 1) {
                        swal({
                            title: "Something Wrong!",
                            text: "To add cart, You need to login first!",
                            icon: "info",
                            buttons: true,
                        }).then((bool) => {
                            window.location.assign('login.php');
                            // window.location.assign('login.php?request_url='+ window.location.href);
                        });
                    }else if(result.status == 0){
                        $('#quantity_left').html('quantity left '+ result.quantity_left);
                        swal({
                            icon: "success",
                            title: "Success",
                            text: result.msg,
                            timer: 1100,
                            buttons: false,
                        });
                        if(result.quantity_left == 0) {
                            $('#outStock').html('Out of stock');
                            $('#btn-cart').prop('disabled', true);
                            $('#minus-btn').prop('disabled', true);
                            $('#add-btn').prop('disabled', true);
                            $('#quantity').val(0);
                        }
                    }else if(result.status == 2){
                        swal({
                            icon: "warning",
                            title: "Success",
                            text: result.msg,
                            timer: 1100,
                            buttons: false,
                        });
                    }
                }
            });
        });

        $('#add-btn').click(function() {
            var quantity =  parseInt($('#quantity').val());
            var max = parseInt($('#quantity').attr('max'));
            if(quantity < max) {
                quantity++;
                $('#quantity').val(quantity);

                if(quantity == max)
                    $(this).prop('disabled', true);
            }

            if($('#minus-btn').prop('disabled'))
                $('#minus-btn').prop('disabled', false);
        });

        $('#minus-btn').click(function() {
            var quantity =  parseInt($('#quantity').val());
            var max = parseInt($('#quantity').attr('max'));

            if(quantity > 1) {
                quantity--;
                $('#quantity').val(quantity);
            }

            if(quantity <= 1)
                $(this).prop('disabled', true);
            
            if($('#add-btn').prop('disabled'))
                $('#add-btn').prop('disabled', false);
        });
    });
</script>
<?php
do_html_end();
?>