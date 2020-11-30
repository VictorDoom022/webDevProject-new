<?php
include_once('../config/bootstrap.php');
require_once('../config/connect_db.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php echo $bootstrapCSS; echo $jQueryJS; echo $bootstrapJS; echo $fontAwsomeIcons ?>
</head>
    <link rel="stylesheet" href="layouts/navBar.css"/>
<body>
    <?php
        $pageName = $pageTitle = 'Promo';
        include 'layouts/sellerSideNav.php';
        include 'layouts/sellerTopNav.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10">
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <a href="sellerAddPromo.php" class="btn btn-sm btn btn-outline-dark btn-block" style="border-radius: 0px ;">Add Promo Code</a>
                    </div>

                    <div class="col-md-12 mt-2">
                        <div class="card border-dark">
                            <div class="card-header border-dark bg-dark text-white">
                                Lists of Promo Code
                            </div>
                            
                            <div class="row">
                                <?php
                                    $sql = "SELECT * FROM promo LEFT JOIN product ON promo.promo_prdt = product.id WHERE promo_seller = '".$_SESSION["user_id"]."'";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <div class="col-md-3 mx-2 my-2">
                                        <div class="card border-dark">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?php echo $row['promo_code']; ?>
                                                </h5>
                                            
                                                <div class="card-text">
                                                    Start Date: <?php echo $row['promo_startDate']; ?> <br>
                                                    Due Date: <?php echo $row['promo_dueDate'] ?> <br>
                                                    Promo Product: <?php echo $row['prdt_name']; ?> <br>
                                                    Promo Discount: <?php echo $row['promo_discount']; ?>
                                                </div>

                                            </div>    
                                        </div>
                                    </div>
                                <?php
                                        }
                                    }else{
                                ?> 
                                    <div class="col-md-12">
                                        <p class="text-center my-4" style="font-size: 35px">No Promo Code</p>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>