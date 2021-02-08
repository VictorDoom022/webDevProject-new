import 'package:dio/dio.dart';
import 'package:myapp/model/userClass.dart';

Future<Users> loginFunction(String username, String password) async {
  print("Username : " + username);
  print("Password" + password);
  // BaseOptions options = new BaseOptions(
  //   connectTimeout: 10000,
  //   receiveTimeout: 10000,
  // );
  //
  // try{
  //   Response response;
  //   Dio dio = new Dio(options);
  //
  //   dio.options.contentType= Headers.formUrlEncodedContentType;
  //   response = await dio.post("http://192.168.0.181/webDevProjectFlutter/addUser.php"  , data: {"username" : username, "password" : password, "position" : position, "email" : email });
  //   print(response);
  // } catch(e){
  //   throw (e);
  // }
}