<?php
// show product detail
require_once('config/connect_db.php');
require_once('config/bootstrap.php');
require_once('customer/layouts.php');

session_start();

if(isset($_GET['pid'])) {
    $product_id = $_GET['pid'];
} else {
    header('location: index.php');
}

$query = "SELECT * FROM product LEFT JOIN users ON product.prdt_seller = users.id WHERE product.id = $product_id";
$result = mysqli_query($conn, $query);

if(!$result) 
    die('Fetch Error!');
else {
    $num_row = mysqli_num_rows($result);
    if($num_row > 0) {
        $product = mysqli_fetch_object($result);

do_html_head('APP NAME', $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav('APP NAME');

?>
<div class="bg-dark shadow-lg" style="width: 550px;position: fixed;right: 20px;bottom: 0;z-index: 10;">
    <div class="h4 text-center pt-2 text-white" role="button" id="chat-box-toggle">Message</div>
    <div class="bg-white" id="chat-box" style="height: 400px;display: none;">
        <?php 
        if(isset($_SESSION['username'])):
            $user_id = $_SESSION['user_id'];
        ?>
        <div class="d-flex h-100">
            <div class="border-right" style="min-width: 175px;">
                <ul class="list-group list-group-flush border-bottom" id="user-list">
                    <?php
                    $query = "SELECT id, username, position FROM users WHERE id <> $user_id AND position <> 'customer'";
                    $result = mysqli_query($conn, $query);

                    if($result) {
                        $num_row = mysqli_num_rows($result);

                        for ($i=0; $i < $num_row; $i++) {
                            $row = mysqli_fetch_assoc($result);
                    ?>
                    <li type="button" class="list-group-item list-group-item-action" data-uid="<?= $row['id'] ?>" data-name="<?= ($row['position'] == 'admin' ? '<i class=\'fas fa-user-cog m-2\'></i>' : '<i class=\'fas fa-user-tag m-2\'></i>' ) . ucfirst($row['username']) ?>">
                        <div class="d-flex">
                            <div class="my-auto mr-3 align-middle">
                                <?php if($row['position'] == 'admin') { ?>
                                    <i class="fas fa-user-cog"></i>
                                <?php } elseif($row['position'] == 'seller') { ?>
                                    <i class="fas fa-user-tag"></i>
                                <?php } else { ?>
                                    <i class="fas fa-user"></i>
                                <?php } ?>
                            </div>
                            <div class="d-flex flex-column">
                                <div><?= ucfirst($row['username']) ?></div>
                                <small style="font-size: 10px;" class="text-muted">
                                    <?php if($row['position'] == 'admin') { ?>
                                        Administration
                                    <?php } elseif($row['position'] == 'seller') { ?>
                                        Seller
                                    <?php } else { ?>
                                        ???
                                    <?php } ?>
                                </small>
                            </div>
                        </div>
                    </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="d-flex flex-column h-100 justify-content-between w-100">
                <div class="bg-white border-bottom p-2 font-weight-bold" id="receiver_name">
                    <i class="fas fa-user-tag m-2"></i><?= ucfirst($product->username) ?>
                </div>
                <div class="d-flex flex-column bg-light h-100 overflow-auto p-2" id="chat-msg"></div>
                <div class="d-flex">
                    <input type="text" id="chat-input" class="form-control rounded-0" placeholder="Type a message" data-receiver="<?= $product->prdt_seller ?>">
                    <button role="button" class="btn btn-dark rounded-0" id="send-btn"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="h-100 align-items-center d-flex justify-content-center text-white flex-column bg-secondary">
            <p>To use this function you need to login first!</p>
            <a href="login.php" class="btn btn-outline-light">Login / Register</a>
        </div>
        <?php endif; ?>
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-9">
            <div class="bg-white mb-3">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="m-1">
                            <img src="<?= $product->prdt_image ?>" alt="" class="img-fluid overflow-hidden">
                        </div>
                    </div>
                    <div class="col-12 col-md-7 pl-0 pr-4">
                        <div class="m-1">
                            <h3><?= $product->prdt_name ?></h3>
                            <div style="color: #fd7e14;font-size: 2rem;">
                                RM <?= number_format(floatval($product->prdt_sellPrice), 2) ?>
                            </div>
                            <input type="hidden" name="product_id" value="<?= $product_id ?>">
                            <div class="row">
                                <div class="col-3">
                                    <div class="text-muted">Quantity</div>
                                </div>
                                <div class="col-9">
                                    <div class="mb-2">
                                        <button id="minus-btn" class="btn btn-sm btn-warning" disabled>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input id="quantity" type="text" step="1" min="<?= ($product->prdt_quantity == 0) ? '0' : '1' ?>" value="<?= ($product->prdt_quantity == 0) ? '0' : '1' ?>" 
                                            max="<?= $product->prdt_quantity ?>" style="width:20px;" class="border-0 text-center">
                                        <button class="btn btn-sm btn-warning" id="add-btn" <?= ($product->prdt_quantity == 0) ? 'disabled' : '' ?>>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <span id="outStock" class="text-danger" style="font-size: 10px;"><?= ($product->prdt_quantity == 0) ? 'Out of stock' : '' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-block btn-warning text-white" id="btn-cart" <?= ($product->prdt_quantity == 0) ? 'disabled' : '' ?>>Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3">
            <div class="d-flex justify-content-between p-3" style="background-color: #fefefe;">
                <div>
                    <div class="text-muted" style="font-size: 0.7rem">Sold By</div>
                    <div><?= $product->username ?></div>
                </div>
                <button class="btn btn-sm btn-outline-primary" id="btn-chat"><i class="fas fa-comments"></i>Chat</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="bg-white">
        <div class="p-2 h4" style="background-color: #f2f2f2;">Produt Description</div>
        <style>
        .ck-sticky-panel{
            display: none;
        }
        </style>
        <textarea>
            <?= nl2br($product->prdt_desc) ?>
        </textarea>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( 'textarea' ) )
        .then( editor => {
            console.log( editor );
            editor.isReadOnly = true;
        } )
        .catch( error => {
            console.error( error );
    } );

    $(document).ready(function() {
        $("#btn-cart").click(function() {
            event.preventDefault();
            var product_id = $('input[name="product_id"]').val();
            var quantity = $('input#quantity').val();
            $.post({
                url: 'functions/customer/addCart.php',
                data: {
                    product_id: product_id,
                    quantity: quantity,
                },
                success: function (result) {
                    if(result.status == 1) {
                        swal({
                            title: "Something Wrong!",
                            text: "To add cart, You need to login first!",
                            icon: "info",
                            buttons: true,
                        }).then((bool) => {
                            window.location.assign('login.php');
                            // window.location.assign('login.php?request_url='+ window.location.href);
                        });
                    }else if(result.status == 0){
                        $('#crt_qty').html(''+result.crt_quantity);
                        $('#quantity_left').html('quantity left '+ result.quantity_left);
                        $('#quantity').attr('max', result.quantity_left);
                        $('#quantity').val(1);
                        $('#minus-btn').prop('disabled', true);
                        swal({
                            icon: "success",
                            title: "Success",
                            text: result.msg,
                            timer: 1100,
                            buttons: false,
                        });
                        if(result.quantity_left == 0) {
                            $('#outStock').html('Out of stock');
                            $('#btn-cart').prop('disabled', true);
                            $('#minus-btn').prop('disabled', true);
                            $('#add-btn').prop('disabled', true);
                            $('#quantity').val(0);
                        }
                    }else if(result.status == 2){
                        swal({
                            icon: "warning",
                            title: "Success",
                            text: result.msg,
                            timer: 1100,
                            buttons: false,
                        });
                    }
                }
            });
        });

        $('#add-btn').click(function() {
            var quantity =  parseInt($('#quantity').val());
            var max = parseInt($('#quantity').attr('max'));
            if(quantity < max) {
                quantity++;
                $('#quantity').val(quantity);

                if(quantity == max)
                    $(this).prop('disabled', true);
            }

            if($('#minus-btn').prop('disabled'))
                $('#minus-btn').prop('disabled', false);
        });

        $('#minus-btn').click(function() {
            var quantity =  parseInt($('#quantity').val());
            var max = parseInt($('#quantity').attr('max'));

            if(quantity > 1) {
                quantity--;
                $('#quantity').val(quantity);
            }

            if(quantity <= 1)
                $(this).prop('disabled', true);
            
            if($('#add-btn').prop('disabled'))
                $('#add-btn').prop('disabled', false);
        });

        var f_toggle = true;
        $('#chat-box-toggle').click(function() {
            <?php if(isset($_SESSION['user_id'])): ?>
            if(f_toggle) {
                var receiver = <?= $product->prdt_seller ?>;
                updateChatBox(receiver);
                f_toggle = false;
            }
            <?php endif; ?>
            $('#chat-box').fadeToggle();
        });

        $('#btn-chat').click(function() {
            <?php if(isset($_SESSION['user_id'])): ?>
            if(f_toggle) {
                var receiver = <?= $product->prdt_seller ?>;
                updateChatBox(receiver);
                f_toggle = false;
            }
            <?php endif; ?>
            $('#chat-box').fadeIn();
        });
        <?php
        if(isset($_SESSION['user_id'])) {
        ?>

        $('#user-list').on('click', 'li', function() {
            var uid = $(this).data('uid');
            var title = $(this).data('name');
            $('#chat-input').data('receiver', ''+ uid);
            $('#receiver_name').html(title);

            updateChatBox(uid);
        });

        $('#send-btn').click(function() {
            var msg = $('#chat-input').val();
            var receiver = $('#chat-input').data('receiver');
            $('#chat-input').val('');
            if(msg) {
                sendMessage(msg, receiver);
            }
        });

        $('#chat-input').keydown(function(event) {
            if (event.keyCode === 13) {
                var msg = $('#chat-input').val();
                var receiver = $('#chat-input').data('receiver');
                $('#chat-input').val('');

                if(msg) {
                    sendMessage(msg, receiver);
                }
            }
        });

        function sendMessage(msg, receiver) {
            $.post({
                url: 'functions/sendMsg.php',
                data: {
                    msg: msg,
                    sender_id: <?= $user_id ?>,
                    receiver_id: receiver,
                },
                success: function(result){

                },
                error: function(){
                    console.log("error sending");
                }
            });
            updateChatBox(receiver);
        }
        
        function updateChatBox(receiver) {
            $.get({
                url: './functions/chat-msg.php',
                data: {
                    receiver_id: receiver,
                },
                success: function(result){
                    $('#chat-msg').html(result);
                    var chatbox = document.getElementById("chat-msg");
                    chatbox.scrollTop = chatbox.scrollHeight;
                },
            });
        }
        <?php } ?>
    });
</script>

<?php
do_html_end();
    } else {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    }
}