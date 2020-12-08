<?php
require_once('config/connect_db.php');
require_once('config/bootstrap.php');
require_once('customer/layouts.php');
session_start();

do_html_head('APP NAME', $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav('APP NAME');
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-md-2 col-lg-3">
            <nav class="nav flex-column">
                <a class="nav-link" href="?">All</a>
                <a class="nav-link" href="?testing">Link</a>
                <a class="nav-link" href="#">Link</a>
            </nav>
        </div>
        <div class="col-12 col-md-10 col-lg-9">

<?php
$query = "SELECT * FROM product";

if(isset($_GET['prdt_category'])) {
    
}

$result = mysqli_query($conn, $query);

if(!$result) 
    die('Fetch Error');
else {
    $num_row = mysqli_num_rows($result);
    if($num_row > 0) {
        for($i = 0; $i < $num_row; $i++) {
            $row = mysqli_fetch_assoc($result);
            do_component_product_card($row);
        }
    }
}
?>
        </div>
    </div>

</div>
<?php
do_html_end();
?>