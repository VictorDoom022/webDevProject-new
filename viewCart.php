<?php
require_once('config/connect_db.php');
require_once('config/bootstrap.php');
require_once('customer/layouts.php');

session_start();
if(!isset($_SESSION['user_id'])) {
    header('location: login.php');
}

$user_id = $_SESSION['user_id'];

do_html_head('Apple', $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav('Apple');


echo $query = "SELECT * FROM cart LEFT JOIN product ON cart.crt_product = product.id WHERE crt_user='$user_id'";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_row($result);
print_r($row);

?>
<div class="container mt-4">
    <div class="card border-0">
        <div class="card-body">
            <div class="row">
                <div class="card col-12">
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
do_html_end();
?>