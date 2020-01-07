-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2020 at 04:31 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_price` int(30) NOT NULL,
  `prod_qty` int(30) NOT NULL,
  `qty_s` int(11) NOT NULL,
  `qty_m` int(11) NOT NULL,
  `qty_l` int(11) NOT NULL,
  `prod_type` varchar(100) NOT NULL,
  `prod_descrip` text NOT NULL,
  `prod_img` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_price`, `prod_qty`, `qty_s`, `qty_m`, `qty_l`, `prod_type`, `prod_descrip`, `prod_img`) VALUES
(66, 'OSIS+ Session Label 500ml', 40, 100, 0, 0, 0, 'Hair Products', 'OSIS+ Session Label Super Dry Flex Flexible Hold Spray 500ml', 'osis-session-label-super-dry-flex-flexible-hold-hairspray-500-ml-1.jpg'),
(68, 'OSiS+ FREEZE Strong Hold Hairspray, 15-Ounce', 20, 97, 0, 0, 0, 'Hair Products', 'OSiS+ FREEZE Strong Hold Hairspray, 15-Ounce', '31m5jzeiYiL._SY355_.jpg'),
(77, 'Flowerbomb by Viktor & Rolf for Women, ', 210, 99, 0, 0, 0, 'Perfumes', 'Flowerbomb by Viktor & Rolf for Women, Eau de Parfum, 3.4 Ounce Spray', '650x650.jpg'),
(78, 'Sleek MakeUP iDivine - A New Day', 40, 100, 0, 0, 0, 'Make-up', 'Sleek MakeUP iDivine - A New Day 12 Palette Eye Shadow', 'A-New-Day_1200x1200.jpg'),
(72, 'Sleek MakeUP iDivine - All Night Long', 200, 96, 0, 0, 0, 'Make-up', 'Sleek Makeup I-Divine Palette 12 Shades Mineral Based Eye Shadow - All Night Long', 'slk0462.jpg'),
(73, 'Versace Bright Crystal', 35, 100, 0, 0, 0, 'Perfumes', 'Versace Bright Crystal 90ml\r\n', 'Versace-Bright-Crystal-90ml.jpg'),
(74, 'LOLA By Marc Jacobs', 300, 100, 0, 0, 0, 'Perfumes', 'LOLA By Marc Jacobs', '81k4vLILIdL._SL1500_.jpg'),
(75, 'Daisy By Marc Jacobs', 110, 98, 0, 0, 0, 'Perfumes', 'Daisy By Marc Jacobs', '155423.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `Category` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `Category`) VALUES
(11, 'Hair Products'),
(2, 'Make-up'),
(12, 'Perfumes');

-- --------------------------------------------------------

--
-- Table structure for table `product_sample`
--

CREATE TABLE `product_sample` (
  `id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `qty_s` int(11) NOT NULL,
  `qty_m` int(11) NOT NULL,
  `qty_l` int(11) NOT NULL,
  `prod_type` varchar(255) NOT NULL,
  `prod_descrip` varchar(255) NOT NULL,
  `prod_img` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_sample`
--

INSERT INTO `product_sample` (`id`, `prod_name`, `prod_price`, `prod_qty`, `qty_s`, `qty_m`, `qty_l`, `prod_type`, `prod_descrip`, `prod_img`) VALUES
(1, '', 0, 0, 0, 0, 0, 'Make-up', '', ''),
(2, 'Sporty Shirt', 123, 0, 10, 10, 10, 'Clothes', '123', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_transaction`
--

CREATE TABLE `product_transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` int(30) NOT NULL,
  `prod_id` int(30) NOT NULL,
  `prod_type` varchar(30) NOT NULL,
  `prod_qty` int(30) NOT NULL,
  `prod_price` int(30) NOT NULL,
  `transaction_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_transaction`
--

INSERT INTO `product_transaction` (`id`, `transaction_id`, `prod_id`, `prod_type`, `prod_qty`, `prod_price`, `transaction_date`) VALUES
(24, 26, 60, '', 12, 12000, '2018-09-16 23:46:13'),
(23, 25, 60, '', 1, 1000, '2018-09-16 23:27:13'),
(22, 25, 60, '', 1, 1000, '2018-09-16 23:27:13'),
(21, 24, 45, '', 1, 11, '2018-09-16 22:07:22'),
(20, 23, 42, '', 1, 800, '2018-09-16 21:54:22'),
(19, 23, 35, '', 1, 999, '2018-09-16 21:54:22'),
(18, 22, 35, '', 1, 999, '2018-09-16 03:55:06'),
(17, 22, 36, '', 1, 950, '2018-09-16 03:55:06'),
(16, 21, 35, '', 1, 999, '2018-09-10 22:42:02'),
(15, 20, 36, '', 1, 950, '2018-09-10 21:05:16'),
(14, 19, 41, '', 1, 395, '2018-09-10 19:50:51'),
(13, 18, 35, '', 1, 999, '2018-09-10 19:48:45'),
(25, 26, 38, '', 1, 1050, '2018-09-16 23:46:13'),
(26, 27, 35, '', 9, 8991, '2018-09-19 04:58:21'),
(27, 27, 40, '', 5, 1850, '2018-09-19 04:58:21'),
(28, 27, 41, '', 4, 1580, '2018-09-19 04:58:21'),
(29, 32, 41, '', 1, 395, '2018-09-21 02:58:27'),
(30, 33, 41, '', 1, 395, '2018-09-21 03:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_transactions`
--

CREATE TABLE `product_transactions` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(30) NOT NULL,
  `prod_price` int(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `confirmStatus` tinyint(4) NOT NULL,
  `token` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`id`, `user_type`, `full_name`, `user_address`, `email`, `username`, `user_password`, `confirmStatus`, `token`) VALUES
(75, 'Customer', 'gantong christian', 'testertestertester', 'mnmyaneh@gmail.com', '123123', '123', 0, 'w9VCtZdr5J'),
(76, 'Customer', 'gantong christian', 'testertestertester', 'mnmyaneh@gmail.com', '123123', '123', 0, 'KMrRaj7Qem'),
(77, 'Customer', 'gantong christian', 'testertestertester', 'mnmyaneh@gmail.com', '123123', '123', 0, 'bx3dzkqgwM'),
(78, 'Customer', 'gantong christian', 'testertestertester', 'mnmyaneh@gmail.com', '123123', '123', 0, '$OtG(CjnVP'),
(74, 'Customer', 'gantong christian', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'mnmyaneh@gmail.com', 'admina', '123', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `shopping`
--

CREATE TABLE `shopping` (
  `id` int(11) NOT NULL,
  `prod_name` varchar(300) NOT NULL,
  `prod_type` varchar(300) NOT NULL,
  `prod_price` int(100) NOT NULL,
  `prod_stock` varchar(300) NOT NULL,
  `prod_img` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(30) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `billing` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `cour` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `transaction_date`, `billing`, `status`, `cour`) VALUES
(30, 2, '2018-09-21 02:54:03', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'shipped', ''),
(31, 2, '2018-09-21 02:55:31', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'shipped', 'courier'),
(32, 2, '2018-09-21 02:58:27', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'complete', 'courier'),
(33, 2, '2018-09-21 03:23:46', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'incomplete', '');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(30) NOT NULL,
  `username` varchar(255) NOT NULL,
  `billing` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `username`, `billing`) VALUES
(132, 2, 'customer', 'B7 L9 Periwinkle Street Talon Village Talon 4 '),
(131, 2, 'customer', 'B7 L9 Periwinkle Street Talon Village Talon 4 '),
(130, 2, 'customer', 'B7 L9 Periwinkle Street Talon Village Talon 4 '),
(129, 2, 'customer', 'B7 L9 Periwinkle Street Talon Village Talon 4 '),
(128, 2, 'customer', 'B7 L9 Periwinkle Street Talon Village Talon 4 '),
(127, 2, 'customer', 'B7 L9 Periwinkle Street Talon Village Talon 4 ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `confirmStatus` tinyint(4) NOT NULL,
  `token` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `full_name`, `user_address`, `email`, `username`, `user_password`, `confirmStatus`, `token`) VALUES
(1, 'Admin', 'anne quilondrino', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'mnmyaneh@gmail.com', 'admin', '123', 1, ''),
(2, 'Customer', 'janine ', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'artikz445@gmail.com', 'customer', '123', 1, ''),
(3, 'Customer', 'gantong christian', 'asdasdsa', 'artikz445@gmail.com', 'admin', '123', 1, ''),
(4, 'Customer', 'asddd', '338 Ortigas Ave, San Juan', 'artikz445@gmail.com', 'customer2', '123', 1, ''),
(5, 'Admin', 'Juan Dela Cruz', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'mnmyaneh', 'courier', '123', 1, ''),
(6, 'Customer', 'gantong christian', '338 Ortigas Ave, San Juan', 'artikz445@gmail.com', 'artz', '123', 1, ''),
(7, 'Customer', 'gantong christian', '338 Ortigas Ave, San Juan', 'artikz445@gmail.com', 'artz', '123', 1, ''),
(8, 'Customer', 'gantong christian', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'artikz445@gmail.com', 'kitchen', '123', 1, ''),
(9, 'Customer', 'gantong christian', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'artikz445@gmail.com', 'kitchen', '123', 1, ''),
(10, 'Customer', 'gantong christian', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'artikz445@gmail.com', 'customer', '123', 1, ''),
(11, 'Customer', 'gantong christian', 'B7 L9 Periwinkle Street Talon Village Talon 4 ', 'panduhcat@gmail.com', 'kitchen', '123', 1, ''),
(12, 'Customer', 'Mel Candelario', 'BLK 420 Lot 69 BangBros St San Lorenzo', 'mnmyaneh@gmail.com', 'customer3', '123', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sample`
--
ALTER TABLE `product_sample`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_transaction`
--
ALTER TABLE `product_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_transactions`
--
ALTER TABLE `product_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample`
--
ALTER TABLE `sample`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping`
--
ALTER TABLE `shopping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `product_sample`
--
ALTER TABLE `product_sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product_transaction`
--
ALTER TABLE `product_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `product_transactions`
--
ALTER TABLE `product_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=408;
--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `shopping`
--
ALTER TABLE `shopping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
