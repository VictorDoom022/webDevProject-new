<?php
require_once('../config/connect_db.php');

$conn = mysqli_connect("localhost","root","","webdevnew");

if(isset($_POST["submit"])){
	$username = $_POST["username"];
	$password = $_POST["password"];

	$sql = mysqli_query($conn,"SELECT count(*) as total FROM users WHERE username = '".$username."' and password = '".$password."'")or die(
		mysqli_error($conn));

	$rw = mysqli_fetch_array($sql);
    
        
    if(empty($_POST["username"]) && empty($_POST["password"]) && empty($_POST["term"])){
        echo"Please Enter username and password";
    }else if(empty($_POST["username"])){
        echo"Please Enter Username";
    }else if(empty($_POST["password"])){
        echo"Please Enter Password";
    }else if(isset($_POST["username"]) && isset($_POST["password"]) && empty($_POST["term"])){
        echo"<script>alert('Please read the FKing TERM')</script>";
    }else{
        if($rw['total']>0){
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
                        header("location: ../seller/sellerHome.php");
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
        }else{
            echo"Wrong pass";
        }
    }
}
?>



<a href="../login.php">back</a>