<?php
require_once('../../config/connect_db.php');
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $receiver_id = $_GET['receiver_id'];

    $query = "SELECT cht_sender, cht_receiver, cht_msg, cht_sendDate,
        IF (chat.cht_receiver = '$user_id','receiver', 'sender') AS whoSend
        FROM chat WHERE
        (cht_receiver = '$receiver_id' AND cht_sender = '$user_id')
        OR
        (cht_receiver = '$user_id' AND cht_sender = '$receiver_id')";
    $result = mysqli_query($conn, $query);
    if($result) {
        $num_row = mysqli_num_rows($result);

        for ($i=0; $i < $num_row; $i++) {
            $chat = mysqli_fetch_assoc($result);
            if($chat['whoSend'] == 'receiver') {
    ?>
        <div class="d-flex mb-3">
            <div class="d-flex flex-column">
                <div class="rounded-right p-2 text-wrap bg-white shadow-sm">
                    <?= $chat['cht_msg'] ?>
                </div>
                <div class="small text-muted"><?= $chat['cht_sendDate'] ?></div>
            </div>
        </div>
    <?php }else{ ?>
        <div class="d-flex mb-3 justify-content-end">
            <div class="d-flex flex-column">
                <div class="rounded-left p-2 text-wrap bg-primary text-white shadow-sm">
                    <?= $chat['cht_msg'] ?>
                </div>
                <div class="small text-muted text-right"><?= $chat['cht_sendDate'] ?></div>
            </div>
        </div>
    <?php }
        }
    }
}