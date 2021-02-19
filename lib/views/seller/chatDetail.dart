import 'package:flutter/material.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:myapp/controllers/getChatData.dart';
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
            return chatBoxes(chatData: snapshot.data);
          }else{
            return Center(child: SpinKitCircle(color: Colors.black, size: 70.0,));
          }
        },
      ),
    );
  }
}

class chatBoxes extends StatelessWidget {

  final List<Chats> chatData;

  const chatBoxes({Key key, this.chatData}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Stack(
      children: [
        ListView.builder(
            itemCount: chatData.length,
            shrinkWrap: true,
            reverse: false,
            physics: NeverScrollableScrollPhysics(),
            itemBuilder: (context, index){
              return Container(
                padding: EdgeInsets.only(left: 14, right: 14, top: 10, bottom: 10),
                child: Align(
                  alignment: (chatData[index].whoSend=="receiver"?Alignment.topLeft:Alignment.topRight),
                  child: Container(
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(20),
                      color: (chatData[index].whoSend=="receiver"?Colors.grey.shade200:Colors.blue[200]),
                    ),
                    padding: EdgeInsets.all(16),
                    child: Text(
                      chatData[index].chatMsg,
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
                    decoration: InputDecoration(
                        hintText: "Write message...",
                        hintStyle: TextStyle(color: Colors.black54),
                        border: InputBorder.none
                    ),
                  ),
                ),
                SizedBox(width: 15,),
                FloatingActionButton(
                  onPressed: (){},
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


