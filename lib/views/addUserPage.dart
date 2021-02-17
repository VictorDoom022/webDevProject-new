import 'package:flutter/material.dart';
import 'package:email_validator/email_validator.dart';
import 'package:myapp/model/userClass.dart';
import 'package:myapp/controllers/addUser.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'navDrawer.dart';

class addUserPage extends StatefulWidget {
  @override
  _addUserPageState createState() => _addUserPageState();
}

class _addUserPageState extends State<addUserPage> {

  SharedPreferences sharedPrefs;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    SharedPreferences.getInstance().then((prefs) {
      setState(() {
        sharedPrefs = prefs;
      });
    });
  }

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
        drawer: navDrawer(),
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
  final TextEditingController usernameController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();
  final TextEditingController emailController = TextEditingController();
  Future<Users> _futureUser;

  @override
  void dispose() {
    // TODO: implement dispose
    usernameController.dispose();
    passwordController.dispose();
    emailController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {

    String selectedPosition;

    return Column(
      mainAxisAlignment: MainAxisAlignment.start,
      children: [
        Form(
            key: _formKey,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Padding(
                  padding: EdgeInsets.fromLTRB(15, 10, 15, 0),
                  child: TextFormField(
                    controller: usernameController,
                    decoration: InputDecoration(
                      icon: Icon(Icons.account_circle),
                      labelText: 'Enter Username',
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(5),
                      ),
                    ),
                    validator: (value){
                      if(value.isEmpty){
                        return 'Please enter username';
                      }
                      return null;
                    },
                  ),
                ),
                Padding(
                  padding: EdgeInsets.fromLTRB(15, 10, 15, 0),
                  child: TextFormField(
                    controller: passwordController,
                    obscureText: true,
                    decoration: InputDecoration(
                        icon: Icon(Icons.lock_rounded),
                        labelText: 'Enter Password',
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(5),
                        ),
                    ),
                    validator: (value){
                      if(value.trim().isEmpty){
                        return 'Please enter password';
                      }
                      return null;
                    },
                  ),
                ),
                Padding(
                  padding: EdgeInsets.fromLTRB(15, 10, 15, 0),
                  child: TextFormField(
                    controller: emailController,
                    decoration: InputDecoration(
                        icon: Icon(Icons.mail),
                        labelText: 'Enter Email',
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(5),

                        ),
                    ),
                    validator: (value){
                      if(value.isEmpty){
                        return 'Please enter email';
                      }else if((EmailValidator.validate(value) == null)){
                        return 'Please enter a valid email';
                      }
                      return null;
                    },
                  ),
                ),
                Padding(
                  padding: EdgeInsets.fromLTRB(15, 10, 15, 0),
                  child: Stack(
                    children: [
                      DropdownButtonFormField(
                        items:["seller", "customer"].map(
                                (label) => DropdownMenuItem(
                              child: Text(label),
                              value: label,
                            )
                        ).toList(),
                        onChanged: (value){
                            selectedPosition = value;
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
                      textColor: Colors.white,
                      color: Colors.blue,
                      onPressed: () {
                        if(_formKey.currentState.validate()){
                          setState(() {
                            _futureUser = addUser(usernameController.text,passwordController.text, selectedPosition ,emailController.text);
                          });
                        }
                      },
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

