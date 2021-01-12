<?php
include_once('../config/bootstrap.php');
session_start();
include_once('../functions/checkSession.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <?php echo $bootstrapCSS; echo $jQueryJS;echo $jQueryFormJS;echo $sweetAlert; echo $bootstrapJS; echo $fontAwsomeIcons ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
</head>
    <link rel="stylesheet" href="layouts/navBar.css"/>
    <link rel="stylesheet" href="layouts/styles.css"/>
    <style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
    </style>
<body id="addProduct">
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
                            <form action="sellerAddProduct.php" id="form" method="POST">  
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
                                        Product Image (Url)
                                        <input class="form-control form-control-sm border-dark" type="text" name="prdt_image">
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
<script src="../js/blockSpecialChar.js"></script>
<script>
ClassicEditor
    .create( document.querySelector( 'textarea' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
} );

$('#form').ajaxForm( {
    url: '../functions/seller/addProduct.php',
    type: 'POST',
    success: function(result){
        swal({
            icon: "success",
            title: "Success",
            text: "Product added updated successfully",
            timer: 1500,
            buttons: false,
        }).then(function(){
            window.location.assign('sellerProduct.php');
        })
    },
    error: function(err){
        swal({
            icon: "error",
            title: "An error occurred.",
            text: "Please try again. Error Code:" + err,
            timer: 1500,
            buttons: false,
        });
    } 
});
</script>
</html>