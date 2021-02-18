class sellerHomeData {
  final String totalOrders;
  final String totalSellPrice;
  final String totalOriPrice;
  final String totalDiscount;

  sellerHomeData({this.totalOrders, this.totalSellPrice, this.totalOriPrice, this.totalDiscount});

  factory sellerHomeData.fromJson(Map<String, dynamic> json) {
    return sellerHomeData(
        totalOrders: json['totalOrders'] as String,
        totalSellPrice: json['totalSellPrice'] as String,
        totalOriPrice: json['totalOriPrice'] as String,
        totalDiscount: json['totalDiscount'] as String,
    );
  }
}