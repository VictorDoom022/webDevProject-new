-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2021 at 05:48 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdevnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(255) NOT NULL,
  `crt_user` varchar(255) NOT NULL,
  `crt_product` varchar(255) NOT NULL,
  `crt_quantity` int(5) NOT NULL,
  `crt_addDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(255) NOT NULL,
  `cht_sender` varchar(255) NOT NULL,
  `cht_receiver` varchar(255) NOT NULL,
  `cht_msg` varchar(255) NOT NULL,
  `cht_sendDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `cht_sender`, `cht_receiver`, `cht_msg`, `cht_sendDate`) VALUES
(1, '2', '1', 'Hi admin', '2021-01-13 00:21:23'),
(2, '2', '3', 'Hi Customer', '2021-01-13 00:21:31'),
(3, '3', '2', 'Hi', '2021-01-13 00:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `total_revenue` int(100) NOT NULL,
  `commission_rate` varchar(100) NOT NULL,
  `commission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`id`, `user_id`, `total_revenue`, `commission_rate`, `commission_date`) VALUES
(1, 2, 4488, '2%', '2021-01-12 16:36:14');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ord_user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ord_user_id`, `date`) VALUES
(3, 3, '2021-01-12 16:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `ord_id` int(11) NOT NULL,
  `ord_product_id` int(11) NOT NULL,
  `seller_id` int(10) DEFAULT NULL,
  `ord_product_name` varchar(255) NOT NULL,
  `ord_product_quantity` int(5) NOT NULL,
  `ord_product_unit_price` double(10,2) NOT NULL,
  `ord_discount` varchar(10) DEFAULT NULL,
  `ord_status` varchar(10) DEFAULT NULL,
  `cms_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `ord_id`, `ord_product_id`, `seller_id`, `ord_product_name`, `ord_product_quantity`, `ord_product_unit_price`, `ord_discount`, `ord_status`, `cms_id`) VALUES
(3, 3, 1, 2, 'Iphone 6 Silver', 10, 1600.00, '1600', 'payed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(255) NOT NULL,
  `prdt_code` varchar(30) NOT NULL,
  `prdt_name` varchar(50) NOT NULL,
  `prdt_type` varchar(30) NOT NULL,
  `prdt_oriPrice` varchar(20) NOT NULL,
  `prdt_sellPrice` varchar(20) NOT NULL,
  `prdt_desc` varchar(255) NOT NULL,
  `prdt_image` varchar(255) NOT NULL,
  `prdt_quantity` varchar(10) NOT NULL,
  `prdt_available` int(20) NOT NULL,
  `prdt_seller` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `prdt_code`, `prdt_name`, `prdt_type`, `prdt_oriPrice`, `prdt_sellPrice`, `prdt_desc`, `prdt_image`, `prdt_quantity`, `prdt_available`, `prdt_seller`) VALUES
(1, 'pdrtIphone6', 'Iphone 6 Silver', 'iphone', '1000', '1600', '<h3>Specs</h3><figure class=\"table\"><table><tbody><tr><td>Storage</td><td>32GB</td></tr><tr><td>Color</td><td>Silver</td></tr><tr><td>Dimensions</td><td>138.1 x 67 x 6.9 mm (5.44 x 2.64 x 0.27 in)</td></tr><tr><td>Weight</td><td>129g</td></tr><tr><td>CPU<', 'https://fdn2.gsmarena.com/vv/pics/apple/apple-iphone-6-1.jpg', '287', 1, 2),
(2, 'pdrtIphone7', 'Iphone 7 Black', 'iphone', '1500', '2000', '<h3>Specs</h3><figure class=\"table\"><table><tbody><tr><td>Storage</td><td>32GB</td></tr><tr><td>Color</td><td>Black</td></tr><tr><td>Dimensions</td><td>138.3 x 67.1 x 7.1 mm (5.44 x 2.64 x 0.28 in)</td></tr><tr><td>Weight</td><td>138g</td></tr><tr><td>CPU', 'https://fdn2.gsmarena.com/vv/pics/apple/apple-iphone-7-1.jpg', '497', 1, 2),
(3, 'pdrtIphone8', 'Iphone 8 Gold', 'iphone', '1800', '2300', '<h3>Specs</h3><figure class=\"table\"><table><tbody><tr><td>Storage</td><td>64GB</td></tr><tr><td>Color</td><td>Silver</td></tr><tr><td>Dimensions</td><td>138.4 x 67.3 x 7.3 mm (5.45 x 2.65 x 0.29 in)</td></tr><tr><td>Weight</td><td>148g</td></tr><tr><td>CP', 'https://fdn2.gsmarena.com/vv/pics/apple/apple-iphone-8-4.jpg', '500', 1, 2),
(4, 'pdrtIphoneX', 'Iphone X Silver', 'iphone', '2000', '3500', '<h3>Specs</h3><figure class=\"table\"><table><tbody><tr><td>Storage</td><td>128GB</td></tr><tr><td>Color</td><td>Silver</td></tr><tr><td>Dimensions</td><td>138.1 x 67 x 6.9 mm (5.44 x 2.64 x 0.27 in)</td></tr><tr><td>Weight</td><td>129g</td></tr><tr><td>CPU', 'https://fdn2.gsmarena.com/vv/pics/apple/apple-iphone-x-new-1.jpg', '1000', 1, 2),
(5, 'pdrtIpadMini', 'Ipad Mini Silver', 'ipad', '1500', '2500', '<h3>Specs</h3><figure class=\"table\"><table><tbody><tr><td>Storage</td><td>128GB</td></tr><tr><td>Color</td><td>Silver</td></tr><tr><td>Dimensions</td><td>203.2 x 134.8 x 6.1 mm (8.0 x 5.31 x 0.24 in)</td></tr><tr><td>Weight</td><td>300g</td></tr><tr><td>C', 'https://fdn2.gsmarena.com/vv/pics/apple/apple-ipad-mini-2019-1.jpg', '5000', 1, 2),
(6, 'pdrtIpadPro', 'Ipad Pro Silver', 'ipad', '2500', '4500', '<h3>Specs</h3><figure class=\"table\"><table><tbody><tr><td>Storage</td><td>1TB</td></tr><tr><td>Color</td><td>Silver</td></tr><tr><td>Dimensions</td><td>143.6 x 70.9 x 7.7 mm (5.65 x 2.79 x 0.30 in)</td></tr><tr><td>Weight</td><td>174g</td></tr><tr><td>CPU', 'https://fdn2.gsmarena.com/vv/pics/apple/apple-ipad-pro-2020-2.jpg', '1000', 1, 2),
(7, 'pdrtMacPro', 'MacBook Pro Silver', 'mac', '5000', '8000', '<h3>Specs</h3><figure class=\"table\"><table><tbody><tr><td>Storage</td><td>526GB</td></tr><tr><td>Color</td><td>Silver</td></tr><tr><td>Dimensions</td><td>15.60 x 304.10 x 212.40</td></tr><tr><td>Weight</td><td>1.4KG</td></tr><tr><td>CPU</td><td>Intel Core', 'https://fdn.gsmarena.com/imgroot/news/20/05/macbook-13-pro-update/-727/gsmarena_001.jpg', '1000', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id` int(255) NOT NULL,
  `promo_code` varchar(50) NOT NULL,
  `promo_startDate` varchar(50) NOT NULL,
  `promo_dueDate` varchar(50) NOT NULL,
  `promo_desc` varchar(255) NOT NULL,
  `promo_prdt` varchar(30) NOT NULL,
  `promo_discount` varchar(10) NOT NULL,
  `promo_seller` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `promo_code`, `promo_startDate`, `promo_dueDate`, `promo_desc`, `promo_prdt`, `promo_discount`, `promo_seller`) VALUES
(1, 'CNYPromo', '2021-01-12', '2021-01-30', 'Enjoy 10% discount from purchasing an Iphone 6.', '1', '10', 2),
(2, 'StockClearancePromo', '2021-01-12', '2021-02-12', 'Enjoy 50% discount from purchasing an Iphone 7 from our stock clearance sale.', '2', '15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `position`, `create_date`) VALUES
(1, 'admin', 'd9067cec004aa0341bd9dd7c26a06304', 'admin@admin.com', 'admin', '2020-12-28 04:57:17'),
(2, 'seller', '836b08d4a5153a2931b7eda9a7824314', 'seller@sell.com', 'seller', '2020-12-28 04:57:03'),
(3, 'customer', '927e7da8f602a5609248eb5d5b00795b', 'teotuanhee1yee2@gmail.com', 'customer', '2020-12-28 04:55:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prdt_code` (`prdt_code`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promo_code` (`promo_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
