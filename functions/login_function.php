<?php
require_once('../config/connect_db.php');

session_start();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($stmt = $conn->prepare("SELECT id, username, position FROM users WHERE username=? AND password=?")){
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();
        $stmt->bind_result($id, $username, $position);
        if($stmt->fetch()){
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['position'] = $position;
            if($position == 'admin'){
                echo "admin";
            }else if ($position == 'seller'){
                header("Location: ../seller/sellerHome.php");
            }else if ($position == 'customer'){
                header('location: ../index.php');
            }else{
                echo "who da fuq are you";
            }
        }else{
            echo $stmt->fetch();
            echo "Your username or password is invalid";
            //header("Location: ../login.php");
        }
        $stmt->close();
    }
    $conn->close();
}
?>