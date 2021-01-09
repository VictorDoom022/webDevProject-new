<?php
require_once('../config/connect_db.php');

session_start();

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
$_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest" && 
$_SERVER['REQUEST_METHOD'] == "GET"){
    $data = array();

    $promo_code = $_GET['promo_code'];

    $sql = "SELECT * FROM promo WHERE promo_code = '$promo_code'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $data['voucherExists'] = "1";
        while($row = mysqli_fetch_assoc($result)){
            $data['promo_code'] = $row['promo_code'];
            $data['promo_prdt'] = $row['promo_prdt'];
            $data['promo_discount'] = $row['promo_discount'];
        }
    }else{
        $data['voucherExists'] = "0";
    }

    echo json_encode($data);
}
?>