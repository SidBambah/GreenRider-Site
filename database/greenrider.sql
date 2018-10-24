-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: 104.198.242.93:3306
-- Generation Time: Aug 07, 2018 at 02:51 AM
-- Server version: 5.7.14-google-log
-- PHP Version: 7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greenrider`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `subtotal` decimal(6,4) NOT NULL,
  `tax` decimal(6,4) NOT NULL,
  `total` decimal(6,4) NOT NULL,
  `delivery_address` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Placed',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `subtotal`, `tax`, `total`, `delivery_address`, `status`, `datetime`) VALUES
(24, 1, '3.4500', '0.1700', '3.6200', 'Lambda Chi Alpha', 'Delivered', '2018-06-02 07:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(27, 24, 2, 1),
(28, 24, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `item` varchar(25) DEFAULT NULL,
  `type` varchar(12) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `item`, `type`, `price`, `restaurant_id`) VALUES
(1, 'Double-Double', 'Burger', '2.75', 2),
(2, 'Cheeseburger', 'Burger', '1.85', 2),
(3, 'Hamburger', 'Burger', '1.60', 2),
(4, 'French Fries', 'Side', '1.09', 2),
(5, 'Chocolate', 'Shake', '1.60', 2),
(6, 'Strawberry', 'Shake', '1.60', 2),
(7, 'Vanilla', 'Shake', '1.60', 2),
(8, 'Classic Coke', 'Soft Drink', '0.99', 2),
(9, 'Diet Coke', 'Soft Drink', '0.99', 2),
(10, 'Seven-Up', 'Soft Drink', '0.99', 2),
(11, 'Root Beer', 'Soft Drink', '0.99', 2),
(12, 'Dr. Pepper', 'Soft Drink', '0.99', 2),
(13, 'Lemonade', 'Soft Drink', '0.99', 2),
(14, 'Iced Tea', 'Soft Drink', '0.99', 2),
(15, 'Milk', 'Beverage', '0.70', 2),
(16, 'Coffee', 'Beverage', '0.70', 2),
(17, 'Small', 'Size', '0.00', 2),
(18, 'Medium', 'Size', '0.16', 2),
(19, 'Large', 'Size', '0.30', 2),
(20, 'Extra-Large', 'Size', '0.50', 2);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `shortname`) VALUES
(1, 'Fat Sal\'s', 'fat_sals'),
(2, 'In-N-Out', 'in_n_out');

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`id`, `name`, `position`) VALUES
(1, 'Suryansh Rana Jain', 'Co-Founder and CEO'),
(2, 'Sidharth Bambah', 'Co-Founder'),
(3, 'Nicolas Rios', 'Co-Founder'),
(4, 'Cristian Rodriguez', 'Intern'),
(5, 'Nicholas Teoh', 'Intern');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `value`) VALUES
(2, 'Accepted'),
(4, 'Delivered'),
(1, 'Placed'),
(3, 'Ready');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `activationHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pass`, `firstname`, `lastname`, `telephone`, `active`, `activationHash`) VALUES
(1, 'sids53@gmail.com', '$2y$10$N0exY73Okm4Gf2x1vSN.KOTlCW5cJ2XJowW4qy6TTwuogsz1BfaYm', 'Sid', 'Bambah', '8182161580', 1, 'b4d446fd3ec43889068bdd636091173a36519c7d'),
(2, 'suryansh.rana22@gmail.com', '$2y$10$1QNgyf3dGhNWr1.YmmcV2O7lhhEP/GyEbGPI/PBEcvZZKkOf9quTK', 'Suryansh', 'Rana', '3109067717', 1, '5134bf9719ec603f21b3e79971697a8cfcc7470c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riders`
--
ALTER TABLE `riders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `value` (`value`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`value`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
