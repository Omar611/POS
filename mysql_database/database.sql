-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2020 at 01:16 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `phone_number_2` int(20) DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `area` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone_number`, `phone_number_2`, `email`, `address`, `area`) VALUES
(1, 'shit eater', '01113057728', 1223098876, 'shiteater69@gmail.com', 'Shit town, crab st, 23', 'Shit town'),
(2, 'Lolo', '1234567', 98765432, 'sdfgh@fghj.ghj', 'Sosfdkogldfmv', 'Koko town'),
(4, 'Koko', '1234567', NULL, 'KokoLovelyBoy@gmail.com', 'KoKo town, Nigiria', 'Koko town'),
(5, 'Shitter shit', NULL, NULL, NULL, NULL, 'Shit town'),
(6, 'Khara', NULL, NULL, NULL, NULL, 'Shit town'),
(7, 'Hoda', '12345', 76543, 'ssdsa@fgs.com', NULL, 'New shit town');

-- --------------------------------------------------------

--
-- Table structure for table `manual_updates`
--

CREATE TABLE `manual_updates` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `date` datetime NOT NULL,
  `amount` int(11) NOT NULL,
  `user` varchar(120) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `manual_updates`
--

INSERT INTO `manual_updates` (`product_id`, `product_name`, `date`, `amount`, `user`) VALUES
(1, 'Shit1', '2020-01-02 13:51:36', 100, 'omar'),
(1, 'Shit1', '2020-01-08 22:15:12', 35, 'Omar'),
(1, 'Shit1', '2020-01-08 22:20:47', 0, 'Omar'),
(2, 'Shit 2', '2020-01-02 13:52:30', 70, 'omar'),
(3, 'shit 3', '2020-01-02 13:52:42', 90, 'omar'),
(7, 'sdfg', '2020-01-02 13:52:49', 78, 'omar'),
(8, 'test', '2020-01-02 13:52:55', 8, 'omar'),
(9, 'test', '2020-01-02 13:53:03', 87, 'omar'),
(10, 'Shhhhhhhhit 444', '2020-01-02 13:53:10', 69, 'omar'),
(11, 'Shhhhhhhhit 33', '2020-01-02 13:53:18', 99, 'omar'),
(12, 'Shhhhhhhhit', '2020-01-02 13:53:23', 7, 'omar'),
(15, 'Double shit', '2020-01-02 13:53:28', 16, 'omar'),
(16, 'Last Product', '2020-01-08 22:12:18', 0, 'Omar'),
(16, 'Last Product', '2020-01-08 22:15:29', 34, 'Omar');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `cost` decimal(9,2) NOT NULL,
  `max_discount` decimal(9,2) NOT NULL,
  `avilable_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `cost`, `max_discount`, `avilable_stock`) VALUES
(1, 'Shit1', 'Shit to sell to people ', '90.00', '60.00', '25.00', 135),
(2, 'Shit 2', 'Same shit different Price', '100.00', '90.00', '5.00', 37),
(3, 'shit 3', 'Less shit in it', '120.00', '110.00', '5.00', 2),
(7, 'sdfg', 'dfghj', '123.00', '111.00', '11.00', 5),
(8, 'test', NULL, '100.80', '50.12', '4.50', 0),
(9, 'test', NULL, '100.00', '50.00', '4.00', 61),
(10, 'Shhhhhhhhit 444', NULL, '20.50', '10.75', '20.00', 68),
(11, 'Shhhhhhhhit 33', NULL, '22.00', '11.00', '15.00', 80),
(12, 'Shhhhhhhhit', NULL, '20.00', '10.00', '20.00', 7),
(15, 'Double shit', 'Double the shit and double the price', '200.18', '100.19', '15.00', 3),
(16, 'Last Product', 'Testing front end', '20.50', '18.00', '7.00', 31);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `operation_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost_of_product` decimal(9,2) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `discount` decimal(9,2) NOT NULL,
  `revenue` decimal(9,2) NOT NULL,
  `input_by` varchar(28) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`operation_id`, `date`, `staff_id`, `customer_id`, `product_id`, `quantity`, `cost_of_product`, `price`, `discount`, `revenue`, `input_by`, `notes`) VALUES
