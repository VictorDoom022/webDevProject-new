import 'package:flutter/material.dart';

class editUserPage extends StatefulWidget {

  final data;

  editUserPage({Key key, this.data}) : super(key: key);

  @override
  _editUserPageState createState() => _editUserPageState();
}

class _editUserPageState extends State<editUserPage> {
  @override
  Widget build(BuildContext context) {
    return Container(
      child: Text(widget.data.id + widget.data.username),
    );
  }
}
