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
        $pageName = $pageTitle = 'Order';
        include 'layouts/sellerSideNav.php';
        include 'layouts/sellerTopNav.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10">
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div class="card border-dark">
                            <div class="card-header border-dark bg-dark text-white">
                                Lists of Orders
                            </div>

                            <div class="row px-3">
                                <?php
                                    $sql = "SELECT * FROM orders 
                                    LEFT JOIN order_detail ON orders.id = order_detail.ord_id 
                                    LEFT JOIN product ON ord_product_id = product.id
                                    LEFT JOIN users ON users.id = orders.ord_user_id
                                    WHERE product.prdt_seller = '" .$_SESSION["user_id"]."'";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <div class="col-md-3 ml-0 mr-0 my-2 px-1">
                                    <div class="card border-dark">
                                        <div class="card-body pb-1">
                                            <div class="card-text">
                                                Order ID: <?php echo $row['ord_id']; ?> <br>
                                                Order product ID: <?php echo $row['prdt_code'] ?> <br>
                                                Order quantity: <?php echo $row['ord_product_quantity'] ?> <br>
                                                Customer name: <?php echo $row['username'] ?> <br>
                                                Order date: <?php echo $row['date'] ?> <br>
                                            
                                                <div class="text-center mt-1">
                                                    <input type="hidden" id="ord_status_select" value="<?php echo $row['ord_status'] ?>">
                                                    <select onchange="updateStatus(this.value, <?php echo $row['ord_id']; ?>)" class="btn btn-outline-primary btn-sm" name="ord_status" id="ord_status">
                                                        <option value="payed">Payed</option>
                                                        <option value="processing">Processing</option>
                                                        <option value="packed">Packed</option>
                                                        <option value="delivered">Delivered</option>
                                                    </select>
                                                </div>
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

<script>

$(document).ready(function() {
    var promo_prdt = document.getElementById('ord_status_select').value;
    document.getElementById('ord_status').value = promo_prdt;
});

function updateStatus($order_status, $order_id){
    //console.log($order_status+ $order_id);
    $.ajax({
        url: '../functions/seller/updateOrderStatus.php',
        type: 'POST',
        data: { 'ord_id' : $order_id , 'ord_status' : $order_status},
        success: function(data){
            swal({
                icon: "success",
                title: "Success",
                text: "Product status updated successfully",
                timer: 1100,
                buttons: false,
            });
        },
        error: function(){
            swal({
                icon: "error",
                title: "An error occurred",
                text: "Please try again",
                timer: 1100,
                buttons: false,
            });
        }
    });
}
</script>
</html>