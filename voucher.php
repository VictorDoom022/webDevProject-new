<?php
require_once('./config/connect_db.php');
require_once('./config/bootstrap.php');
require_once('./customer/layouts.php');

session_start();

do_html_head('Apple', $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav('Apple');
?>

    <div class="container mt-5">
        <h4>Voucher</h4>
        <div class="row">
            <?php
            $query = "SELECT prdt_name, prdt_image, promo_code, promo_startDate, promo_dueDate, promo_discount, promo_desc FROM promo 
                    LEFT JOIN product ON promo.promo_prdt = product.id
                    LEFT JOIN users ON promo.promo_seller = users.id
                    WHERE CURDATE() BETWEEN promo_startDate AND promo_dueDate";
            $result = mysqli_query($conn, $query);

            if($result) {
                $num_row = mysqli_num_rows($result);
                for($i = 0; $i < $num_row; $i++){
                    $row = mysqli_fetch_assoc($result);

                    $start_date = strtotime($row['promo_startDate']);
                    $start_date = date('d/m/Y', $start_date);
                    $due_date = strtotime($row['promo_dueDate']);
                    $due_date = date('d/m/Y', $due_date);
            ?>
            <div class="col-12 col-md-6" id="voucher_list">
                <div class="card border-0 voucher-card" data-vouchercode="<?= $row['promo_code'] ?>">
                    <div class="card-body" style="background-color: #fff6f6;">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <img class="img-fluid" src="<?= $row['prdt_image'] ?>" alt="">
                            </div>
                            <div class="col-8">
                                <div class="h6"><?= $row['prdt_name'] ?></div>
                                <div class="small text-muted">
                                    <?= $row['promo_desc'] ?>
                                </div>
                                <div class="text-right text-danger"><span class="h3"><?= $row['promo_discount'] ?></span><span class="mx-1">%</span><span class="h5">OFF</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer disc_date bg-white border-0 text-danger">Validity: <?= $start_date .'-'. $due_date?></div>
                </div>
            </div>
            <?php
                }
            } else {
                echo 'error';
            }
            ?>
            
        </div>
    </div>
    <input type="text" id="v_c" name="v_c" style="opacity: 0;">
    <?= $sweetAlert?>
    <script>
        $(document).ready(function() {
            $('.voucher-card').click(function() {
                var code = $(this).data('vouchercode');
                console.log(code);
                var copy_code = document.getElementById('v_c');
                copy_code.value = code;
                copy_code.select();
                copy_code.setSelectionRange(0, 99999);
                document.execCommand("copy");

                swal({
                    icon: "success",
                    title: "Copied",
                    text: 'Voucher code copied',
                    timer: 1100,
                    buttons: false,
                });
            })
        });
    </script>
<?php
do_html_end();