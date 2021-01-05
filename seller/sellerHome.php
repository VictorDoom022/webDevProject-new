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
                        SUM(prdt_oriPrice * ord_product_quantity) AS totalOriPrice
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
                                <h3 class="text-center">RM<?php echo $row['totalSellPrice'] - $row['totalOriPrice']; ?></h3>
                            </div>
                        </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </main>
        </div>
    </div>
</body>
</html>