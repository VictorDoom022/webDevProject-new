import 'dart:convert';

import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:myapp/model/userClass.dart';

Future<Users> addUser(String username, String password, String position,String email) async {
  print("Received username: "+ username);
  print("Received password: "+ password);
  print("Received position: "+ position);
  print("Received email: "+ email);

  BaseOptions options = new BaseOptions(
    connectTimeout: 10000,
    receiveTimeout: 10000,
  );

  try{
    Response response;
    Dio dio = new Dio(options);

    dio.options.contentType= Headers.formUrlEncodedContentType;
    response = await dio.post("http://192.168.0.181/webDevProjectFlutter/addUser.php"  , data: {"username" : username, "password" : password, "position" : position, "email" : email });
    print(response);
  } catch(e){
    throw (e);
  }
}