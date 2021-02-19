import 'dart:async';
import 'dart:convert';
import 'package:dio/dio.dart';
import 'package:myapp/model/chatClass.dart';
import 'package:shared_preferences/shared_preferences.dart';

Future<List<Chats>> fetchChatData(String receiverID) async{

  SharedPreferences sharedPrefs = await SharedPreferences.getInstance();

  String userID;

  Dio dio = new Dio();
  Response response;

  userID = sharedPrefs.getString("id");

  dio.options.contentType = Headers.formUrlEncodedContentType;
  response = await dio.post("http://192.168.0.181/webDevProjectFlutter/getChatData.php", data: {"userID" : userID,"receiverID" : receiverID });

  final parsed = jsonDecode(response.toString()).cast<Map<String, dynamic>>();
  final temp = parsed.map<Chats>((json) => Chats.fromJson(json)).toList();
  print(response);
  final List<Chats> user = temp;
  return temp;
}