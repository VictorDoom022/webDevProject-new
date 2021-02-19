import 'package:dio/dio.dart';
import 'package:myapp/backendDirSetup.dart';

Future<void> deleteUser(userID) async {
  BaseOptions options = new BaseOptions(
    connectTimeout: 10000,
    receiveTimeout: 10000,
  );

  try{
    Response response;
    Dio dio = new Dio(options);

    dio.options.contentType= Headers.formUrlEncodedContentType;
    response = await dio.post(path()+"deleteUser.php"  , data: {"id" : userID });
    print(response);
  } catch(e){
    throw (e);
  }

}
