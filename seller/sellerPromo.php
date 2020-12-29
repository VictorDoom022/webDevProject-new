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
    <?php echo $bootstrapCSS; echo $jQueryJS; echo $sweetAlert; echo $bootstrapJS; echo $fontAwsomeIcons ?>
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
                                    $sql = "SELECT promo.id AS id, promo.promo_code AS promo_code, promo.promo_startDate AS promo_startDate, promo.promo_dueDate AS promo_dueDate,promo.promo_desc AS promo_desc, promo.promo_discount AS promo_discount, promo.promo_seller AS promo_seller, product.prdt_name AS prdt_name
                                    FROM promo LEFT JOIN product ON promo.promo_prdt = product.id WHERE promo_seller = '".$_SESSION["user_id"]."'";
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
                                                    ID: <?php echo $row['id']; ?> <br>
                                                    Start Date: <?php echo $row['promo_startDate']; ?> <br>
                                                    Due Date: <?php echo $row['promo_dueDate'] ?> <br>
                                                    Promo Product: <?php echo $row['prdt_name']; ?> <br>
                                                    Promo Discount: <?php echo $row['promo_discount']; ?>
                                                </div>

                                                <div class="text-right">
                                                    <a href="sellerEditPromo.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                                    <input onclick="deletePromo(this.name, '<?php echo $row['id']; ?>');" type="button" class="btn btn-sm btn-outline-danger" name="deletePromo" value="Delete">
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
<script>
function deletePromo(value, promo_id){
    swal({
            icon: "warning",
            title: "Comfirm Detele",
            text: "Are you sure you want to delete?",
            buttons: true,
            dangerMode: true,
        })
    .then((confirmDelete) => {
            if(confirmDelete){
                //comfirmed delete
                $.ajax({
                    url: '../functions/seller/addPromo.php',
                    type: 'POST',
                    data: {
                        deletePromo: value,
                        id: promo_id,
                    },success: function(){
                        swal("Deleted Succesfully!", {
                            icon: "success",
                        }).then(function(){
                            $(".container-fluid").load(document.URL + " .container-fluid");
                        });
                    }
                });
            }else{
                // cancel
            }
        }
    );
}
</script>
</html>