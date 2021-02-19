import 'dart:async';
import 'dart:convert';
import 'package:dio/dio.dart';
import 'package:myapp/backendDirSetup.dart';
import 'package:myapp/model/sellerHomeData.dart';
import 'package:shared_preferences/shared_preferences.dart';

Future<List<sellerHomeData>> fetchSellerHomeData() async{
  SharedPreferences sharedPrefs = await SharedPreferences.getInstance();
  String userID;
  Dio dio = new Dio();
  Response response;

  userID = sharedPrefs.getString("id");

  dio.options.contentType = Headers.formUrlEncodedContentType;
  response = await dio.post(path()+"getSellerHome.php", data: {"sellerID" : userID });

  final parsed = jsonDecode(response.toString()).cast<Map<String, dynamic>>();
  final temp = parsed.map<sellerHomeData>((json) => sellerHomeData.fromJson(json)).toList();

  final List<sellerHomeData> user = temp;
  return temp;
}