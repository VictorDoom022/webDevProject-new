import 'dart:convert';
import 'dart:async';
import 'package:flutter/foundation.dart';
import 'package:http/http.dart' as http;
import 'model/userClass.dart';

Future<List<Users>> fetchUsers(http.Client client) async {
  final response = await client.get('http://192.168.0.181/WebDev/finalPrep/getUsers.php');

  // Use the compute function to run parsePhotos in a separate isolate.
  return compute(parseUsers, response.body);
}

// A function that converts a response body into a List<Photo>.
List<Users> parseUsers(String responseBody) {
  final parsed = jsonDecode(responseBody).cast<Map<String, dynamic>>();

  return parsed.map<Users>((json) => Users.fromJson(json)).toList();
}