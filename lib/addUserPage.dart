import 'package:flutter/material.dart';
import 'package:email_validator/email_validator.dart';

class addUserPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    final appTitle = 'Add Users';
    return MaterialApp(
      title: appTitle,
      home: Scaffold(
        appBar: AppBar(
          title: Text(appTitle),
        ),
        body: userForm(),
      ),
    );
  }
}

class userForm extends StatefulWidget {
  @override
  _userFormState createState() => _userFormState();
}

class _userFormState extends State<userForm> {

  final _formKey = GlobalKey<FormState>();

  @override
  Widget build(BuildContext context) {

    String selected;

    return Column(
      mainAxisAlignment: MainAxisAlignment.start,
      children: [
        Form(
            key: _formKey,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Padding(
                  padding: EdgeInsets.fromLTRB(15, 0, 15, 0),
                  child: TextFormField(
                    decoration: InputDecoration(
                      icon: Icon(Icons.account_circle),
                      hintText: 'Enter Username'
                    ),
                    validator: (value){
                      if(value.isEmpty){
                        return 'Please enter some stuff';
                      }
                      return null;
                    },
                  ),
                ),
                Padding(
                  padding: EdgeInsets.fromLTRB(15, 0, 15, 0),
                  child: TextFormField(
                    obscureText: true,
                    decoration: InputDecoration(
                        icon: Icon(Icons.lock_rounded),
                        hintText: 'Enter Password'
                    ),
                    validator: (value){
                      if(value.trim().isEmpty){
                        return 'Please enter some stuff';
                      }
                      return null;
                    },
                  ),
                ),
                Padding(
                  padding: EdgeInsets.fromLTRB(15, 0, 15, 0),
                  child: TextFormField(
                    decoration: InputDecoration(
                        icon: Icon(Icons.mail),
                        hintText: 'Enter Email'
                    ),
                    validator: (value){
                      if(value.isEmpty && (EmailValidator.validate(value) == null)){
                        return 'Please enter some stuff';
                      }
                      return null;
                    },
                  ),
                ),
                Padding(
                  padding: EdgeInsets.fromLTRB(15, 0, 15, 0),
                  child: Stack(
                    children: [
                      DropdownButtonFormField(
                        items:["Seller", "Customer"].map(
                                (label) => DropdownMenuItem(
                              child: Text(label),
                              value: label,
                            )
                        ).toList(),
                        onChanged: (value){
                          setState(() {
                            selected = value;
                          });
                        },
                      ),
                      Container(
                        child: Padding(
                          padding: EdgeInsets.fromLTRB(0, 12, 0, 0),
                            child: 
                            Icon(Icons.accessibility)
                        ),
                      )
                    ],
                  ),
                ),
                Padding(
                  padding: EdgeInsets.fromLTRB(15, 0, 15, 0),
                  child: SizedBox(
                    width: double.infinity,
                    child: RaisedButton(
                      onPressed: () {},
                      child: Text('Add User'),
                    ),
                  ),
                ),
              ],
            )
        ),
      ],
    );
  }
}

