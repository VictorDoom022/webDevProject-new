-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2021 at 06:39 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `crt_addDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `id` int(50) NOT NULL,
  `cms_user` int(11) NOT NULL,
  `cms_amount` varchar(20) NOT NULL,
  `cms_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`id`, `cms_user`, `cms_amount`, `cms_date`) VALUES
(1, 2, '5000', '2021-01-03 07:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ord_user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `ord_id` int(11) NOT NULL,
  `ord_product_id` int(11) NOT NULL,
  `ord_product_name` varchar(255) NOT NULL,
  `ord_product_quantity` int(5) NOT NULL,
  `ord_product_unit_price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '001', 'JJYY Phone', 'iphone', '15', '20', '400mb + 1GB\r\nDimensions	145 x 73.5 x 10.8 mm (5.71 x 2.89 x 0.43 in)\r\nWeight	165 g (5.82 oz)\r\nSIM	Dual SIM\r\nCPU Quad-core 1.3 GHz Cortex-A7', 'https://i.guim.co.uk/img/media/30ae6f657de5843fa3dfc463c8ecd317855d905e/171_0_1667_1000/master/1667.jpg?width=1200&height=900&quality=85&auto=format&fit=crop&s=51da1c5eac08485557dfff1f396bd0fc', '0', 1, 2);

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
(1, 'abc', '2020-12-23', '2020-12-31', 'Christmas Discount', '1', '20', 2);

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
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
