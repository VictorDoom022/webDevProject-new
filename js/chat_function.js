function updateChatBox(receiver) {
    $.get({
        url: './../functions/chat-msg.php',
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

function sendMessage(msg, receiver, sender) {
    $.post({
        url: './../functions/sendMsg.php',
        data: {
            msg: msg,
            sender_id: sender,
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