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
        chatReceiver: json['chatReceiver'] as String,
        chatMsg: json['chatMsg'] as String,
        chatSendDate: json['chatSendDate'] as String,
        whoSend: json['whoSend'] as String
    );
  }
}