(17, '2020-01-02', 2, 1, 2, 11, '90.00', '100.00', '1.00', '9.00', 'omar', ''),
(18, '2020-01-02', 4, 2, 2, 18, '90.00', '100.00', '1.07', '8.93', 'omar', ''),
(19, '2020-01-02', 5, 4, 9, 26, '50.00', '100.00', '3.00', '47.00', 'omar', ''),
(20, '2020-01-02', 6, 5, 11, 19, '11.00', '22.00', '3.00', '10.34', 'omar', ''),
(21, '2020-01-23', 2, 2, 7, 27, '111.00', '123.00', '2.00', '9.54', 'omar', ''),
(22, '2020-01-23', 5, 1, 3, 12, '110.00', '120.00', '2.00', '7.60', 'omar', ''),
(23, '2020-01-25', 4, 1, 7, 12, '111.00', '123.00', '2.00', '9.54', 'omar', ''),
(24, '2020-01-25', 4, 1, 7, 12, '111.00', '123.00', '2.00', '9.54', 'omar', ''),
(25, '2020-01-01', 5, 1, 7, 20, '111.00', '123.00', '11.00', '-1.53', 'omar', ''),
(26, '2020-01-01', 2, 2, 3, 2, '110.00', '120.00', '0.01', '9.99', 'omar', ''),
(27, '2020-01-01', 2, 1, 3, 3, '110.00', '120.00', '0.00', '10.00', 'omar', ''),
(28, '2020-01-01', 4, 1, 16, 3, '18.00', '20.50', '0.00', '2.50', 'omar', ''),
(29, '2020-01-01', 5, 2, 2, 3, '90.00', '100.00', '0.00', '10.00', 'omar', ''),
(30, '2020-01-01', 2, 1, 3, 13, '110.00', '120.00', '0.00', '10.00', 'omar', ''),
(31, '2020-01-01', 2, 1, 3, 13, '110.00', '120.00', '0.00', '10.00', 'omar', ''),
(32, '2020-01-01', 2, 1, 3, 13, '110.00', '120.00', '0.00', '10.00', 'omar', ''),
(33, '2020-01-01', 2, 1, 15, 13, '100.19', '200.18', '2.00', '95.99', 'omar', ''),
(34, '2020-01-01', 2, 2, 3, 8, '110.00', '120.00', '0.50', '9.40', 'omar', ''),
(35, '2020-01-01', 2, 2, 3, 8, '110.00', '120.00', '0.50', '9.40', 'omar', ''),
(36, '2020-01-01', 2, 1, 3, 8, '110.00', '120.00', '0.50', '9.40', 'omar', ''),
(37, '2020-01-01', 2, 1, 3, 8, '110.00', '120.00', '0.50', '9.40', 'omar', ''),
(38, '2020-01-01', 6, 1, 8, 8, '50.12', '100.80', '0.50', '50.18', 'omar', ''),
(39, '2020-01-01', 4, 2, 7, 1, '111.00', '123.00', '0.50', '11.39', 'omar', ''),
(40, '2020-01-01', 2, 2, 2, 1, '90.00', '100.00', '0.01', '9.99', 'omar', ''),
(41, '2020-01-16', 4, 1, 7, 1, '111.00', '123.00', '0.01', '11.99', 'omar', ''),
(42, '2020-01-16', 2, 5, 10, 1, '10.75', '20.50', '0.01', '9.75', 'omar', '');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `phone_number` varchar(30) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dep` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `phone_number`, `dep`, `salary`) VALUES
(1, 'Salem', 'Salemcoco@coco.com', '123456789', 'Accounting', 7500),
(2, 'Hassan', 'Hassanabohassan@hassan.com', '1234567', 'Sales', 490),
(3, 'Koko', NULL, '1324092828', 'Administration', 20000),
(4, 'Khaled', NULL, NULL, 'Sales', 1234),
(5, 'Kareem', NULL, NULL, 'Sales', 5678),
(6, 'Shimaa', NULL, NULL, 'Sales', 5000),
(7, 'Lasy', 'lolo@lolla.com', '1234567', 'Administration', 1234),
(8, 'dodo', 'dodoLovelyBoy@gmail.com', '1234', 'Administration', 5678),
(9, 'Rony', 'ronyrony@rony.onion', '45678', 'Accounting', 3456);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(28) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `type`) VALUES
(5, 'omar', '123', 'Omar Tarek', 'admin'),
(6, 'guest', '123', 'Guest', 'guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_updates`
--
ALTER TABLE `manual_updates`
  ADD PRIMARY KEY (`product_id`,`date`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avilable_stock` (`avilable_stock`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`operation_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `input_by` (`input_by`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
