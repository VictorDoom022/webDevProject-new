<?php
require_once('config/connect_db.php');
require_once('config/bootstrap.php');
require_once('customer/layouts.php');
session_start();

if(isset($_GET['pid'])) {
    $product_id = $_GET['pid'];
} else {
    header('location: index.php');
}
// show product detail
do_html_head('APP NAME', $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav('APP NAME');

$query = "SELECT * FROM product WHERE id = $product_id";
$result = mysqli_query($conn, $query);

if(!$result) 
    die('Fetch Error!');
else {
    $num_row = mysqli_num_rows($result);
    if($num_row > 0) {
        $product = '';
    } else {
        echo '404';
    }
}
?>
<div class="container mt-5">
    <div class="bg-white shadow">
        
    </div>
</div>
<?php
do_html_end();