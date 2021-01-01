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
    <?php echo $bootstrapCSS; echo $jQueryJS; echo $bootstrapJS; echo $fontAwsomeIcons ?>
</head>
    <link rel="stylesheet" href="layouts/navBar.css"/>
    <link rel="stylesheet" href="layouts/chats.css"/>
<body>
    <?php
        $pageName = $pageTitle = 'Chat';
        include 'layouts/sellerSideNav.php';
        include 'layouts/sellerTopNav.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <main class="col-md-10">
                <div class="row">
                    <div class="col-md-12 px-0">
                     
                        <div class="inbox_msg">
                            <div class="inbox_people">
                                <div class="inbox_chat">
                                    <?php
                                        $sql = "SELECT * FROM users";
                                        $result = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <div class="chat_list">
                                            <div class="chat_people">
                                                <div class="chat_img"> 
                                                    <img src="https://ptetutorials.com/images/user-profile.png" > 
                                                </div>
                                                <div class="chat_ib">
                                                    <h5>
                                                        <?php echo $row['username'] ?>
                                                        <span class="chat_date">Dec 25</span>
                                                    </h5>
                                                    <p>msg</p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>