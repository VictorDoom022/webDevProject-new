<?php
include_once('../config/bootstrap.php');
require_once('../config/connect_db.php');
session_start();
include_once('../functions/checkSession.php');

if(isset($_SESSION['username'])):
    $user_id = $_SESSION['user_id'];
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- CSS -->
    <link rel="stylesheet" href="layouts/navBar.css"/>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <?php echo $bootstrapCSS; echo $jQueryJS; echo $bootstrapJS; echo $fontAwsomeIcons ?>
</head>
<body>
    <?php
        $pageName = $pageTitle = 'Chat';
        include 'layouts/adminSideNav.php';
        include 'layouts/adminTopNav.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10 full-screen px-0">
                <div class="d-flex h-100">
                    <div class="border-right overflow-auto" style="min-width: 250px;">
                        <ul class="list-group list-group-flush border-bottom" id="user-list">
                            <?php
                            $query = "SELECT id, username, position FROM users WHERE id <> $user_id";
                            $result = mysqli_query($conn, $query);

                            if($result) {
                                $num_row = mysqli_num_rows($result);

                                for ($i=0; $i < $num_row; $i++) {
                                    $row = mysqli_fetch_assoc($result);
                                    if($i == 0) {
                                        $first_receiver_id = $row['id'];
                                        $first_receiver_name = $row['username'];
                                        $first_r_position = $row['username'];
                                    }
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
                                            <?php } elseif($row['position'] == 'customer') { ?>
                                                Customer
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
                    <div class="d-flex flex-column justify-content-between w-100">
                        <div class="bg-white border-bottom p-2 font-weight-bold" id="receiver_name">
                        <?php if($first_r_position == 'admin') { ?>
                            <i class="fas fa-user-cog m-2"></i>
                        <?php } elseif($first_r_position == 'seller') { ?>
                            <i class="fas fa-user-tag m-2"></i>
                        <?php } else { ?>
                            <i class="fas fa-user m-2"></i>
                        <?php } ?><?= ucfirst($first_receiver_name) ?>
                        </div>
                        <div class="d-flex flex-column bg-light h-100 overflow-auto p-2" id="chat-msg"></div>
                        <div class="d-flex">
                            <input type="text" id="chat-input" class="form-control rounded-0"
                                placeholder="Type a message" data-receiver="<?= $first_receiver_id ?>">
                            <button role="button" class="btn btn-dark rounded-0" id="send-btn">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="./../js/chat_function.js"></script>
    <script>
        $(document).ready(function() {
            updateChatBox(<?= $first_receiver_id ?>);

            $('#send-btn').click(function() {
                var msg = $('#chat-input').val();
                var receiver = $('#chat-input').data('receiver');
                $('#chat-input').val('');
                if(msg) {
                    sendMessage(msg, receiver, <?= $user_id ?>);
                }
            });

            $('#chat-input').keydown(function(event) {
                if (event.keyCode === 13) {
                    var msg = $('#chat-input').val();
                    var receiver = $('#chat-input').data('receiver');
                    $('#chat-input').val('');

                    if(msg) {
                        sendMessage(msg, receiver, <?= $user_id ?>);
                    }
                }
            });

            $('#user-list').on('click', 'li', function() {
                var uid = $(this).data('uid');
                var title = $(this).data('name');
                $('#chat-input').data('receiver', ''+ uid);
                $('#receiver_name').html(title);

                updateChatBox(uid);
            });
        });
    </script>
</body>
</html>