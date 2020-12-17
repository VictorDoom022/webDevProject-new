<?php
include_once('../config/bootstrap.php');
require_once('../config/connect_db.php');
session_start();
include_once('../functions/checkSession.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM product where id ='$id' AND prdt_seller = '".$_SESSION["user_id"]."'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $id = $row['id'];
            $prdt_code = $row['prdt_code'];
            $prdt_name = $row['prdt_name'];
            $prdt_type = $row['prdt_type'];
            $prdt_oriPrice = $row['prdt_oriPrice'];
            $prdt_sellPrice = $row['prdt_sellPrice'];
            $prdt_desc = $row['prdt_desc'];
            $prdt_image = $row['prdt_image'];
            $prdt_quantity = $row['prdt_quantity'];
            $prdt_seller = $row['prdt_seller'];
            $prdt_available = $row['prdt_available'];
        }
    }
}
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
        $pageTitle = 'Edit Product';
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
                                        <input class="form-control form-control-sm border-dark" type="text" name="prdt_code" value="<?php echo $prdt_code; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Product Name
                                        <input class="form-control form-control-sm border-dark" type="text" name="prdt_name" value="<?php echo $prdt_name; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Original Price (per unit)
                                        <input class="form-control form-control-sm border-dark" type="text" name="prdt_oriPrice" value="<?php echo $prdt_oriPrice; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Selling Price (per unit)
                                        <input class="form-control form-control-sm border-dark" type="text" name="prdt_sellPrice" value="<?php echo $prdt_sellPrice; ?>">
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
                                        <input class="form-control form-control-sm border-dark" type="number" name="prdt_quantity" value="<?php echo $prdt_quantity; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Product Image
                                        <input class="form-control form-control-sm border-dark" type="text" name="prdt_image" value="<?php echo $prdt_image; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Availablility
                                        <input class="form-control form-control-sm border-dark" type="checkbox" id="prdt_available" name="prdt_available" value="<?php echo $prdt_available; ?>">
                                        <input type="hidden" id="prdt_available_chkbox" value="<?php echo $prdt_available; ?>">
                                    </div>
                                    <div class="col-md-12">
                                        Description
                                        <textarea class="form-control form-control-sm border-dark" name="prdt_desc" cols="30" rows="10"><?php echo $prdt_desc; ?></textarea>
                                    </div>
                                </div>

                                <div class="text-right mt-2">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="submit" class="btn btn-sm btn btn-outline-dark" name="editProduct" value="Edit"/>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        var prdt_available = document.getElementById('prdt_available_chkbox').value;
        if(prdt_available == '1'){
            $('#prdt_available').attr( "checked", true );
        }
    });
</script>
</html>