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
    <?php echo $bootstrapCSS; echo $jQueryJS; echo $jQueryFormJS; echo $bootstrapJS; echo $fontAwsomeIcons ?>
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

                            <div class="mesgs">
                                <div class="msg_history">
                                    <div class="incoming_msg">
                                        <div class="incoming_msg_img"> 
                                            <img src="https://ptetutorials.com/images/user-profile.png"> 
                                        </div>
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
                                                <p>We work directly with our designers and suppliers,
                                                    and sell direct to you, which means quality, exclusive
                                                    products, at a price anyone can afford.</p>
                                                <span class="time_date"> 11:01 AM    |    Today</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="outgoing_msg">
                                        <div class="sent_msg">
                                            <p>Apollo University, Delhi, India Test</p>
                                            <span class="time_date"> 11:01 AM    |    Today</span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="type_msg">
                                    <div class="input_msg_write">
                                        <input type="text" id="write_msg" class="write_msg" placeholder="Type a message" />
                                        <button onclick="sendMessage('<?php echo $_SESSION['user_id'] ?>', '1');" class="msg_send_btn" type="button">
                                            <i class="fas fa-arrow-circle-right" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
<script>
function sendMessage(user_id, receiver_id){
    var msg = document.getElementById('write_msg').value;
    console.log(user_id);
    $.ajax({
        url: '../functions/seller/sendMsg.php',
        type: 'POST',
        data: { 
            'cht_sender' : user_id, 
            'receiver_id' : receiver_id,
            'msg' : msg
        },
        success: function(data){
            console.log("send success");
        },
        error: function(){
            console.log("error sending");
        }
    });
}
</script>
</html>