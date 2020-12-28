<?php
include_once('../config/bootstrap.php');
require_once('../config/connect_db.php');
session_start();
include_once('../functions/checkSession.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <?php echo $bootstrapCSS; echo $jQueryJS; echo $sweetAlert ;echo $bootstrapJS; echo $fontAwsomeIcons ?>
</head>
    <link rel="stylesheet" href="layouts/navBar.css"/>
<body>
    <?php
        $pageName = $pageTitle = 'Report';
        include 'layouts/sellerSideNav.php';
        include 'layouts/sellerTopNav.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10">
                <div class="row">
                <?php
                    $sql = "SELECT SUM(ord_product_unit_price * ord_product_quantity) AS totalSellPrice,
                    SUM(prdt_oriPrice * ord_product_quantity) AS totalOriPrice,
                    SUM(ord_product_unit_price * ord_product_quantity) AS totalUnitPrice
                    FROM orders 
                    LEFT JOIN order_detail ON orders.id = order_detail.ord_id
                    LEFT JOIN users ON orders.ord_user_id = users.id
                    LEFT JOIN product ON order_detail.ord_product_id = product.id
                    WHERE prdt_seller = '" .$_SESSION["user_id"]."'";

                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                    <div class="col-md-12">
                        <div class="card mt-1">
                            <h3 class="text-center">Total Revenue</h3>
                                <h4 class="text-center">RM<?php echo $row['totalSellPrice'] - $row['totalOriPrice']; ?></h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mt-1">
                            <h3 class="text-center">Total Product Sold in Original Price </h3>
                                <h4 class="text-center">RM<?php echo $row['totalOriPrice']; ?></h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mt-1">
                            <h3 class="text-center">Total Product Sold in Selling Price </h3>
                                <h4 class="text-center">RM<?php echo $row['totalUnitPrice'] ?></h4>
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>
                    <div class="col-md-12">
                        <div class="card mt-1">
                            <table class="table table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Price (Ori Price)</th>
                                        <th>Product Price (Sell Price)</th>
                                        <th>Quantity</th>
                                        <th>Total RM (Sell Price x Quantity)</th>
                                    </tr>
                                </thead>
                                <?php
                                    $sql="SELECT product.prdt_name, product.prdt_oriPrice, product.prdt_sellPrice, order_detail.ord_product_quantity, users.id
                                    FROM orders
                                    LEFT JOIN order_detail ON orders.id = order_detail.ord_id
                                    LEFT JOIN product ON order_detail.ord_product_id = product.id
                                    LEFT JOIN users ON prdt_seller = users.id
                                    WHERE users.id = '" .$_SESSION["user_id"]."'";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                    <td><?php echo $row['prdt_name']; ?></td>
                                    <td><?php echo $row['prdt_oriPrice']; ?></td>
                                    <td><?php echo $row['prdt_sellPrice']; ?></td>
                                    <td><?php echo $row['ord_product_quantity']; ?></td>
                                    <td style="text-align: right;"><?php echo ($row['prdt_sellPrice'] * $row['ord_product_quantity']); ?></td>
                                </tr>
                                <?php
                                        }
                                    }
                                ?>
                                <tr>
                                <?php
                                    $sql = "SELECT SUM(ord_product_unit_price * ord_product_quantity) AS total
                                    FROM orders 
                                    LEFT JOIN order_detail ON orders.id = order_detail.ord_id
                                    LEFT JOIN users ON orders.ord_user_id = users.id
                                    LEFT JOIN product ON order_detail.ord_product_id = product.id
                                    WHERE prdt_seller = '" .$_SESSION["user_id"]."'";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <td colspan="4" style="font-weight: bold">Total:</td>
                                    <td style="font-weight: bold; text-align:right"><?php echo $row['total']; ?></td>
                                <?php
                                        }
                                    }
                                ?>
                                </tr>
                            
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <input type="button" id="gnerateCSV" class="btn btn-sm btn btn-outline-dark btn-block" style="border-radius: 0px ;" value="Generate CSV"/>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
<script>
    function download_csv(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
}

function export_table_to_csv(html, filename) {
	var csv = [];
	var rows = document.querySelectorAll("table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV
    download_csv(csv.join("\n"), filename);
}

document.querySelector("#gnerateCSV").addEventListener("click", function () {
    var html = document.querySelector("table").outerHTML;
	export_table_to_csv(html, "table.csv");
});
</script>
</html>