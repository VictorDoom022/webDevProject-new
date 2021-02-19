import 'package:dio/dio.dart';
import 'package:myapp/backendDirSetup.dart';
import 'package:myapp/model/userClass.dart';

Future<Users> sendMessage(String cht_sender, String cht_receiver, String cht_msg) async {
  BaseOptions options = new BaseOptions(
    connectTimeout: 10000,
    receiveTimeout: 10000,
  );

  try{
    Response response;
    Dio dio = new Dio(options);

    dio.options.contentType= Headers.formUrlEncodedContentType;
    response = await dio.post(path()+"sendMessage.php"  , data: {"cht_sender" : cht_sender, "cht_receiver" : cht_receiver, "cht_msg" : cht_msg});
    print(response);
  } catch(e){
    throw (e);
  }
}