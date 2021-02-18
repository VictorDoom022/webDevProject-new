import 'package:flutter/material.dart';
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
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Chat Lists"),
      ),
      drawer: navDrawerAdmin(),
    );
  }
}
