import 'package:dio/dio.dart';
import 'package:myapp/model/userClass.dart';

Future<Users> addUser(String username, String password, String position,String email) async {
  BaseOptions options = new BaseOptions(
    connectTimeout: 10000,
    receiveTimeout: 10000,
  );

  try{
    Response response;
    Dio dio = new Dio(options);

    dio.options.contentType= Headers.formUrlEncodedContentType;
    response = await dio.post("http://192.168.0.181/webDevProjectFlutter/addUser.php"  , data: {"username" : username, "password" : password, "position" : position, "email" : email });
    print(response);
  } catch(e){
    throw (e);
  }
}