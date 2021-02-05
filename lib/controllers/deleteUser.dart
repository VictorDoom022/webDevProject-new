import 'dart:io';

import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:myapp/model/userClass.dart';

Future<void> deleteUser(userID) async {
  BaseOptions options = new BaseOptions(
    connectTimeout: 10000,
    receiveTimeout: 10000,
  );

  try{
    Response response;
    Dio dio = new Dio(options);

    dio.options.contentType= Headers.formUrlEncodedContentType;
    response = await dio.post("http://192.168.0.181/webDevProjectFlutter/deleteUser.php"  , data: {"id" : userID });
    print(response);
  } catch(e){
    throw (e);
  }

}
