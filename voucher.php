<?php
require_once('./config/connect_db.php');
require_once('./config/bootstrap.php');
require_once('./customer/layouts.php');

do_html_head('Apple', $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav('Apple');
?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card border-0 shadow-sm" data-voucherCode="ABC">
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.voucher-card').click(function() {
                var code = $(this).data('voucherCode');
                
            })
        });
    </script>
<?php
do_html_end();