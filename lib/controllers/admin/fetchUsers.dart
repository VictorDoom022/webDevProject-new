import 'dart:convert';
import 'dart:async';
import 'package:dio/dio.dart';
import 'package:flutter/foundation.dart';
import 'package:http/http.dart' as http;
import 'package:myapp/backendDirSetup.dart';
import 'package:myapp/model/userClass.dart';

Future<List<Users>> fetchUsers(http.Client client) async {
  final response = await client.get(path()+'getUsers.php');

  // Use the compute function to run parsePhotos in a separate isolate.
  return compute(parseUsers, response.body);
}

Future<List<Users>> getUsers() async{
  Dio dio = new Dio();
  Response response;

  dio.options.contentType = Headers.formUrlEncodedContentType;
  response = await dio.get(path()+"getUsers.php");

  final parsed = jsonDecode(response.data).cast<Map<String, dynamic>>();
  final temp = parsed.map<Users>((json) => Users.fromJson(json)).toList();

  final List<Users> user = temp;
  return user;
}

// A function that converts a response body into a List<Photo>.
List<Users> parseUsers(String responseBody) {
  final parsed = jsonDecode(responseBody).cast<Map<String, dynamic>>();

  return parsed.map<Users>((json) => Users.fromJson(json)).toList();
}