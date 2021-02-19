import 'package:flutter/material.dart';
import 'package:flutter_easyrefresh/easy_refresh.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:myapp/controllers/getChatData.dart';
import 'package:myapp/controllers/sendMessage.dart';
import 'package:myapp/model/chatClass.dart';
import 'package:myapp/views/seller/navDrawerSeller.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:dash_chat/dash_chat.dart';

class chatDetail extends StatefulWidget {

  final userID, username;

  chatDetail({Key key, this.userID, this.username}) : super(key: key);

  @override
  _chatDetailState createState() => _chatDetailState(userID,username);
}

class _chatDetailState extends State<chatDetail> {

  final userID, username;

  _chatDetailState(this.userID, this.username);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: username,
      theme: ThemeData(
        primaryColor: Colors.black
      ),
      home: Scaffold(
        appBar: AppBar(
          title: Text(username),
        ),
        body: chats(userID: userID,username: username),
        drawer: navDrawerSeller(),
      ),
    );
  }
}


class chats extends StatefulWidget {

  final userID, username;

  chats({Key key, this.userID, this.username}) : super(key: key);

  @override
  _chatsState createState() => _chatsState(userID, username);
}

class _chatsState extends State<chats> {

  final userID;
  final username;

  _chatsState(this.userID, this.username);

  Future<List<Chats>> futureChats;

  String loggedInUser;
  String loggedInUserId;
  SharedPreferences sharedPreferences;

  void initState(){
    super.initState();
    getPrefsID().then((value) => {
      getPrefsUsername().then((value) => {
        checkUser()
      })
    });

    futureChats = fetchChatData(userID);
  }

  Future<void> pullRefresh() async{
    List<Chats> refreshedFutureChat = await fetchChatData(userID);
    setState(() {
      futureChats = Future.value(refreshedFutureChat);
    });
  }

  Future<String>getPrefsID() async{
    sharedPreferences = await SharedPreferences.getInstance();
    loggedInUser = sharedPreferences.getString("username");
    loggedInUserId = sharedPreferences.getString("id");

    return loggedInUserId;
  }

  Future<String>getPrefsUsername() async{
    sharedPreferences = await SharedPreferences.getInstance();
    loggedInUser = sharedPreferences.getString("username");

    return loggedInUser;
  }

  checkUser(){
    print(loggedInUserId);
    print(userID);
    if(loggedInUserId == userID){
      print('No chat yourself');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: FutureBuilder<List<Chats>>(
        future: futureChats,
        builder: (context, snapshot){
          if(snapshot.hasError) print(snapshot.error);

          if(snapshot.hasData){
            return RefreshIndicator(
                onRefresh: pullRefresh,
                child: chatBoxes(chatData: snapshot.data, userID: userID, loggedInUserId: loggedInUserId));
          }else{
            return Center(child: SpinKitCircle(color: Colors.black, size: 70.0,));
          }
        },
      ),
    );
  }
}

class chatBoxes extends StatefulWidget {

  final List<Chats> chatData;
  final userID, loggedInUserId;

  const chatBoxes({Key key, this.chatData, this.userID, this.loggedInUserId}) : super(key: key);

  @override
  _chatBoxesState createState() => _chatBoxesState();
}

class _chatBoxesState extends State<chatBoxes> {
  @override
  Widget build(BuildContext context) {

    final TextEditingController messageController = TextEditingController();

    return Stack(
      children: [
        ListView.builder(
            itemCount: widget.chatData.length,
            shrinkWrap: true,
            reverse: false,
            itemBuilder: (context, index){
              return Container(
                padding: EdgeInsets.only(left: 14, right: 14, top: 10, bottom: 10),
                child: Align(
                  alignment: (widget.chatData[index].whoSend=="receiver"?Alignment.topLeft:Alignment.topRight),
                  child: Container(
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(20),
                      color: (widget.chatData[index].whoSend=="receiver"?Colors.grey.shade200:Colors.blue[200]),
                    ),
                    padding: EdgeInsets.all(16),
                    child: Text(
                      widget.chatData[index].chatMsg,
                      style: TextStyle(
                        fontSize: 15
                      ),
                    ),
                  ),
                ),
              );
            }
        ),
        Align(
          alignment: Alignment.bottomLeft,
          child: Container(
            padding: EdgeInsets.only(left: 10,bottom: 10,top: 10),
            height: 60,
            width: double.infinity,
            color: Colors.white,
            child: Row(
              children: <Widget>[
                Expanded(
                  child: TextField(
                    controller: messageController,
                    decoration: InputDecoration(
                        hintText: "Write message...",
                        hintStyle: TextStyle(color: Colors.black54),
                        border: InputBorder.none
                    ),
                  ),
                ),
                SizedBox(width: 15,),
                FloatingActionButton(
                  onPressed: (){
                    sendMessage(widget.loggedInUserId, widget.userID, messageController.text);
                  },
                  child: Icon(Icons.send,color: Colors.white,size: 18,),
                  backgroundColor: Colors.blue,
                  elevation: 0,
                ),
              ],
            ),
          ),
        ),
      ]
    );
  }
}


