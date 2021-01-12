<?php
require_once('./config/app.php');
require_once('./config/connect_db.php');
require_once('./config/bootstrap.php');
require_once('./customer/layouts.php');

session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header('location: login.php');
}

do_html_head($app_name, $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav($app_name);
?>
<div class="container mt-5">
    <div class="h4 text-center">Order History</div>
    <div class="row justify-content-center">
        <div class="accordion col-9" id="accordionExample">
            <?php
            $query = "SELECT id, date FROM orders WHERE ord_user_id = '$user_id' order by id desc";
            $order_result = mysqli_query($conn, $query);
            
            if($order_result) {
                $order_num_row = mysqli_num_rows($order_result);
    
                for($i = 0; $i < $order_num_row; $i++) {
                    $order_data = mysqli_fetch_assoc($order_result);
                    $order_id = $order_data['id'];
            ?>
            <div class="card shadow-sm mt-2">
                <div class="card-header bg-white p-4 border-0" id="headingOne" role="button"  data-toggle="collapse" 
                    data-target="#collapse-<?= $i ?>" aria-expanded="true" aria-controls="collapseOne">
                    <div class="d-flex justify-content-between bg-light p-3">
                        <div>Order No: <span class="font-weight-bold"><?= $order_id ?></span></div>
                        <div class="text-muted"><?= $order_data['date'] ?></div>
                    </div>
                </div>
                <div id="collapse-<?= $i ?>" class="collapse <?= ($i == 0) ? 'show' : '' ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body px-5 pt-0">
                        <h6>Order Item</h6>
                        <ul class="list-group list-group-flush border-top">
                        <?php
                        $query = "SELECT prdt_name, prdt_sellPrice, prdt_image, ord_product_quantity, ord_discount, ord_status
                            FROM order_detail 
                            LEFT JOIN product ON order_detail.ord_product_id = product.id 
                            WHERE ord_id = $order_id";
                        $order_detail_result = mysqli_query($conn, $query);
    
                        if($order_detail_result) {
                            $ord_detail_num_row = mysqli_num_rows($order_detail_result);
                            $ord_discount = 0;
                            $ord_total = 0;
                            for ($j=0; $j < $ord_detail_num_row; $j++) { 
                                $row = mysqli_fetch_assoc($order_detail_result);
                                $ord_discount += $row['ord_discount'];
                                $ord_total += $row['prdt_sellPrice'] * $row['ord_product_quantity'];
                                // print_r($row);
                        ?>
                            <li class="list-group-item pl-0 py-3">
                                <div class="d-flex">
                                    <div style="max-width: 150px;">
                                        <img src="<?= $row['prdt_image'] ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="d-flex flex-column px-3 w-100">
                                        <div class="font-weight-bold"><?= $row['prdt_name'] .' x '. $row['ord_product_quantity'] ?></div>
                                        <div><?= 'RM ' . number_format($row['prdt_sellPrice'], 2)?></div>
                                        <div><?= $row['ord_status'] ?></div>
                                    </div>
                                </div>
                            </li>
                        <?php
                            }
                        }
                        ?>
                            <li class="list-group-item pl-0 py-3">
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex flex-column w-50">
                                        <div class="font-weight-bold pb-2 d-flex justify-content-between">Order Total</div>
                                        <div class="d-flex justify-content-between">
                                            <div>Subtotal</div>
                                            <div><?= 'RM ' . number_format($ord_total, '2') ?></div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>Discount</div>
                                            <div><?= 'RM ' . number_format($ord_discount, '2') ?></div>
                                        </div>
                                        <div class="h6 d-flex justify-content-between border-top mt-2 py-1">
                                            <div>Total</div>
                                            <div><?= 'RM ' . number_format($ord_total - $ord_discount, '2') ?></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
do_html_end();