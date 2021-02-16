import 'package:flutter_session/flutter_session.dart';

Future<void> checkSession() async {
  dynamic username;
  dynamic email;
  dynamic position;

  username = await FlutterSession().get("username");
  email = await FlutterSession().get("email");
  position = await FlutterSession().get("position");

}