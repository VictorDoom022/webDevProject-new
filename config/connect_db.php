<?php 
error_reporting(0);
$conn = mysqli_connect('localhost', 'root', '', 'webdevnew');
if (mysqli_connect_errno()) {
	die("Connection failed: " . mysqli_connect_error());
}

function db_connect()
{
    $conn = new mysqli('localhost', 'root', '', 'webdevnew');

    if(!$conn) {
        throw new Exception('Could not connect to database server');
    }

    return $conn;
}
?>