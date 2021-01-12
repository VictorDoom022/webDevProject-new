<?php
include_once('../config/bootstrap.php');
require_once('../config/connect_db.php');
session_start();
include_once('../functions/checkSession.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <?php echo $bootstrapCSS; echo $jQueryJS; echo $bootstrapJS; echo $fontAwsomeIcons ?>
</head>
    <link rel="stylesheet" href="layouts/navBar.css"/>
<body>
    <?php
        $pageName = $pageTitle = 'Home';
        include 'layouts/sellerSideNav.php';
        include 'layouts/sellerTopNav.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-1">
                            <div class="card-text">
                                <h1 class="text-center">Welcome, <?php echo $_SESSION['username']; ?></h1>
                            </div>
                        </div>
                    </div>

                    <?php
                        $sql = "SELECT COUNT(*) AS totalOrders, orders.date,
                        SUM(ord_product_unit_price * ord_product_quantity) AS totalSellPrice,
                        SUM(prdt_oriPrice * ord_product_quantity) AS totalOriPrice,
                        SUM(ord_discount) AS totalDiscount
                        FROM orders 
                        LEFT JOIN order_detail ON orders.id = order_detail.ord_id 
                        LEFT JOIN product ON ord_product_id = product.id
                        LEFT JOIN users ON users.id = orders.ord_user_id
                        WHERE orders.date >= (NOW()- INTERVAL 7 DAY) AND product.prdt_seller = '" .$_SESSION["user_id"]."'";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <div class="col-md-6">
                            <div class="card mt-1">
                                <h3 class="text-center">This week's total order</h3>
                                <h3 class="text-center"><?php echo $row['totalOrders']; ?></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mt-1">
                                <h3 class="text-center">This week's total revenue</h3>
                                <h3 class="text-center">RM<?php echo $row['totalSellPrice'] - $row['totalOriPrice'] - $row['totalDiscount'] ?></h3>
                            </div>
                        </div>
                    <?php
                            }
                        }
                    ?>
                    <?php
                        $sql = "SELECT * FROM commission
                        LEFT JOIN users ON users.id = commission.user_id
                        WHERE commission.user_id='".$_SESSION["user_id"]."'
                        ORDER BY commission.commission_date DESC LIMIT 1 ";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <div class="col-md-12">
                            <div class="card mt-1" style="cursor:pointer" data-toggle="modal" data-target="#commissionModal">
                                <h3 class="text-center">Received Commission</h3>
                                <h3 class="text-center text-success">RM<?php echo ($row['total_revenue'] * ($row['commission_rate'])/100)?></h3>
                                <h6 class="text-center text-muted">Given on: <?php echo $row['commission_date']; ?></h6>
                                <p class="text-left text-muted ml-2 mb-0 font-weight-lighter" style="font-size: 13px;">Click to view history</p>
                            </div>
                        </div>
                    <?php
                            }
                        }
                    ?>
                    <div class="modal fade" id="commissionModal" tabindex="-1" aria-labelledby="commissionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header py-2">
                                    <h5 class="modal-title" id="commissionModalLabel">Commission History</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                                $sql = "SELECT * FROM commission
                                                LEFT JOIN users ON users.id = commission.user_id
                                                WHERE commission.user_id='".$_SESSION["user_id"]."'
                                                ORDER BY commission.commission_date DESC";
                                                $result = mysqli_query($conn, $sql);
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <div class="card mb-1">
                                                <div class="card-body px-1 py-1">
                                                    <div class="font-weight-lighter">
                                                        <h3 class="text-success">
                                                            RM<?php echo ($row['total_revenue'] * ($row['commission_rate'])/100)?>
                                                        </h3>
                                                        <h6 class="text-muted" style="font-size:13px;">
                                                            Given on: <?php echo $row['commission_date']; ?>
                                                        </h6>   
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
                                <div class="modal-footer py-1">
                                    <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>