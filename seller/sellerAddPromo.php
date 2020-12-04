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
        $pageTitle = 'Add Promo Code';
        $pageName = 'Promo';
        include 'layouts/sellerSideNav.php';
        include 'layouts/sellerTopNav.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10">
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div class="card border-dark px-2 py-2" style="border-radius: 0px;">
                            <form action="../functions/seller/addPromo.php" method="POST">  
                                <div class="row">
                                    <div class="col-md-12">
                                        Promo Code
                                        <input class="form-control form-control-sm border-dark" type="text" name="promo_code">
                                    </div>
                                    <div class="col-md-6">
                                        Promo Start Date
                                        <input class="form-control form-control-sm border-dark" type="date" name="promo_startDate">
                                    </div>
                                    <div class="col-md-6">
                                        Promo Due Date
                                        <input class="form-control form-control-sm border-dark" type="date" name="promo_dueDate">
                                    </div>
                                    <div class="col-md-6">
                                        Promo Product
                                        <select class="form-control form-control-sm border-dark" name="promo_prdt">
                                            <?php
                                                $sql = "SELECT CONCAT(prdt_code, ' : ', prdt_name) AS itemResults, id FROM product WHERE prdt_seller = '".$_SESSION["user_id"]."'";
                                                $result = mysqli_query($conn, $sql);
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['itemResults']; ?></option>
                                            <?php
                                                    }
                                                }    
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        Promo Discount
                                        <input class="form-control form-control-sm border-dark" type="number" name="promo_discount">
                                    </div>
                                    <div class="col-md-6">
                                        Promo Description
                                        <input class="form-control form-control-sm border-dark" type="text" name="promo_desc">
                                    </div>
                                </div>

                                <div class="text-right mt-2">
                                    <input type="submit" class="btn btn-sm btn btn-outline-dark" name="addPromo" value="Add"/>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>