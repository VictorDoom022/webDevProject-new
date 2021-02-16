import 'package:flutter/material.dart';
import 'package:flutter_session/flutter_session.dart';
import 'package:myapp/views/login.dart';
import 'package:myapp/views/userLists.dart';

Future<void> checkSession(BuildContext context) async {
  dynamic username;
  dynamic email;
  dynamic position;

  username = await FlutterSession().get("username");
  email = await FlutterSession().get("email");
  position = await FlutterSession().get("position");
  print("Current log in position : " + await position);
  if(username == null){
    Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => login())
    );
  }else{
    Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => userList())
    );

  }
}