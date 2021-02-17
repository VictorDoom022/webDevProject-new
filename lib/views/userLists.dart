import 'package:flutter/material.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:myapp/controllers/checkSession.dart';
import 'package:myapp/controllers/deleteUser.dart';
import 'package:myapp/controllers/fetchUsers.dart';
import 'package:myapp/model/userClass.dart';
import 'package:http/http.dart' as http;
import 'package:myapp/views/navDrawer.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'addUserPage.dart';

class userList extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    final appTitle = 'User List Demo';

    return MaterialApp(
      title: appTitle,
      home: MyHomePage(title: appTitle),
    );
  }
}

class MyHomePage extends StatefulWidget {
  final String title;

  MyHomePage({Key key, this.title}) : super(key: key);

  @override
  _MyHomePageState createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {

  SharedPreferences sharedPrefs;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.title),
      ),
      body: FutureBuilder<List<Users>>(
        future: fetchUsers(http.Client()),
        builder: (context, snapshot) {
          if (snapshot.hasError) print(snapshot.error);

          return snapshot.hasData ? UsersLists(users: snapshot.data) : Center(child: SpinKitCircle(color: Colors.cyan, size: 70.0,));
        },
      ),
      drawer: navDrawer(),
      floatingActionButton: FloatingActionButton(
        onPressed: (){
          Navigator.push(
              context,
              MaterialPageRoute(
                  builder: (context){
                    return addUserPage();
                  }
              )
          );
        },
        child: Icon(Icons.add),
      ),
    );
  }
}

class UsersLists extends StatelessWidget {
  final List<Users> users;

  UsersLists({Key key, this.users}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
      itemCount: users.length,
      itemBuilder: (context, index){
        return Card(
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              ListTile(
                leading: Icon(Icons.account_circle),
                title: Text(
                  users[index].username,
                  style: TextStyle(
                      fontWeight: FontWeight.bold,
                      fontSize: 20
                  ),
                ),
                subtitle: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text('Position: '+users[index].position),
                    Text('Email: '+users[index].email),
                    Text('Create Date: '+users[index].create_date),

                    Padding(
                      padding: const EdgeInsets.fromLTRB(0, 5, 0, 0),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.end,
                        children: [
                          TextButton.icon(
                              onPressed: null,
                              icon: Icon(
                                Icons.settings_rounded,
                                color: Colors.greenAccent,
                              ),
                              label: Text('Edit')
                          ),
                          TextButton.icon(
                              onPressed: (){
                                showDialog(
                                    context: context,
                                    builder: (context){
                                      return AlertDialog(
                                        title: Text('Confirm delete'),
                                        content: Text('Are you sure you want to delete?'),
                                        actions: <Widget>[
                                          TextButton(
                                              child: Text('No'),
                                              onPressed: () {
                                                Navigator.of(context).pop();
                                              }
                                          ),
                                          TextButton(
                                              child: Text('Yes'),
                                              onPressed: () async {
                                                Navigator.of(context).pop();
                                                await deleteUser(users[index].id);
                                              }
                                          ),
                                        ],
                                      );
                                    }
                                );
                              },
                              icon: Icon(
                                Icons.delete,
                                color: Colors.red,
                              ),
                              label: Text('Delete')
                          ),
                        ],
                      ),
                    )
                  ],
                ),
              )
            ],
          ),
        );
      },
    );
  }
}
//users[index].username