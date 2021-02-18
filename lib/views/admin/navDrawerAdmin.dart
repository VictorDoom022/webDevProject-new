import 'package:flutter/material.dart';
import 'package:myapp/views/admin/adminChat.dart';
import 'package:myapp/views/admin/userLists.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../login.dart';

class navDrawerAdmin extends StatefulWidget {
  @override
  _navDrawerAdminState createState() => _navDrawerAdminState();
}

class _navDrawerAdminState extends State<navDrawerAdmin> {

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
              Navigator.push(
                context,
                new MaterialPageRoute(builder: (context) => userList())
              );
            },
          ),
          ListTile(
            leading: Icon(Icons.message_outlined),
            title: Text('Chat'),
            onTap: () {
              Navigator.pop(context);
              Navigator.push(
                  context,
                  new MaterialPageRoute(builder: (context) => adminChat())
              );
            },
          ),
          Divider(),
          ListTile(
            leading: Icon(Icons.exit_to_app),
            title: Text('Log Out'),
            onTap: () {
              logout();
              Navigator.pop(context);
              Navigator.push(
                  context,
                  new MaterialPageRoute(builder: (context) => login())
              );
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