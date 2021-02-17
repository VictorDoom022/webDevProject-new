import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:myapp/controllers/checkSession.dart';
import 'package:myapp/views/initLoading.dart';
import 'package:myapp/views/login.dart';
import 'package:myapp/views/userLists.dart';


void main() => runApp(
  MaterialApp(
    initialRoute: '/',
    routes: {
      '/':(context) => initLoading(),
      '/login':(context) => login(),
      '/userList':(context) => userList(),
    },
  )

);

