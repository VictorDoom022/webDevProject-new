
import 'package:flutter/material.dart';
import 'package:myapp/views/userLists.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'login.dart';

Widget navDrawer(BuildContext context) {

  return Drawer(
    child: ListView(
      padding: EdgeInsets.zero,
      children: [
        DrawerHeader(
          child: Text(userDetail().toString()),
        ),
        ListTile(
          title: Text('User Lists'),
          onTap: () {
            Navigator.pop(context);
            MaterialPageRoute(builder: (context) => userList());
          },
        ),
        ListTile(
          title: Text('Log Out'),
          onTap: () {
            logout();
            Navigator.pop(context);
            MaterialPageRoute(builder: (context) => login());
          },
        )
      ],
    ),
  );
}

Future logout() async{
  final prefs =  await SharedPreferences.getInstance();

  prefs.remove("username");
  prefs.remove("position");
  prefs.remove("email");
  prefs.remove("create_date");
}

Future userDetail() async{
  final prefs =  await SharedPreferences.getInstance();
  final username = prefs.getString("username");
  return username;
}