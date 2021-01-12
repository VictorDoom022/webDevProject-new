<?php
include_once('../config/bootstrap.php');
require_once('../config/connect_db.php');
session_start();
include_once('../functions/checkSession.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM users where id ='$id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $id = $row['id'];
            $username = $row['username'];
            $email = $row['email'];
        }
    }
}
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
<div class="container-fluid col-md-10">
    <div class="row">
        <div class="col-md-2"></div>
            <main class="col-md-9 pt-3 ml-2">
                <form action="../functions/admin/adminManageFunctions.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <table class="table border">
                        <thead class="thead-dark">
                            <tr>
                                <th>
                                    <h5 class="mt-2">Update Seller Form</h5>
                                </th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" 
                                value="<?php echo $username;?>" placeholder="Enter your name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" 
                                value="<?php echo $email;?>" placeholder="Enter your email">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
                                <a href="adminManageSeller.php" name="cancel" class="btn btn-outline-warning">Cancel</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </main>
    <div>
</div>
</body>
</html>