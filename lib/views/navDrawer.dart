
import 'package:flutter/material.dart';
import 'package:myapp/views/userLists.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'login.dart';

class navDrawer extends StatefulWidget {
  @override
  _navDrawerState createState() => _navDrawerState();
}

class _navDrawerState extends State<navDrawer> {

  SharedPreferences sharedPrefs;
  String username = "";
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    sharedPrefsFunc().then((value) => {
      username = value
    });
  }

  Future<String> sharedPrefsFunc() async{
    sharedPrefs = await SharedPreferences.getInstance();
    return sharedPrefs.getString("username");
  }

  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: ListView(
        padding: EdgeInsets.zero,
        children: [
          DrawerHeader(
            child: Center(
              child: Text(
                'Welcome, ' + username,
                style: TextStyle(
                    fontSize: 30.0
                ),
              ),
            ),
          ),
          ListTile(
            leading: Icon(Icons.list),
            title: Text('User Lists'),
            onTap: () {
              Navigator.pop(context);
              MaterialPageRoute(builder: (context) => userList());
            },
          ),
          Divider(),
          ListTile(
            leading: Icon(Icons.exit_to_app),
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
}

Future logout() async{
  final prefs =  await SharedPreferences.getInstance();

  prefs.remove("username");
  prefs.remove("position");
  prefs.remove("email");
  prefs.remove("create_date");
}

Future<String> userDetail() async{
  final prefs =  await SharedPreferences.getInstance();
  final username = prefs.getString("username");
  return username;
}