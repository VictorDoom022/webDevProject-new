<?php
include_once('../config/bootstrap.php');
require_once('../config/connect_db.php');
session_start();
include_once('../functions/checkSession.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM promo WHERE id ='$id' AND promo_seller = '".$_SESSION["user_id"]."'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $id = $row['id'];
            $promo_code = $row['promo_code'];
            $promo_startDate = $row['promo_startDate'];
            $promo_dueDate = $row['promo_dueDate'];
            $promo_desc = $row['promo_desc'];
            $promo_prdt = $row['promo_prdt'];
            $promo_discount = $row['promo_discount'];
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
        $pageTitle = 'Edit Promo';
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
                                    <div class="col-md-6">
                                        Promo Code
                                        <input class="form-control form-control-sm border-dark" type="text" name="promo_code" value="<?php echo $promo_code; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Promo Start Date
                                        <input class="form-control form-control-sm border-dark" onchange="dateCheck();" type="date" id="promo_startDate" name="promo_startDate" value="<?php echo $promo_startDate; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Promo Due Date
                                        <input class="form-control form-control-sm border-dark" onchange="dateCheck();" type="date" id="promo_dueDate" name="promo_dueDate" value="<?php echo $promo_dueDate; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Promo Desc
                                        <input class="form-control form-control-sm border-dark" type="text" name="promo_desc" value="<?php echo $promo_desc; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Promo Product
                                        <select class="form-control form-control-sm border-dark" id="promo_prdt" name="promo_prdt">
                                        <?php
                                            $sql = "SELECT CONCAT(prdt_code, ' : ',  prdt_name) AS product_result, id FROM product WHERE prdt_seller = '".$_SESSION["user_id"]."'";
                                            $result = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <!-- This is a temporary solution. Need to able select all products and preselect selected products. -->
                                        <option name="promo_prdt" value="<?php echo $row['id'] ?>"><?php echo $row['product_result']?></option>
                                        <?php
                                                }
                                            }    
                                        ?>
                                        </select>
                                        <input type="hidden" id="promo_prdt_select" value="<?php echo $promo_prdt ?>">
                                    </div>
                                    <div class="col-md-6">
                                        Promo Discount
                                        <input class="form-control form-control-sm border-dark" type="number" name="promo_discount" value="<?php echo $promo_discount; ?>">
                                    </div>
                                </div>

                                <div class="text-right mt-2">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="submit" class="btn btn-sm btn btn-outline-dark" name="editPromo" value="Edit"/>
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
function dateCheck() {
    promo_startDate = document.getElementById('promo_startDate').value;
    promo_dueDate = document.getElementById('promo_dueDate').value;

    if(promo_startDate!="" && promo_dueDate!=""){
        if(promo_startDate > promo_dueDate) {
            alert('Invalid date!');
            $('input[type=date]').val('');
        }else{
            // Do nothing
            console.log('Valid date');
        }
    }
}
$(document).ready(function() {
    var promo_prdt = document.getElementById('promo_prdt_select').value;
    document.getElementById('promo_prdt').value = promo_prdt;
});
</script>
</html>