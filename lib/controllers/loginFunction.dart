import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:myapp/controllers/getLogInUser.dart';
import 'package:myapp/model/userClass.dart';
import 'package:myapp/views/admin/userLists.dart';
import 'package:myapp/views/seller/sellerHome.dart';

Future<Users> loginFunction(BuildContext context, String username, String password) async {
  print("Username : " + username);
  print("Password : " + password);
  BaseOptions options = new BaseOptions(
    connectTimeout: 10000,
    receiveTimeout: 10000,
  );

  try{
    Response response;
    Dio dio = new Dio(options);

    dio.options.contentType= Headers.formUrlEncodedContentType;
    response = await dio.post("http://192.168.0.181/webDevProjectFlutter/login.php"  , data: {"username" : username, "password" : password});
    getLogInUser(username);
    print(response.toString());

    if(response.toString() == "admin"){
      Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => userList())
      );
    }else if(response.toString() == "seller") {
      Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => sellerHome())
      );
    }else if(response.toString() == "customer") {
      print('The user is a customer');
    }else{
      print('idk');
    }
  } catch(e){
    //throw (e);
  }
}