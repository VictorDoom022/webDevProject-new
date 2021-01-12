<?php 
include_once('../config/bootstrap.php');
include_once('../config/connect_db.php');
session_start();
include_once('../functions/checkSession.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2da503c223.js" crossorigin="anonymous"></script>
</head>
<link rel="stylesheet" href="layouts/navBar.css"/>
<body>
    <?php
        $pageName = $pageTitle = 'Seller';
        include 'layouts/adminSideNav.php';  
        include 'layouts/adminTopNav.php';
        $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
        $last_day_this_month  = date('Y-m-d');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10">
                <button class="btn btn-secondary mt-2 mb-3" disabled" style="margin-left: 30%;"><?php echo $first_day_this_month . " to " . $last_day_this_month?></button>
                <table class="table border">
                        <tr>
                            <thead class="thead-dark">
                                <th>Seller ID</th>
                                <th>Seller Name</th>
                                <th>Total Revenue</th>
                                <th>Total Commission</th>
                                <th>Give Commission</th>
                            </thead>
                        </tr>
                        <?php

                        $query = "SELECT 
                        users.id AS seller_id, 
                        users.username AS seller_name,
                        SUM(order_detail.ord_discount) AS total_discount_given,
                        SUM(order_detail.ord_product_quantity * order_detail.ord_product_unit_price) AS total_sale,
                        SUM(order_detail.ord_product_quantity * product.prdt_oriPrice) AS total_cost
                        FROM users 
                        LEFT JOIN product ON users.id = product.prdt_seller
                        LEFT JOIN order_detail ON product.id = order_detail.ord_product_id
                        LEFT JOIN orders ON order_detail.ord_id = orders.id
                        WHERE position = 'seller'
                        AND order_detail.cms_id is NULL
                        AND orders.date BETWEEN '$first_day_this_month' AND '$last_day_this_month'
                        GROUP BY users.id";
                        $result = mysqli_query($conn, $query);

                        if($result){
                            $num_row = mysqli_num_rows($result);
                            for($i = 0; $i < $num_row; $i++) {
                                $row = mysqli_fetch_assoc($result);
                                $total_revenue = $row['total_sale'] - $row['total_cost'] - $row['total_discount_given'];

                                $commission = '';
                                $revenue = 0;
                                switch($total_revenue){
                                    case $total_revenue <2000:
                                        $commission = '0%';
                                        break;
                                    case $total_revenue >=2000 && $total_revenue <=2999:
                                        $revenue += ($total_revenue * 0.01);
                                        $commission = '1%';
                                        break;
                                    case $total_revenue >=3000 && $total_revenue <=3999:
                                        $revenue += ($total_revenue * 0.02);
                                        $commission = '2%';
                                        break;
                                    case $total_revenue >=4000 && $total_revenue <=4999:
                                        $revenue += ($total_revenue * 0.03);
                                        $commission = '3%';
                                        break;
                                    case $total_revenue >=5000 && $total_revenue <=5999:
                                        $revenue += ($total_revenue * 0.04);
                                        $commission = '4%';
                                        break;
                                    case $total_revenue >=6000:
                                        $revenue += ($total_revenue * 0.05);
                                        $commission = '5%';
                                        break;
                                    default:
                                    echo "";
                                }
                        ?>
                                <tr>
                                    <td>
                                        <?= $row['seller_id'] ?>
                                    </td>
                                    <td>
                                        <?= $row['seller_name'] ?>
                                    </td>
                                    <td>
                                        <?= $total_revenue ?>
                                    </td>
                                    <td>
                                        <?= $commission ?>
                                    </td>
                                    <td>
                                        <form action="adminConfirmCom.php?seller_id=<?php echo $row['seller_id']?>" method="post">
                                            <input type="hidden" name="seller_id" value="<?php echo $seller_id?>">
                                            <input type="hidden" name="revenue" value="<?php echo $total_revenue?>">
                                            <input type="hidden" name="commission" value="<?php echo $commission?>">
                                            <?php if($commission == '0%' && $total_revenue < 2000):?>
                                            <p class="text-danger" value="NO" aria-label="Disabled">Not qualified</p>
                                            <?php else: ?>
                                                <input type="submit" class="btn btn-outline-success" value="Confirm">
                                            <?php endif;?>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                </table>
            </main>
        </div>
    </div>
</body>
</html>