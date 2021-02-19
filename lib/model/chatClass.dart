class Chats {
  final String chatSender;
  final String chatReceiver;
  final String chatMsg;
  final String chatSendDate;
  final String whoSend;


  Chats({this.chatSender, this.chatReceiver, this.chatMsg, this.chatSendDate,
      this.whoSend});

  factory Chats.fromJson(Map<String, dynamic> json){
    return Chats(
        chatSender: json['chatSender'] as String,
        chatReceiver: json['chatSender'] as String,
        chatMsg: json['chatSender'] as String,
        chatSendDate: json['chatSender'] as String,
        whoSend: json['chatSender'] as String
    );
  }
}