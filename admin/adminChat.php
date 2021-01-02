<?php
include_once('../config/bootstrap.php');
require_once('../config/connect_db.php');
session_start();
include_once('../functions/checkSession.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <?php echo $jQueryJS;?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<link rel="stylesheet" href="layouts/navBar.css"/>
<link rel="stylesheet" href="layouts/chats.css"/>
<body>
<?php
include_once('../config/bootstrap.php');
include_once('../config/connect_db.php');
?>
    <?php
        $pageName = $pageTitle = 'Admin';
        include 'layouts/adminSideNav.php';
        include 'layouts/adminTopNav.php';
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
                                        <?php if($row['id'] == $_SESSION["user_id"]) {?>
                                            <div class="chat_list" style="display:none" onclick="changePage('<?php echo $row['id']; ?>');">
                                        <?php }else{?>
                                            <div class="chat_list" onclick="changePage('<?php echo $row['id']; ?>');">
                                        <?php } ?> 
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
                                    <?php
                                        $receiverID="";
                                        if(isset($_GET['receiverID'])){
                                            $receiverID = $_GET['receiverID'];
                                        }

                                        $sql = "SELECT chat.cht_sender, chat.cht_receiver, chat.cht_msg AS chatMsg, chat.cht_sendDate AS chatSendDate, users .username AS username,
                                        IF (chat.cht_receiver = '" .$_SESSION["user_id"]."','receiver', 'sender') AS whoSend
                                        FROM chat 
                                        LEFT JOIN users ON cht_sender = users.id
                                        WHERE 
                                        (cht_receiver = '" .$receiverID."' AND cht_sender = '" .$_SESSION["user_id"]. "')
                                        OR
                                        (cht_receiver = '" .$_SESSION["user_id"]."' AND cht_sender = '" .$receiverID. "')
                                        ORDER BY cht_sendDate ASC";
                                        $result = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                $sendDate = $row['chatSendDate'];
                                                $whoSend = $row['whoSend'];
                                                $chatMsg = $row['chatMsg'];
                                                $username = $row['username'];
                                    ?>
                                        <!-- start of received msg -->
                                        <?php
                                            if($whoSend == 'receiver'){
                                        ?>
                                        <div class="incoming_msg">
                                            <div class="incoming_msg_img"> 
                                                <img src="https://ptetutorials.com/images/user-profile.png"> 
                                            </div>
                                            <div class="received_msg">
                                                <div class="received_withd_msg">
                                                    <p>
                                                        <?php echo $chatMsg ?>
                                                    </p>
                                                    <span class="time_date"><?php echo $sendDate ?> | <?php echo $username ?> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                            if($whoSend == 'sender'){
                                        ?>
                                        <!-- end of received msg -->
                                        <!-- start of sent msg -->
                                        <div class="outgoing_msg">
                                            <div class="sent_msg">
                                                <p><?php echo $chatMsg ?></p>
                                                <span class="time_date"> <?php echo $sendDate ?> | <?php echo $username ?></span> 
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <!-- end of sent msg -->
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="type_msg">
                                    <div class="input_msg_write">
                                        <input type="text" id="write_msg" class="write_msg" placeholder="Type a message" />
                                        <button onclick="sendMessage('<?php echo $_SESSION['user_id'] ?>', '<?php echo $receiverID; ?>');" class="msg_send_btn" type="button">
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
function changePage(user_id){
    window.location.href = 'adminChat.php?receiverID='+user_id;
}

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
            $(".inbox_msg").load(document.URL + " .inbox_msg");
            $(".write_msg").val('');
        },
        error: function(){
            console.log("error sending");
        }
    });
}
</script>
</html>