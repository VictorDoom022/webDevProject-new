<?php
include_once('../config/bootstrap.php');
require_once('../config/connect_db.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- CSS -->
    <?= $bootstrapCSS ?>
    
    <link rel="stylesheet" href="layouts/navBar.css"/>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <?= $fontAwsomeIcons ?>

    <?= $bootstrapJS ?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $pageName = $pageTitle = 'Chat';
        include 'layouts/adminSideNav.php';
        include 'layouts/adminTopNav.php';
    ?>
</body>
</html>