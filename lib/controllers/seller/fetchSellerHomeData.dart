import 'dart:async';
import 'dart:convert';
import 'package:dio/dio.dart';
import 'package:myapp/model/sellerHomeData.dart';

Future<List<sellerHomeData>> fetchSellerHomeData() async{
  Dio dio = new Dio();
  Response response;

  dio.options.contentType = Headers.formUrlEncodedContentType;
  response = await dio.get("http://192.168.0.181/webDevProjectFlutter/getSellerHome.php");

  final parsed = jsonDecode(response.data).cast<Map<String, dynamic>>();
  final temp = parsed.map<sellerHomeData>((json) => sellerHomeData.fromJson(json)).toList();

  final List<sellerHomeData> user = temp;
  return temp;
}