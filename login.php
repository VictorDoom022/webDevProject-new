<?php
require_once('connect_db.php');

$username = $_POST['username'];
$passwordNoEncrypt = $_POST['password'];
$password = md5($passwordNoEncrypt);


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
            echo "seller";
        }else if ($position == 'customer'){
            echo "customer";
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
?>