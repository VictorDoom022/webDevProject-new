<?php
require_once('connect_db.php');

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

$data = array();

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
}

echo json_encode($data);
?>