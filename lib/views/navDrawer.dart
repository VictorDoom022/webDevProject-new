
import 'package:flutter/material.dart';
import 'package:flutter_session/flutter_session.dart';
import 'package:myapp/views/userLists.dart';

import 'login.dart';

Widget navDrawer(BuildContext context){

  dynamic username =  FlutterSession().get("username");

  return Drawer(
    child: ListView(
      padding: EdgeInsets.zero,
      children: [
        DrawerHeader(
          child: Text(username.toString()),
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
            MaterialPageRoute(builder: (context) => login());
          },
        )
      ],
    ),
  );
}