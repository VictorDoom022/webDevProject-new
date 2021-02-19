import 'package:dio/dio.dart';
import 'package:myapp/model/userClass.dart';
import 'package:myapp/backendDirSetup.dart';

Future<Users> addUser(String username, String password, String position,String email) async {
  BaseOptions options = new BaseOptions(
    connectTimeout: 10000,
    receiveTimeout: 10000,
  );

  try{
    Response response;
    Dio dio = new Dio(options);

    dio.options.contentType= Headers.formUrlEncodedContentType;
    response = await dio.post(path()+"addUser.php"  , data: {"username" : username, "password" : password, "position" : position, "email" : email });
    print(response);
  } catch(e){
    throw (e);
  }
}

Future<Users> editUser(String id,String username, String password, String position,String email) async {
  BaseOptions options = new BaseOptions(
    connectTimeout: 10000,
    receiveTimeout: 10000,
  );

  try{
    Response response;
    Dio dio = new Dio(options);

    dio.options.contentType= Headers.formUrlEncodedContentType;
    response = await dio.post(path()+"editUser.php"  , data: {"id" : id, "username" : username, "password" : password, "position" : position, "email" : email });
    print(response);
  } catch(e){
    throw (e);
  }
}