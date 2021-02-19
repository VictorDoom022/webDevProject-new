<?php
require_once('connect_db.php');

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM users WHERE id='".$id."'";

    $result = mysqli_query($conn,$query);

}else{
    echo 'Received Nothing <br />';
}

?>