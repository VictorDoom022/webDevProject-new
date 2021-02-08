import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:myapp/model/userClass.dart';

Future<Users> addUser(String username, String password, String position,String email) async {
  print("Received username: "+ username);
  print("Received password: "+ password);
  print("Received position: "+ position);
  print("Received email: "+ email);
  // final response = await http.post(
  //   Uri.https('jsonplaceholder.typicode.com','albums'),
  //   headers: <String, String>{
  //     'Content-Type': 'application/json; charset=UTF-8',
  //   },
  //   body: jsonEncode(<String, String>{
  //     'title': title,
  //   }),
  // );
  //
  // if (response.statusCode == 201) {
  //   return Users.fromJson(jsonDecode(response.body));
  // } else {
  //   throw Exception('Failed to create album.');
  // }
}