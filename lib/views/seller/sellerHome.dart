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
      theme: ThemeData(
        primaryColor: Colors.black
      ),
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
            return Center(child: SpinKitCircle(color: Colors.black, size: 70.0,));
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
          return Column(
            children: [
              Container(
                height: 110,
                child: Card(
                  color: Color.fromRGBO(23, 186, 26, 25),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(5.0)
                  ),
                  elevation: 10,
                  child: Center(
                    child: Column(
                      children:[
                        Text(
                          'Total Orders',
                          style: TextStyle(
                            fontSize: 25,
                            color: Colors.white
                          ),
                        ),
                        Text(
                            homeData[index].totalOrders,
                          style: TextStyle(
                            fontSize: 35,
                            fontWeight: FontWeight.bold,
                            color: Colors.white,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ),
              SizedBox(height: 5),
              Container(
                height: 110,
                child: Card(
                  color: Color.fromRGBO(255, 147, 0, 25),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(5.0)
                  ),
                  elevation: 10,
                  child: Center(
                    child: Column(
                      children: [
                        Text(
                          'Total Sell Price',
                          style: TextStyle(
                              fontSize: 25,
                              color: Colors.white
                          ),
                        ),
                        Text(
                            homeData[index].totalSellPrice,
                          style: TextStyle(
                            fontSize: 35,
                            fontWeight: FontWeight.bold,
                            color: Colors.white,
                          ),
                        )
                      ],
                    ),
                  ),
                ),
              ),
              SizedBox(height: 5),
              Container(
                height: 110,
                child: Card(
                  color: Color.fromRGBO(11, 50, 244, 25),
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(5.0)
                  ),
                  elevation: 10,
                  child: Center(
                    child: Column(
                      children: [
                        Text(
                            'Total Ori Price',
                          style: TextStyle(
                              fontSize: 25,
                              color: Colors.white
                          ),
                        ),
                        Text(
                            "RM"+homeData[index].totalOriPrice,
                          style: TextStyle(
                            fontSize: 35,
                            fontWeight: FontWeight.bold,
                            color: Colors.white,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ),
              SizedBox(height: 5),
              Container(
                height: 110,
                child: Card(
                  color: Color.fromRGBO(253, 3, 33, 25),
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(5.0)
                  ),
                  elevation: 10,
                  child: Center(
                    child: Column(
                      children: [
                        Text(
                            'Total Discount',
                          style: TextStyle(
                              fontSize: 25,
                              color: Colors.white
                          ),
                        ),
                        Text(
                            "RM"+homeData[index].totalDiscount,
                          style: TextStyle(
                            fontSize: 35,
                            fontWeight: FontWeight.bold,
                            color: Colors.white,
                          ),
                        )
                      ],
                    ),
                  ),
                ),
              ),
            ],
          );
        }
    );
  }
}


