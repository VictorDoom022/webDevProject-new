<?php
include_once('../config/bootstrap.php');
session_start();
include_once('../functions/checkSession.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <?php echo $bootstrapCSS; echo $jQueryJS; echo $bootstrapJS; echo $fontAwsomeIcons ?>
</head>
    <link rel="stylesheet" href="layouts/navBar.css"/>
<body>
    <?php
        $pageName = $pageTitle = 'Chat';
        include 'layouts/sellerSideNav.php';
        include 'layouts/sellerTopNav.php';
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
                            <i class="fas fa-user-tag m-2"></i>(The receiver name)
                        </div>
                        <div class="d-flex flex-column bg-light h-100 overflow-auto p-2" id="chat-msg"></div>
                        <div class="d-flex">
                            <input type="text" id="chat-input" class="form-control rounded-0"
                                placeholder="Type a message" data-receiver="<?= 'receiver_id' ?>">
                            <button role="button" class="btn btn-dark rounded-0" id="send-btn">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>