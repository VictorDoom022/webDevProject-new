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
    <?php echo $bootstrapCSS; echo $jQueryJS; echo $sweetAlert ;echo $bootstrapJS; echo $fontAwsomeIcons ?>
</head>
    <link rel="stylesheet" href="layouts/navBar.css"/>
<body>
    <?php
        $pageName = $pageTitle = 'Report';
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
                            <table class="table table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Price (Ori Price)</th>
                                        <th>Product Price (Sell Price)</th>
                                        <th>Quantity</th>
                                        <th>Total RM (Sell Price x Quantity)</th>
                                    </tr>
                                </thead>
                                <?php
                                    $sql="SELECT product.prdt_name, product.prdt_oriPrice, product.prdt_sellPrice, order_detail.ord_product_quantity, users.id
                                    FROM orders
                                    LEFT JOIN order_detail ON orders.id = order_detail.ord_id
                                    LEFT JOIN product ON order_detail.ord_product_id = product.id
                                    LEFT JOIN users ON prdt_seller = users.id
                                    WHERE users.id = '" .$_SESSION["user_id"]."'";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                    <td><?php echo $row['prdt_name']; ?></td>
                                    <td><?php echo $row['prdt_oriPrice']; ?></td>
                                    <td><?php echo $row['prdt_sellPrice']; ?></td>
                                    <td><?php echo $row['ord_product_quantity']; ?></td>
                                    <td style="text-align: right;"><?php echo ($row['prdt_sellPrice'] * $row['ord_product_quantity']); ?></td>
                                </tr>
                                <?php
                                        }
                                    }
                                ?>
                                <tr>
                                <?php
                                    $sql = "SELECT SUM(ord_product_unit_price * ord_product_quantity) AS total
                                    FROM orders 
                                    LEFT JOIN order_detail ON orders.id = order_detail.ord_id
                                    LEFT JOIN users ON orders.ord_user_id = users.id
                                    LEFT JOIN product ON order_detail.ord_product_id = product.id
                                    WHERE prdt_seller = '" .$_SESSION["user_id"]."'";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <td colspan="4" style="font-weight: bold">Total:</td>
                                    <td style="font-weight: bold; text-align:right"><?php echo $row['total']; ?></td>
                                <?php
                                        }
                                    }
                                ?>
                                </tr>
                            
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>