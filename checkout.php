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
                                            <input id="product_id" class="product_id" type="hidden" value="<?= $row['product_id'] ?>">
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
                        <form action="functions/customer/placeorder.php" method="post">
                            <div class="d-flex justify-content-between my-2">
                                <div class="small text-muted">Subtotal (<?= $num_row ?> items)</div>
                                <div>RM <?= number_format(floatval($total_price), 2) ?></div>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <input id="promo_code" class="form-control" type="text" placeholder="Enter Promo Code">
                                <button type="button" class="btn btn-dark ml-2">Apply</button>
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <div class="small text-muted">Total</div>
                                <div style="color: #ff9326;"><p id="total"><?= number_format(floatval($total_price), 2) ?></p></div>
                                <div class="small text-muted">Discount Total</div>
                                <div class="text-success">
                                    <p id="discount_total" name="discount_total">0</p>
                                </div>
                            </div>
                            <div class="my-2">
                                <input class="btn btn-warning btn-block" style="background-color: #ff9326;" type="submit" value="Place Order">
                            </div>
                        </form>
                    </div>
                </div>
                <a href="viewCart.php" class="btn-link"><i class="fas fa-arrow-left my-2"></i> Back</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('#promo_code').on('change', function(){
            $.ajax({
                url: 'functions/checkVoucher.php',
                type: 'GET',
                data: { 'promo_code' : this.value },
                success: function(data){
                    var parsedData = JSON.parse(data);
                    var promo_total = 0;

                    if(parsedData.voucherExists == "1"){
                        $('#promo_code').attr('class', 'form-control is-valid');
                        var product_ids =[];

                        $('.product_id').each(function(value){
                            product_ids.push($(this).val());
                        });
                        
                        for($i = 0; $i <product_ids.length; $i++){
                            if(product_ids[$i] == parsedData.promo_prdt){
                                promo_total += parseInt(parsedData.promo_discount);
                            }
                        }
                        
                        $('#discount_total').text(promo_total);
                        total_value = parseFloat($('#total').text())-promo_total;
                        if(total_value < 0){
                            total_value = 0;
                        }
                        $('#total').text(total_value);

                    }else{
                        $('#promo_code').attr('class', 'form-control is-invalid');
                    }

                },
                error: function(){

                }
            });
        });
    </script>
    <?php
    do_html_end();
}

