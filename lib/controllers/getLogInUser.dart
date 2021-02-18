import 'dart:convert';
import 'package:dio/dio.dart';
import 'package:myapp/model/userClass.dart';
import 'package:shared_preferences/shared_preferences.dart';

Future<Users> getLogInUser(username) async{

    Dio dio = new Dio();
    Response response;

    final prefs = await SharedPreferences.getInstance();

    dio.options.contentType = Headers.formUrlEncodedContentType;
    response = await dio.post("http://192.168.0.181/webDevProjectFlutter/getLoginUser.php", data: {"username" : username});

    final parsed = jsonDecode(response.data).cast<Map<String, dynamic>>();
    final temp = parsed.map<Users>((json) => Users.fromJson(json)).toList();

    final List<Users> user = temp;

    for(var datas in user){
        prefs.setString("id", datas.id);
        prefs.setString("username", datas.username);
        prefs.setString("email", datas.email);
        prefs.setString("position", datas.position);
        prefs.setString("create_date", datas.create_date);
    }
}