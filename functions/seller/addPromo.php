<?php

require_once('../../config/connect_db.php');

session_start();

//add Product
if(isset($_POST['addPromo'])){
    $promo_code = $_POST['promo_code'];
	$promo_startDate = $_POST['promo_startDate'];
	$promo_dueDate = $_POST['promo_dueDate'];
    $promo_prdt = $_POST['promo_prdt'];
    $promo_discount = $_POST['promo_discount'];
    $promo_desc = $_POST['promo_desc'];
    $promo_seller = $_SESSION["user_id"];

    if($promo_startDate > $promo_dueDate){
        header('location: ../../seller/sellerAddPromo.php');
    }

    if($promo_discount == '0' || $promo_discount >= '100'){
        header('location: ../../seller/sellerAddPromo.php');
    }

	$sql = "INSERT INTO promo(promo_code, promo_startDate, promo_dueDate, promo_prdt, promo_discount , promo_desc, promo_seller) 
    VALUES ('$promo_code','$promo_startDate','$promo_dueDate','$promo_prdt','$promo_discount', '$promo_desc','$promo_seller')";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('location: ../../seller/sellerPromo.php');
}

?>