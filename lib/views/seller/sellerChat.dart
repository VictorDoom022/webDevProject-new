import 'package:flutter/material.dart';

import 'navDrawerSeller.dart';

class sellerChat extends StatefulWidget {
  @override
  _sellerChatState createState() => _sellerChatState();
}

class _sellerChatState extends State<sellerChat> {
  @override
  Widget build(BuildContext context) {
    final appTitle = "Chat Lists";
    return MaterialApp(
      title: appTitle,
      theme: ThemeData(
        primaryColor: Colors.black
      ),
      home: sellerChatList(),
    );
  }
}

class sellerChatList extends StatefulWidget {
  @override
  _sellerChatListState createState() => _sellerChatListState();
}

class _sellerChatListState extends State<sellerChatList> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Chat Lists"),
      ),
      drawer: navDrawerSeller(),
    );
  }
}

