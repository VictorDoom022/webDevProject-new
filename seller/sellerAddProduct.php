<?php
include_once('../config/bootstrap.php');
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
        $pageTitle = 'Add Product';
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
                        <div class="card border-dark px-2 py-2" style="border-radius: 0px;">
                            <form action="../functions/seller/addProduct.php" method="POST">  
                                <div class="row">
                                    <div class="col-md-6">
                                        Product Code
                                        <input class="form-control form-control-sm border-dark" type="text" name="prdt_code">
                                    </div>
                                    <div class="col-md-6">
                                        Product Name
                                        <input class="form-control form-control-sm border-dark" type="text" name="prdt_name">
                                    </div>
                                    <div class="col-md-6">
                                        Original Price (per unit)
                                        <input class="form-control form-control-sm border-dark" type="text" name="prdt_oriPrice">
                                    </div>
                                    <div class="col-md-6">
                                        Selling Price (per unit)
                                        <input class="form-control form-control-sm border-dark" type="text" name="prdt_sellPrice">
                                    </div>
                                    <div class="col-md-6">
                                        Product Type
                                        <select class="form-control form-control-sm border-dark"name="prdt_type">
                                            <option value="iphone">iPhone</option>
                                            <option value="ipad">iPad</option>
                                            <option value="mac">Mack</option>
                                            <option value="ipod">Ipod</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        Quantity
                                        <input class="form-control form-control-sm border-dark" type="number" name="prdt_quantity">
                                    </div>
                                    <div class="col-md-6">
                                        Product Image
                                        <input class="form-control form-control-sm border-dark" type="file" name="prdt_image" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        Availablility
                                        <input class="form-control form-control-sm border-dark" type="checkbox" name="prdt_available" value="1">
                                    </div>
                                    <div class="col-md-12">
                                        Description
                                        <textarea class="form-control form-control-sm border-dark" name="prdt_desc" cols="30" rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="text-right mt-2">
                                    <input type="submit" class="btn btn-sm btn btn-outline-dark" name="addProduct" value="Add"/>
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