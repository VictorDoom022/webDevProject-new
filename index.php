<?php
require_once('config/bootstrap.php');
require_once('config/connect_db.php');
require_once('customer/layouts.php');

session_start();

do_html_head('APP NAME', $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav('APPNAME');

$query = "SELECT * FROM product;";
$result = mysqli_query($conn, $query);
if(!$result) {
    die('Error To connect db');
}else{
    $top_selling_products = array();
    
    if(mysqli_num_rows($result) > 0) {
        for($i = 0; $i < mysqli_num_rows($result); $i ++){
            $product = mysqli_fetch_assoc($result);
            array_push($top_selling_products, $product);
        }
    }
}
?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-4">
                <a href="voucher.php" class="btn btn-block bg-white py-3 btn-light shadow-sm rounded-pill">
                    <i class="fas fa-percent mr-2"></i>
                    Voucher
                </a>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <h3>Top Selling Products</h3>
        </div>
        <div class="row">
            <?php
            if(count($top_selling_products) > 0):
                foreach($top_selling_products as $product)
                    do_component_product_card($product, 'col-6 col-md-4 col-lg-3');
            ?>
            <?php else: ?>
            <div class="col-12 pt-3 d-flex justify-content-center">
                <p class="text-muted">Not have product yet</p>
            </div>
            <?php endif; ?>
        </div>
        <div class="py-4 d-flex">
            <a class="btn btn-block" href="product.php">View More</a>
        </div>
    </div>
<?php

do_html_end();
?>