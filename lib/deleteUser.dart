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
    response = await dio.get("http://192.168.0.181/webDevProjectFlutter/deleteUser.php?id="+userID);
    print(response);
  } catch(e){
    throw (e);
  }

}
