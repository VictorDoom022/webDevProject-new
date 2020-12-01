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
<<<<<<< HEAD
        $pageName = 'Chat';
=======
        $pageName = $pageTitle = 'Chat';
>>>>>>> 8114151bef8cd7301a459b24485db89178f9e220
        include 'layouts/sellerSideNav.php';
        include 'layouts/sellerTopNav.php';
    ?>
</body>
</html>