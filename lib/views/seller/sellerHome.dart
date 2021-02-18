import 'package:flutter/material.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:myapp/controllers/seller/fetchSellerHomeData.dart';
import 'package:myapp/model/sellerHomeData.dart';
import 'package:myapp/views/admin/navDrawerAdmin.dart';

import 'navDrawerSeller.dart';

class sellerHome extends StatefulWidget {
  @override
  _sellerHomeState createState() => _sellerHomeState();
}

class _sellerHomeState extends State<sellerHome> {
  @override
  Widget build(BuildContext context) {
    final appTitle = "Seller Home";
    return MaterialApp(
      title: appTitle,
      home: sellerHomePage(),
    );
  }
}

class sellerHomePage extends StatefulWidget {
  @override
  _sellerHomePageState createState() => _sellerHomePageState();
}

class _sellerHomePageState extends State<sellerHomePage> {

  Future<List<sellerHomeData>> futureHomeData;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    futureHomeData = fetchSellerHomeData();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Seller Home"),
      ),
      body: FutureBuilder<List<sellerHomeData>>(
        future: futureHomeData,
        builder: (context, snapshot){
          if(snapshot.hasError) print(snapshot.error);

          if(snapshot.hasData){
            return HomeData(homeData: snapshot.data);
          }else{
            return Center(child: SpinKitCircle(color: Colors.cyan, size: 70.0,));
          }
        },
      ),
      drawer: navDrawerSeller(),
    );
  }
}

class HomeData extends StatelessWidget {

  final List<sellerHomeData> homeData;

  HomeData({Key key, this.homeData}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
        itemCount: homeData.length,
        itemBuilder: (context, index){
          return Row(
            children: [
              Card(
                child: Center(
                  child: Text('Total Orders' + homeData[index].totalOrders),
                ),
              ),
              Card(
                child: Center(
                  child: Text('Total Sell Price' + homeData[index].totalSellPrice),
                ),
              ),
              Card(
                child: Center(
                  child: Text('Total Ori Price' + homeData[index].totalOriPrice),
                ),
              ),
              Card(
                child: Center(
                  child: Text('Total Discount' + homeData[index].totalDiscount),
                ),
              ),
            ],
          );
        }
    );
  }
}


