<?php
require_once('connect_db.php');

$receiverID = $_POST['receiverID'];
$userID = $_POST['userID'];


$sql = "SELECT chat.cht_sender AS chatSender, chat.cht_receiver AS chatReceiver, chat.cht_msg AS chatMsg, chat.cht_sendDate AS chatSendDate,
IF (chat.cht_receiver = '$userID','receiver', 'sender') AS whoSend
FROM chat 
LEFT JOIN users ON cht_sender = users.id
WHERE 
(cht_receiver = '$receiverID' AND cht_sender = '$userID')
OR
(cht_receiver = '$userID' AND cht_sender = '$receiverID')
ORDER BY cht_sendDate ASC";
$result = mysqli_query($conn, $sql);

$data = array();

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
}

echo json_encode($data);
?>