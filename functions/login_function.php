<?php
require_once('../config/connect_db.php');

session_start();


if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    if($stmt = $conn->prepare("SELECT id, username, position FROM users WHERE username=? AND password=?")){
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();
        $stmt->bind_result($id, $username, $position);
        if($stmt->fetch()){
            unset($_SESSION['error']);
            unset($_SESSION['success']);

            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['position'] = $position;
            if($position == 'admin' && isset($_POST["term"])){
                echo "admin";
            }else if ($position == 'seller'  && isset($_POST["term"])){
                header("Location: ../seller/sellerHome.php");
            }else if ($position == 'customer'  && isset($_POST["term"])){
                header('location: ../index.php');
            }else if(empty($_POST["term"])){
                echo "no tick";
            }
            else{
                echo "who da fuq are you";                
            }
        }else{
            echo $stmt->fetch();
            $_SESSION['error'] = "Your username or password is invalid";
            unset($_SESSION['success']);
            header("location: ../login.php");
        }
        $stmt->close();
    }
    $conn->close();
}
?>