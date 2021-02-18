import 'package:flutter/material.dart';
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
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Seller Home"),
      ),
      body: Container(),
      drawer: navDrawerSeller(),
    );
  }
}

