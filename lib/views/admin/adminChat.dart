import 'package:flutter/material.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:myapp/controllers/admin/fetchUsers.dart';
import 'package:myapp/model/userClass.dart';
import 'package:myapp/views/admin/navDrawerAdmin.dart';

class adminChat extends StatefulWidget {
  @override
  _adminChatState createState() => _adminChatState();
}

class _adminChatState extends State<adminChat> {
  @override
  Widget build(BuildContext context) {
    final appTitle = "Chat Lists";
    return MaterialApp(
      title: appTitle,
      home: adminChatList(),
    );
  }
}

class adminChatList extends StatefulWidget {
  @override
  _adminChatListState createState() => _adminChatListState();
}

class _adminChatListState extends State<adminChatList> {

  Future<List<Users>> futureUsers;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    futureUsers = getUsers();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Chat Lists"),
      ),
      body: FutureBuilder<List<Users>>(
        future: futureUsers,
        builder: (context, snapshot){
          if(snapshot.hasError) print(snapshot.error);

          if(snapshot.hasData){
            return adminUserChatList(users: snapshot.data);
          }else{
            return Center(child: SpinKitCircle(color: Colors.cyan, size: 70.0,));
          }
        },
      ),
      drawer: navDrawerAdmin(),
    );
  }
}

class adminUserChatList extends StatelessWidget {

  final List<Users> users;

  adminUserChatList({Key key, this.users}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
        itemCount: users.length,
        itemBuilder: (context, index){
          return Card(
            child: InkWell(
              onTap: (){
                print('Tap');
              },
              child: Container(
                height: 80,
                child: Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: Row(
                    children: [
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Align(
                            alignment: Alignment.centerLeft,
                            child: Text(
                              users[index].username,
                              style: TextStyle(
                                fontSize: 28,
                              ),
                            ),
                          ),
                          SizedBox(height: 5),
                          Align(
                            alignment: Alignment.centerLeft,
                            child: Text(
                              users[index].position,
                              style: TextStyle(
                                  fontSize: 20,
                                  fontWeight: FontWeight.w300
                              ),
                            ),
                          )
                        ],
                      )
                    ],
                  ),
                ),
              ),
            ),
          );
        }
    );
  }
}

