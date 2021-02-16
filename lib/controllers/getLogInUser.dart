
import 'dart:convert';

import 'package:dio/dio.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter_session/flutter_session.dart';
import 'package:myapp/controllers/fetchUsers.dart';
import 'package:myapp/model/userClass.dart';

Future<Users> getLogInUser(username) async{

    Dio dio = new Dio();
    Response response;

    var session = FlutterSession();

    dio.options.contentType = Headers.formUrlEncodedContentType;
    response = await dio.post("http://192.168.0.181/webDevProjectFlutter/getLoginUser.php", data: {"username" : username});

    final parsed = jsonDecode(response.data).cast<Map<String, dynamic>>();
    final temp = parsed.map<Users>((json) => Users.fromJson(json)).toList();

    final List<Users> user = temp;

    for(var datas in user){
        await session.set("username", datas.username);
        await session.set("email", datas.email);
        await session.set("position", datas.position);
        await session.set("create_date", datas.create_date);
    }
}