<?php
require_once('config/bootstrap.php');
require_once('config/connect_db.php');
require_once('customer/layouts.php');

session_start();

do_html_head('APP NAME', $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav('APPNAME');

$query = "SELECT * FROM product;";
$result = mysqli_query($conn, $query);
if(!$result) {
    die('Error To connect db');
}else{
    $top_selling_products = array();
    
    if(mysqli_num_rows($result) > 0) {
        $top_selling_products = mysqli_fetch_array($result);
    }
}

do_component_top_sale_product($top_selling_products);

do_html_end();
