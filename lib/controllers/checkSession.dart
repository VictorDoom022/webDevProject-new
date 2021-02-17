import 'package:flutter/material.dart';
import 'package:myapp/views/login.dart';
import 'package:shared_preferences/shared_preferences.dart';

Future<void> checkSession(BuildContext context) async {

  final prefs = await SharedPreferences.getInstance();

  final username = prefs.getString("username").toString();
  final email = prefs.getString("email");
  final position = prefs.getString("position");
  print("Current log in position : " +  position);
  if(username.toString() == null){
    Navigator.pushReplacementNamed(
        context,
        '/login'
    );
  }else{
    Navigator.pushReplacementNamed(
        context,
        '/userList'
    );

  }
}