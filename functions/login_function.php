<?php
include_once('../config/connect_db.php');

    if(isset($_POST['login'])){
        echo $username = $_POST['username'];
        echo $password = $_POST['password'];

        if($stmt = $conn->prepare("SELECT id,username,position FROM users WHERE username=? AND password=?")){
            $stmt->bind_param("ss",$u,$p);
            $stmt->execute();
            $stmt->bind_result($id, $username, $position);
            if($stmt->fetch()){
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['position'] = $position;
                echo "";
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
                echo "Your username or password is invalid";
                //header("Location: ../login.php");
            }
            $stmt->close();
        }
    $conn->close();
    }
?>