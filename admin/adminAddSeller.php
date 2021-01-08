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
    <?= $fontAwsomeIcons ?>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<link rel="stylesheet" href="layouts/navBar.css"/>
<body>
<?php
        $pageName = $pageTitle = 'Admin';
        include 'layouts/adminSideNav.php';
        include 'layouts/adminTopNav.php';
    ?>
<div class="seller-form container border">
    <div>
        <h5 class="mt-2">Add Seller Form</h5>
    </div>
    <div class="row justify-content-center border-top">
        <form action="../functions/admin/adminManageFunctions.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group mt-2">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" class="form-control" placeholder="Enter your password">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label>Position</label>
            <input type="text" name="position" class="form-control" placeholder="Enter your position">
        </div>
        <div class="form-group">
            <button type="submit" name="save" class="btn btn-outline-primary">Save</button>
        </div>
        </form>
    </div>
</div>
</body>
</html>