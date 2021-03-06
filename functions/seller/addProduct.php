<?php
require_once('../../config/connect_db.php');

session_start();

//add Product
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addProduct'])){
    $prdt_code = $_POST['prdt_code'];
	$prdt_name = $_POST['prdt_name'];
	$prdt_oriPrice = $_POST['prdt_oriPrice'];
    $prdt_sellPrice = $_POST['prdt_sellPrice'];
    $prdt_type = $_POST['prdt_type'];
    $prdt_quantity = $_POST['prdt_quantity'];
    $prdt_image = $_POST['prdt_image'];
    if(($_POST['prdt_available'] != null) || ($_POST['prdt_available']) == '1'){
        $prdt_available = '1';
    }else{
        $prdt_available = '0';
    }
    $prdt_desc_noClean = $_POST['prdt_desc'];
    $prdt_desc = removeApostrophe($prdt_desc_noClean);
    $prdt_seller = $_SESSION["user_id"];

	$sql = "INSERT INTO product(prdt_code, prdt_name, prdt_oriPrice, prdt_sellPrice, prdt_type , prdt_quantity, prdt_image,prdt_available, prdt_desc, prdt_seller) 
    VALUES ('$prdt_code','$prdt_name','$prdt_oriPrice','$prdt_sellPrice','$prdt_type', '$prdt_quantity','$prdt_image','$prdt_available','$prdt_desc','$prdt_seller')";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('location: ../../seller/sellerProduct.php');
}

//edit Product
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['editProduct'])){
    $id = $_POST['id'];
    $prdt_code = $_POST['prdt_code'];
	$prdt_name = $_POST['prdt_name'];
	$prdt_oriPrice = $_POST['prdt_oriPrice'];
    $prdt_sellPrice = $_POST['prdt_sellPrice'];
    $prdt_type = $_POST['prdt_type'];
    $prdt_quantity = $_POST['prdt_quantity'];
    $prdt_image = $_POST['prdt_image'];
    if(($_POST['prdt_available'] != null) || ($_POST['prdt_available']) == '1'){
        $prdt_available = '1';
    }else{
        $prdt_available = '0';
    }
    $prdt_desc_noClean = $_POST['prdt_desc'];
    $prdt_desc = removeApostrophe($prdt_desc_noClean);
    $prdt_seller = $_SESSION["user_id"];

	$sql = "UPDATE product SET prdt_code = '$prdt_code', prdt_name = '$prdt_name', prdt_oriPrice = '$prdt_oriPrice', prdt_sellPrice = '$prdt_sellPrice', prdt_type = '$prdt_type', prdt_quantity = '$prdt_quantity', prdt_image = '$prdt_image',prdt_available = '$prdt_available', prdt_desc = '$prdt_desc' 
    WHERE id = '$id'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header('location: ../../seller/sellerProduct.php');
}

//delete Product
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['deleteProduct'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM product where id='".$id."'";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location: ../../seller/sellerProduct.php');
}

function removeApostrophe($string) {
    $string = str_replace('\'', '', $string); // Replaces all apostrophe撇号.
 
    return  $string;
 }
?>