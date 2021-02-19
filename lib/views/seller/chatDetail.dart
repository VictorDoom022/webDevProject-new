import 'package:flutter/material.dart';
import 'package:myapp/views/seller/navDrawerSeller.dart';
import 'package:shared_preferences/shared_preferences.dart';

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
    return Container();
  }
}

