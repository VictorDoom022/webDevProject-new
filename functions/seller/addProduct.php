<?php
require_once('../../config/connect_db.php');

session_start();


if(isset($_POST['addProduct'])){
    $prdt_code = $_POST['prdt_code'];
	$prdt_name = $_POST['prdt_name'];
	$prdt_oriPrice = $_POST['prdt_oriPrice'];
    $prdt_sellPrice = $_POST['prdt_sellPrice'];
    $prdt_type = $_POST['prdt_type'];
    $prdt_quantity = $_POST['prdt_quantity'];
    $prdt_image = "https://as1.ftcdn.net/jpg/02/44/83/32/500_F_244833214_bBmRijbyEmtKrm7Q5zdcMc4ks3tpTmVu.jpg";
    if(($_POST['prdt_available'] != null) || ($_POST['prdt_available']) == '1'){
        $prdt_available = '1';
    }else{
        $prdt_available = '0';
    }
    $prdt_desc = $_POST['prdt_desc'];
    $prdt_seller = $_SESSION["user_id"];

	$sql = "INSERT INTO product(prdt_code, prdt_name, prdt_oriPrice, prdt_sellPrice, prdt_type , prdt_quantity, prdt_image,prdt_available, prdt_desc, prdt_seller) 
    VALUES ('$prdt_code','$prdt_name','$prdt_oriPrice','$prdt_sellPrice','$prdt_type', '$prdt_quantity','$prdt_image','$prdt_available','$prdt_desc','$prdt_seller')";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('location: ../../seller/sellerProduct.php');
}
?>