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
                            <div class="row">
                                <div class="col-3">
                                    <div class="text-muted">Quantity</div>
                                </div>
                                <div class="col-9">
                                    <div class="mb-2">
                                        <button class="btn btn-sm btn-warning">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text" step="1" min="1" value="1" style="width:20px;" class="border-0 text-center">
                                        <button class="btn btn-sm btn-warning">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-block btn-warning text-white">Add To Cart</button>
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
<?php
do_html_end();
?>