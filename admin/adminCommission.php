<?php
include_once('../config/bootstrap.php');
include_once('../config/connect_db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <?php echo $bootstrapCSS; echo $jQueryJS; echo $jQueryFormJS; echo $bootstrapJS; echo $fontAwsomeIcons ?>
</head>
<link rel="stylesheet" href="layouts/navBar.css"/>
<body>
    <?php
        $pageName = $pageTitle = 'Commission';
        include 'layouts/adminSideNav.php';
        include 'layouts/adminTopNav.php';
    ?>
<div class="container">

</div>
</body>
</html>