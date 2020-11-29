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
        $pageName = 'Product';
        include 'layouts/sellerSideNav.php';
        include 'layouts/sellerTopNav.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10">
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <a href="sellerAddProduct.php" class="btn btn-sm btn btn-outline-dark btn-block" style="border-radius: 0px ;">Add Product</a>
                    </div>

                    <div class="col-md-12 mt-2">
                        <div class="card border-dark">
                            <div class="card-header border-dark bg-dark text-white">
                                Lists of Products
                            </div>
                            
                            <div class="row">
                                <?php
                                    $sql = "SELECT * FROM product WHERE prdt_seller = '".$_SESSION["user_id"]."'";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <div class="col-md-3 mx-2 my-2">
                                        <div class="card border-dark">
                                            <img src="<?php echo $row['prdt_image']; ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?php echo $row['prdt_name']; ?>
                                                </h5>
                                            
                                                <div class="card-subtitle mb-0 text-muted">
                                                    <?php 
                                                        if($row['prdt_available']>0){
                                                            echo '<p class="text-success">Available</p>';
                                                        }else{
                                                            echo '<p class="text-danger">Unvailable</p>';
                                                        }
                                                    ?>
                                                </div>

                                                <div class="card-text">
                                                    Price: <?php echo $row['prdt_sellPrice']; ?> <br>
                                                    Type: <?php echo $row['prdt_type'] ?> <br>
                                                    Quantity left: <?php echo $row['prdt_quantity']; ?> <br>
                                                    Description: <?php echo $row['prdt_desc']; ?>
                                                </div>

                                                <div class="text-right">
                                                    <a href="sellerEditProduct.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                                    <button href="#" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </div>
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
                </div>
            </main>
        </div>
    </div>
</body>
</html>