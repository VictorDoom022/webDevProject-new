import 'package:flutter/material.dart';
import 'package:myapp/controllers/loginFunction.dart';
import 'package:myapp/model/userClass.dart';

class login extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: loginForm(),
    );
  }
}

class loginForm extends StatefulWidget {
  @override
  _loginFormState createState() => _loginFormState();
}

class _loginFormState extends State<loginForm> {

  Future<Users> _futureUser;
  final _formKey = GlobalKey<FormState>();
  TextStyle style = TextStyle(fontFamily: 'Montserrat', fontSize: 20.0);

  final TextEditingController usernameController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();

  @override
  void dispose() {
    // TODO: implement dispose
    usernameController.dispose();
    passwordController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Form(
      key: _formKey,
      child: Scaffold(
        body: Center(
          child: Container(
            color: Colors.white,
            child: Padding(
              padding: EdgeInsets.fromLTRB(36.0, 36.0, 36.0, 0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  SizedBox(
                    height: 155.0,
                    child: Text(
                        'Login',
                        style: TextStyle(
                          fontSize: 50
                        ),
                    ),
                  ),
                  SizedBox(height: 10.0),
                  TextField(
                    controller: usernameController,
                    style: style,
                    decoration: InputDecoration(
                      contentPadding: EdgeInsets.fromLTRB(20.0, 15.0, 20.0, 15.0),
                      hintText: "Username",
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(32.0),
                      )
                    ),
                  ),
                  SizedBox(height: 10.0),
                  TextField(
                    controller: passwordController,
                    obscureText: true,
                    style: style,
                    decoration: InputDecoration(
                        contentPadding: EdgeInsets.fromLTRB(20.0, 15.0, 20.0, 15.0),
                        hintText: "Password",
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(32.0),
                        )
                    ),
                  ),
                  SizedBox(height: 10.0),
                  Material(
                    elevation: 5.0,
                    borderRadius: BorderRadius.circular(30.0),
                    color: Color(0xff01A0C7),
                    child: MaterialButton(
                      minWidth: MediaQuery.of(context).size.width,
                      padding: EdgeInsets.fromLTRB(20.0, 15.0, 20.0, 15.0),
                      onPressed: (){
                        if(_formKey.currentState.validate()){
                          setState(() {
                            _futureUser = loginFunction(usernameController.text, passwordController.text);
                          });
                        }
                      },
                      child: Text(
                        "Login",
                        textAlign: TextAlign.center,
                        style: style.copyWith(
                          color: Colors.white,
                          fontWeight: FontWeight.bold
                        ),
                      ),
                    ),
                  ),
                  SizedBox(height: 10.0),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}


