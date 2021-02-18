import 'package:flutter/material.dart';
import 'package:flutter/scheduler.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:shared_preferences/shared_preferences.dart';

class initLoading extends StatefulWidget {
  @override
  _initLoadingState createState() => _initLoadingState();
}

class _initLoadingState extends State<initLoading> {

  SharedPreferences sharedPrefs;
  String position = "";

  @override
  void initState() {
    // TODO: implement initState
    super.initState();

    sharedPrefsFunc().then((value) => {
      position = value,
      redirect(position)
    });

  }

  void redirect(position){
    String tempPosition = position;
    //To redirect page before build method complete
    SchedulerBinding.instance.addPostFrameCallback((timeStamp) {
      if(tempPosition == "null"){
        Navigator.pushReplacementNamed(
            context,
            '/login'
        );
      }else if(tempPosition == "admin"){
        Navigator.pushReplacementNamed(
            context,
            '/userList'
        );
      }else if(tempPosition == "seller"){
        Navigator.pushReplacementNamed(
            context,
            '/sellerHome'
        );
      }
    });
  }

  Future<String> sharedPrefsFunc() async{
    sharedPrefs = await SharedPreferences.getInstance();
    return sharedPrefs.getString("username").toString();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: Center(
        child: SpinKitCircle(
          color: Colors.cyan,
          size: 70.0,
        ),
      ),
    );
  }
}
