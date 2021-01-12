<?php
include_once('../config/bootstrap.php');
include_once('../config/connect_db.php');
session_start();
include_once('../functions/checkSession.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <?= $fontAwsomeIcons ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2da503c223.js" crossorigin="anonymous"></script>
</head>
<link rel="stylesheet" href="layouts/navBar.css"/>
<body>
    <?php
        $pageName = $pageTitle = 'Admin';
        include 'layouts/adminSideNav.php';
        include 'layouts/adminTopNav.php';
    ?>
    <div class="container-fluid">
        <?php 
            $query = "SELECT * FROM users WHERE position = 'seller'";
            $result = mysqli_query($conn,$query);
            if(!$result) die ('Get data failed');
        ?>
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10 pt-3">
                <table class="table border">
                    <thead class="thead-dark">
                        <tr>
                            <th>Seller Name</th>
                            <th>Email</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    <?php
                        while($row = $result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?php echo $row['username']?></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php echo $row['position']?></td>
                        </tr>
                <?php endwhile;?>
                </table>
                <div class="text-center">
                    <a href="adminSelectSeller.php" class="btn btn-outline-warning col-md-3">Edit</a>
                    <a href="adminDeleteSeller.php" class="btn btn-outline-danger col-md-3">Delete</a>
                </div>
            </main>
        </div><br>
    </div>
</body>
</html>