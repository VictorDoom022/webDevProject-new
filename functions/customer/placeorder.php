<?php
require_once('../../config/connect_db.php');

session_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['position']) ) {
    if(!($_SESSION['position'] == 'customer')) {
        header('location: ../../index.php');
    }

    
}

header('location: ../../viewCart.php');
?>