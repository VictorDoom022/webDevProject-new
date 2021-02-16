import 'package:flutter/material.dart';
import 'package:myapp/views/login.dart';
import 'package:myapp/views/userLists.dart';
import 'package:shared_preferences/shared_preferences.dart';

Future<void> checkSession(BuildContext context) async {

  final prefs = await SharedPreferences.getInstance();

  final username = prefs.getString("username");
  final email = prefs.getString("email");
  final position = prefs.getString("position");
  print("Current log in position : " +  position);
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