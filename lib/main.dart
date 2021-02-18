import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:myapp/views/admin/userLists.dart';
import 'package:myapp/views/initLoading.dart';
import 'package:myapp/views/login.dart';
import 'package:myapp/views/seller/sellerHome.dart';


void main() => runApp(
  MaterialApp(
    initialRoute: '/',
    routes: {
      '/':(context) => initLoading(),
      '/login':(context) => login(),
      '/userList':(context) => userList(),
      '/sellerHome':(context) => sellerHome(),
    },
  )

);

