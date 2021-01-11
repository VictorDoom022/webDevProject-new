<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="layouts/navBar.css"/>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2da503c223.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include_once('../config/bootstrap.php');
        include_once('../config/connect_db.php');
        session_start();
        include_once('../functions/checkSession.php');

        $pageName = $pageTitle = 'Seller';
        include 'layouts/adminSideNav.php';
        include 'layouts/adminTopNav.php';

        if(isset($_GET['seller_id'])){
            $seller_id = $_GET['seller_id'];
            $revenue = $_POST['revenue'];
            $commission = $_POST['commission'];
            $sql = "SELECT 
            users.id AS seller_id, 
            users.username AS seller_name,
            SUM(order_detail.ord_discount) AS total_discount_given,
            SUM(order_detail.ord_product_quantity * order_detail.ord_product_unit_price) AS total_sale,
            SUM(order_detail.ord_product_quantity * product.prdt_oriPrice) AS total_cost
            FROM users 
            LEFT JOIN product ON users.id = product.prdt_seller
            LEFT JOIN order_detail ON product.id = order_detail.ord_product_id
            LEFT JOIN orders ON order_detail.ord_id = orders.id
            WHERE 
            users.id = '$seller_id' AND
            position = 'seller'
            AND orders.date BETWEEN '2021-01-01' AND '2021-01-31'
            GROUP BY users.id";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
                    $seller_id = $row['seller_id'];
                    $revenue = $row['total_sale'] - $row['total_cost'] - $row['total_discount_given'];

                    $commission = '0%';
                    switch($revenue){
                        case $revenue <2000:
                            $commission = '0%';
                            break;
                        case $revenue >=2000 && $revenue <=2999:
                            $revenue += ($revenue * 0.01);
                            $commission = '1%';
                            break;
                        case $revenue >=3000 && $total_revenue <=3999:
                            $revenue += ($revenue * 0.02);
                            $commission = '2%';
                            break;
                        case $revenue >=4000 && $revenue <=4999:
                            $revenue += ($revenue * 0.03);
                            $commission = '3%';
                            break;
                        case $revenue >=5000 && $revenue <=5999:
                            $revenue += ($revenue * 0.04);
                            $commission = '4%';
                            break;
                        case $revenue >=6000:
                            $revenue += ($revenue * 0.05);
                            $commission = '5%';
                            break;
                        default:
                        echo "";
                    }
                }
            }
        }

        ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10">
                <form action="../functions/admin/adminManageFunctions.php" method="POST">
                    <table class="table">
                        <thead class="thead-dark ">
                            <tr>
                                
                                <th style="text-align:center;">Are you sure to give commission?</th>
                                <input type="hidden" name="seller_id" value="<?php echo $seller_id?>">
                                <input type="text" name="revenue" value="<?php echo $revenue?>">
                                <input type="text" name="commission" value="<?php echo $commission?>">
                            </tr>
                            <tr class="border">
                                <td style="text-align:center;">
                                    <a href="adminGiveCom.php" class="btn btn-outline-danger">Cancel</a>
                                    <button type="submit" name="give" class="btn btn-outline-primary">Yes</button>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </form>
            </main>
        </div>
    </div>
</body>
</html>