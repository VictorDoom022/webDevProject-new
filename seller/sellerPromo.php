<?php
include_once('../config/bootstrap.php');
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
                </div>
            </main>
        </div>
    </div>
</body>
</html>