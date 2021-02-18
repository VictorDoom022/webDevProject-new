import 'package:flutter/material.dart';

class showAlertDialog extends StatefulWidget {

  final String AlertTitle, AlertMessage;

  showAlertDialog({Key key, this.AlertMessage, this.AlertTitle}) : super(key: key);

  @override
  _showAlertDialogState createState() => _showAlertDialogState(AlertTitle, AlertMessage);
}

class _showAlertDialogState extends State<showAlertDialog> {

  final AlertTitle, AlertMessage;

  _showAlertDialogState(this.AlertTitle, this.AlertMessage);

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: Text(AlertTitle),
      content: SingleChildScrollView(
        child: Text(AlertMessage),
      ),
      actions: [
        TextButton(
        child: Text('close'),
        onPressed: (){
          Navigator.of(context).pop();
          },
        )
      ],
    );
  }
}
