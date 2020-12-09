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

$query = "SELECT * FROM product WHERE id = $product_id";
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
<div class="container mt-5">
    <div class="bg-white shadow mb-4">
        <div class="row">
            <div class="col-12 col-md-4">
                <img src="<?= $product->prdt_image ?>" alt="" class="img-fluid">
            </div>
            <div class="col-12 col-md-5">
                <div class="p-2">
                    <h4><?= $product->prdt_name ?></h4>
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
            <div class="col-12 col-md-3" style="background-color: #f7f7f7;">
                Sold By xxx
                <button class="btn">Chat</button>
            </div>
        </div>
    </div>
    <div class="bg-white shadow">
        <div class="p-2 h4 bg-secondary text-white">Produt Description</div>
        <p class="text-muted p-2">
            <?= nl2br($product->prdt_desc) ?>
        </p>
    </div>
</div>
<?php
do_html_end();